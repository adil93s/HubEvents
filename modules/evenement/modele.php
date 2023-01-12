<?php
    require_once("./connexion.php");
    class ModeleEvent extends Connexion {
        public function __construct() {
        }

        public function getUser () {
            $requete = "SELECT * FROM Users WHERE login = ?";
            $sth = parent::$bdd->prepare($requete);
            $sth->execute(array($_POST["login"]));
            return $sth->fetch();
        }
    
        public function addEvenement() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        date_default_timezone_set('Europe/Paris');
                        $dates = date('Y-m-d H:i:s');
                        $dateNow = $dates;
                        $sth = parent::$bdd->prepare("INSERT INTO Events (name, type, dateStart, dateEnd, description, image) VALUES (?,?,?,?,?, 'Default.png')");
                            if($_POST["dateS"]<=$dateNow|| $_POST["dateF"]<$dateNow || $_POST["dateF"]< $_POST["dateS"]){
                                echo "Erreur 404";
                            } else {
                                $sth->execute(array($_POST["name"], $_POST["type"], $_POST["dateS"], $_POST["dateF"], $_POST["description"]));
                                $id = parent::$bdd->query("select max(id) as 'id' from Events");
                                $idEvent = $id->fetch();
                                $orga = parent::$bdd->prepare("INSERT INTO Organiser VALUES(?,?)");
                                $orga->execute(array($idEvent["id"],$_GET["id"]));
                                header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
                        }
                    }    
                }
            }
        }

        public function signaler() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $signaler= parent::$bdd->prepare("INSERT INTO Signalement (raison, idEvent, idUser) VALUES(?,?,?)");
                        $signaler->execute(array($_POST["raison"],$_GET["id"],$_SESSION["connexion"]));
                    }
                }
            }   
        }

        public function getEvent() {
            $event = parent::$bdd->prepare('SELECT * from Events where id= ?');
            $event->execute(array($_GET['id']));
            return $event->fetch();
        }

        public function getAssociation() {
            $event = parent::$bdd->prepare('SELECT Associations.name, Associations.id from Events Inner Join Organiser On (Organiser.idEvent = Events.id) Inner Join Associations On (Organiser.idAsso = Associations.id) where Events.id= (?)');
            $event->execute(array($_GET['id']));
            return $event->fetch();
        }

        public function modifierEvent() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $dateS = parent::$bdd->prepare("UPDATE Events set dateStart=(?) where id=(?)");
                        $dateS->execute(array($_POST["dateS"],$_GET["id"]));                        
                        $dateF = parent::$bdd->prepare("UPDATE Events set dateEnd=(?) where id=(?)");
                        $dateF->execute(array($_POST["dateF"],$_GET["id"]));
                        $descr = parent::$bdd->prepare("UPDATE Events set description=(?) where id=(?)");
                        $descr->execute(array($_POST["description"],$_GET["id"]));
                        $type = parent::$bdd->prepare("UPDATE Events set type=(?) where id=(?)");
                        $type->execute(array($_POST["type"],$_GET["id"]));
                        if(isset($_FILES['imagevenement']) AND !empty($_FILES['imagevenement']['name'])){
                            $taille = 2097152;
                            $formatBon = array('png','jpeg','jpg');
                            if($_FILES['imagevenement']['size']<= $taille){
                                $format = strtolower(substr(strrchr($_FILES['imagevenement']['name'],'.'),1));
                                if(in_array($format,$formatBon)){
                                    $emplacement = 'img/Evenements/'.$_GET["id"].'.'.$format;
                                    $deplacement = move_uploaded_file($_FILES['imagevenement']['tmp_name'],$emplacement);
                                    if($deplacement){
                                        $pp = parent::$bdd->prepare('UPDATE Events SET image = ?  WHERE id = ?');
                                        $pp->execute(array($_GET["id"].".".$format, $_GET["id"]));
                                    } else
                                        echo '<script type="text/javascript">alert("Deplacement impossible")</script>';
                                } else
                                    echo '<script type="text/javascript">alert("Format pas bon (jpg,jpeg,png)")</script>';

                            } else
                                echo '<script type="text/javascript">alert("Fichier trop grand 2mo maximum")</script>';
                        }
                        header('Location: index.php?module=mod_evenement&id='.$_GET["id"].'');
                    }
                }
            }
        }

        public function updateStatut($id) {
            $dates=parent::$bdd->prepare("SELECT * from Events where id=?");
            $dates->execute(array($id));
            $date = $dates->fetch();
            date_default_timezone_set('Europe/Paris');
            $dateNow = date('Y-m-d H:i:s');
            $dateStart = $date["dateStart"];
            $dateEnd = $date["dateEnd"];
            $statut = parent::$bdd->prepare("UPDATE Events set statut=(?) where id=(?)");
            if($dateNow <= $dateStart){
                $statut->execute(array("prochainement", $id));    
            } else if ($dateNow >= $dateEnd){
                $statut->execute(array("terminé", $id));    
            } else {
                $statut->execute(array("en-cours", $id));    
            }
        }
                
            
        public function supprimerEvent() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_GET['token'])) {
                if($_SESSION['token'] == $_GET['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $association = parent::$bdd->prepare("SELECT * FROM Associations INNER JOIN Organiser ON Organiser.idAsso = Associations.id WHERE idEvent = (?)");
                        $association->execute(array($_GET['id']));
                        $asso = $association->fetch();
                        $organiser = parent::$bdd->prepare("DELETE FROM Organiser WHERE idEvent=(?)");
                        $organiser->execute(array($_GET['id']));
                        $event = parent::$bdd->prepare("DELETE FROM Events WHERE id=(?)");
                        $event->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_association&id='.$asso["id"].'');
                    }
                }
            }
        }

        public function modifierBanniere() {
            if(isset($_FILES['imagevenement']) AND !empty($_FILES['imagevenement']['name'])){
                $taille = 2097152;
                $formatBon = array('png','jpeg','jpg');
                if($_FILES['imagevenement']['size']<= $taille){
                    $format = strtolower(substr(strrchr($_FILES['imagevenement']['name'],'.'),1));
                    if(in_array($format,$formatBon)){
                        $emplacement = 'img/Evenements/'.$_GET["id"].'.'.$format;
                        $deplacement = move_uploaded_file($_FILES['imagevenement']['tmp_name'],$emplacement);
                        if($deplacement){
                            $pp = parent::$bdd->prepare('UPDATE Events SET image = ?  WHERE id = ?');
                            $pp->execute(array($_GET["id"].".".$format, $_GET["id"]));
                        } else
                            echo '<script type="text/javascript">alert("Deplacement impossible")</script>';
                    } else
                        echo '<script type="text/javascript">alert("Format pas bon (jpg,jpeg,png)")</script>';

                } else
                    echo '<script type="text/javascript">alert("Fichier trop grand 2mo maximum")</script>';
            }
            header("Cache-Control: no-cache, must-revalidate");
            header('Location: index.php?module=mod_evenement&action=gerer&id='.$_GET["id"].'');
        }


        public function getAllEvents() {
            $events = parent::$bdd->query('SELECT * from Events');
            return $events->fetchAll();
        }


        public function participer() {
            $participe = parent::$bdd->prepare('Insert Into Participer values(?,?)');
            $participe->execute(array($_SESSION["connexion"],$_GET["id"]));
            header('Location: index.php?module=mod_evenement&id='.$_GET["id"].'');
        }


        public function annulerParticiper() {
            $participe = parent::$bdd->prepare('Delete From Participer where idUsers = ? and idEvents = ?');
            $participe->execute(array($_SESSION["connexion"],$_GET["id"]));
            header('Location: index.php?module=mod_evenement&id='.$_GET["id"].'');
        }


        public function getParticipants() {
            $particiants = parent::$bdd->prepare("Select idUsers from Participer where idEvents = ? ");
            $particiants->execute(array($_GET["id"]));
            return $particiants->fetchAll();
        }


        public function updatePopularite() {
            $populaire = parent::$bdd->query("SELECT count(*) as participant, Events.* from Events inner join Participer on (id=idEvents) group by idEvents order by participant desc limit 16");
            $evPopulaire = $populaire->fetchAll();
            $popularite = parent::$bdd->prepare("Update Events set populaire=?");
            $popularite->execute(array("NonPopulaire"));
            foreach($evPopulaire as $e){
                $popularite = parent::$bdd->prepare("Update Events set populaire=? where id=?");
                $popularite->execute(array("Populaire",$e["id"]));

            }

        }

        public function updateRecentE() {
            $last = parent::$bdd->query("SELECT id from Events order by dateCreation desc limit 16");
            $eventR= $last->fetchAll();
            $recent = parent::$bdd->prepare("UPDATE Events set recent=?");
            $recent->execute(array("NonRecent"));
            foreach($eventR as $r) {
                $recent = parent::$bdd->prepare("UPDATE Events set recent=? where id =?");
                $recent->execute(array('Recent', $r['id']));
            }
        }
        
        public function EventExist() {
            $sth = parent::$bdd->prepare('Select * from Events where id = ?');
            $sth->execute(array($_GET["id"]));
            $event = $sth->fetch();
            return isset($event["id"]);
        }

    }
?>