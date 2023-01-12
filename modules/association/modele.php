<?php
    require_once("./connexion.php");
    class ModeleAssociation extends Connexion {
        public function __construct() {
        }

        public function getUser () {
            $requete = "SELECT * FROM Users WHERE login = ?";
            $sth = parent::$bdd->prepare($requete);
            $sth->execute(array($_POST["login"]));
            return $sth->fetch();
        }
    
        public function addAssociation() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $sth = parent::$bdd->prepare("INSERT INTO Associations (mail, name, description, numeroRNA, image) VALUES (?,?,?,?, 'Default.png')");
                        $sth->execute(array($_POST["mail"], $_POST["name"], $_POST["desc"], $_POST["RNA"]));
                        $assos = parent::$bdd->prepare("select id from Associations where numeroRNA = ?");
                        $assos->execute(array($_POST["RNA"]));
                        $idAssos = $assos->fetch();
                        $role = parent::$bdd->prepare("INSERT INTO AvoirUnRole (role,idUser,idAsso) VALUES ('Createur',?,?)");
                        $role->execute(array($_SESSION["connexion"],$idAssos["id"]));
                        header('Location: index.php?module=mod_association&id='.$idAssos["id"].'');
                    }    
                }
            }
        }

        public function getAssociation() {
            $asso = parent::$bdd->prepare('Select * from Associations where id= ?');
            $asso->execute(array($_GET['id'])) ;
            return $asso->fetch();
        }

        public function getMembres($asso) {
            $membre = parent::$bdd->prepare('SELECT * from AvoirUnRole inner join Users on AvoirUnRole.idUser = Users.id where idAsso = ?');
            $membre->execute(array($asso['id']));
            return $membre;
        }

        public function getCountMembre($asso) {
            $req = parent::$bdd->prepare('SELECT * from AvoirUnRole inner join Users on AvoirUnRole.idUser = Users.id where idAsso = ?');
            $req->execute(array($asso['id']));
            $membres = $req->fetchAll();
            return count($membres);
        }


        public function getRole($asso) {
            $membre = parent::$bdd->prepare('Select * from AvoirUnRole inner join Users on AvoirUnRole.idUser = Users.id where idAsso = ? and idUser = ?');
            $membre->execute(array($asso['id'], $_SESSION["connexion"]));
            return $membre->fetch();
        }

        public function checkPerms($asso) {
            if (isset($_SESSION["connexion"])) {
                $user = $this->getRole($asso);
                if (isset($user["role"])) {
                    if ($user["role"] == "Createur" || $user["role"] == "Administrateur" || $user["role"] == "Support" || $user["role"] == "Membre")  {
                        return true;
                    }
                }
            }
            return false;
        } 

        public function editInformations() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $sth = parent::$bdd->prepare("UPDATE Associations set mail=(?) where id=(?)");
                        $sth->execute(array($_POST["mail"], $_GET["id"]));
                        $sth = parent::$bdd->prepare("UPDATE Associations set description=(?) where id=(?)");
                        $sth->execute(array($_POST["description"], $_GET["id"]));
                        $sth = parent::$bdd->prepare("UPDATE Associations set adresse=(?) where id=(?)");
                        $sth->execute(array($_POST["adresse"], $_GET["id"]));
                        $sth = parent::$bdd->prepare("UPDATE Associations set signature=(?) where id=(?)");
                        $sth->execute(array($_POST["signature"], $_GET["id"]));
                        $sth = parent::$bdd->prepare("UPDATE Associations set categorie=(?) where id=(?)");
                        $sth->execute(array($_POST["categorie"], $_GET["id"]));
                        header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
                    }
                }
            }
        }

        public function addMembre() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $membre =  parent::$bdd->prepare('Select * from Users where id = ?');
                        $ajout =  parent::$bdd->prepare('Insert into AvoirUnRole (role,idUser,idAsso) values (?,?,?) ');
                        $membre->execute(array($_POST['userID']));
                        $user = $membre->fetch();
                        if (isset($user["login"]))
                            $ajout->execute(array($_POST["role"],$_POST["userID"],$_GET["id"]));
                        else
                            echo '<script type="text/javascript">alert("Cette utilisateur n\'existe pas")</script>';
                            header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
                    }
                }
            }
        }

        public function removeMembre() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $membre =  parent::$bdd->prepare('Select * from Users where id = ?');
                        $remove =  parent::$bdd->prepare('Delete From AvoirUnRole Where idUser = (?) and idAsso = (?)');
                        $membre->execute(array($_POST['userID']));
                        $user = $membre->fetch();
                        if (isset($user["login"]))
                            $remove->execute(array($_POST["userID"],$_GET["id"]));
                        else
                            echo '<script type="text/javascript">alert("Cette utilisateur n\'existe pas")</script>';
                            header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
                    }
                }
            }
        }

        public function deleteAssociation() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $a=parent::$bdd->prepare("DELETE FROM AvoirUnRole where idAsso=(?)");
                        $a->execute(array($_GET['id']));
                        $sth = parent::$bdd->prepare("DELETE FROM Associations where id=(?)");
                        $sth->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_profile&action=gerer');
                    }
                }
            }
        }

        public function editBanniere() {
            if(isset($_FILES['photoassociation']) AND !empty($_FILES['photoassociation']['name'])){
                $taille = 2097152;
                $formatBon = array('png','jpeg','jpg');
                if($_FILES['photoassociation']['size']<= $taille){
                    $format = strtolower(substr(strrchr($_FILES['photoassociation']['name'],'.'),1));
                    if(in_array($format,$formatBon)){
                        $emplacement = 'img/Associations/'.$_GET["id"].'.'.$format;
                        $deplacement = move_uploaded_file($_FILES['photoassociation']['tmp_name'],$emplacement);
                        if($deplacement){
                            $pp = parent::$bdd->prepare('UPDATE Associations SET image = ?  WHERE id = ?');
                            $pp->execute(array($_GET["id"].".".$format, $_GET["id"]));
                            header("Cache-Control: no-cache, must-revalidate");
                        } else
                            echo '<script type="text/javascript">alert("Deplacement impossible")</script>';
                    } else
                        echo '<script type="text/javascript">alert("Format pas bon (jpg,jpeg,png)")</script>';

                } else
                    echo '<script type="text/javascript">alert("Fichier trop grand 2mo maximum")</script>';
            }
            header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
        }
    

        public function getEvent() {
            $sth = parent::$bdd->prepare("Select Events.* from Events inner join Organiser on(idEvent = id) where idAsso = ? ");
            $sth->execute(array($_GET["id"]));
            return $sth->fetchAll();
        }

        public function getAllAssociations() {
            $events = parent::$bdd->query("Select * from Associations");
            return $events->fetchAll();
        }
    
            
        public function updateStatut() {
            $events = $this->getEvent();
            foreach ($events as $event) {
                $dates=parent::$bdd->prepare("SELECT dateStart, dateEnd from Events where id=?");
                $dates->execute(array($event["id"]));
                $date = $dates->fetch();
                date_default_timezone_set('Europe/Paris');
                $dateNow = date('Y-m-d H:i:s');
                $dateStart = $date["dateStart"];
                $dateEnd = $date["dateEnd"];
                $statut = parent::$bdd->prepare("UPDATE Events set statut=(?) where id=(?)");
                if($dateNow <= $dateStart){
                    $statut->execute(array("prochainement", $event["id"]));    
                } else if ($dateNow >= $dateEnd){
                    $statut->execute(array("terminé", $event["id"]));    
                } else {
                    $statut->execute(array("en cours", $event["id"]));    
                }
            }
        }
    
        public function updateProgression() {
            $events = $this->getEvent();
            foreach ($events as $event) {
                $dates=parent::$bdd->prepare("SELECT dateStart, dateEnd from Events where id=?");
                $dates->execute(array($event["id"]));
                $date = $dates->fetch();
                $date1 = strtotime($date["dateStart"]);
                $date2 = strtotime($date["dateEnd"]);
                $today = time();
                $dateDiff = $date2 - $date1;
                $dateDiffForToday = $today - $date1;
                $percentage = $dateDiffForToday / $dateDiff * 100;
                $percentageRounded = round($percentage);
                if ($percentageRounded > 100) $percentageRounded = 100;
                if ($percentageRounded < 0) $percentageRounded = 0;
                $progression = parent::$bdd->prepare("UPDATE Events set progression=(?) where id=(?)");
                $progression->execute(array($percentageRounded, $event["id"]));    
            }
        }
        public function getAbonnes() {
            $abonnes = parent::$bdd->prepare("Select idUsers from Suivre where idAssos = ? ");
            $abonnes->execute(array($_GET["id"]));
            return $abonnes->fetchAll();
        }

        public function suivre() {
            $suivre = parent::$bdd->prepare('Insert Into Suivre values(?,?)');
            $suivre->execute(array($_SESSION["connexion"],$_GET["id"]));
            header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
        }

        public function nePlusSuivre() {
            $nePlusSuivre = parent::$bdd->prepare('Delete from Suivre where idUsers = ? and idAssos = ?');
            $nePlusSuivre->execute(array($_SESSION["connexion"],$_GET["id"]));
            header('Location: index.php?module=mod_association&id='.$_GET["id"].'');
        }
    
        public function getParticipants($id) {
            $particiants = parent::$bdd->prepare("Select idUsers from Participer where idEvents = ? ");
            $particiants->execute(array($id));
            return $particiants->fetchAll();
        }

        public function getEventsParticipants($getevents) {
            $events = array();
            foreach ($getevents as $e) {
                $e["participants"] = 0;
                foreach ($this->getParticipants($e["id"]) as $p) {
                    $e["participants"] = $e["participants"] + 1;
                }
                $events[] = $e;
            }
            return $events;
        }
        
        public function updateRecentA() {
            $last = parent::$bdd->query("SELECT id from Associations order by dateCreation desc limit 16");
            $assoR= $last->fetchAll();
            $recent = parent::$bdd->prepare("UPDATE Associations set recent=?");
            $recent->execute(array("NonRecent"));
                foreach($assoR as $r){
                    $recent = parent::$bdd->prepare("UPDATE Associations set recent=? where id =?");
                    $recent->execute(array('Recent', $r['id']));
            }
        }

        public function updatePopularite() {
            $populaire = parent::$bdd->query("SELECT count(*) as abonne, Associations.* from Associations inner join Suivre on (id=idAssos) group by idAssos order by abonne desc limit 16");
            $assoPopulaire = $populaire->fetchAll();
            $popularite = parent::$bdd->prepare("Update Associations set populaire=?");
            $popularite->execute(array("NonPopulaire"));
            foreach($assoPopulaire as $a){
                $popularite = parent::$bdd->prepare("Update Associations set populaire=? where id=?");
                $popularite->execute(array("Populaire",$a["id"]));
            }
        }

        public function AssoExist() {
            $sth = parent::$bdd->prepare('Select * from Associations where id = ?');
            $sth->execute(array($_GET["id"]));
            $asso = $sth->fetch();
            return isset($asso["id"]); 
        }
    
    }

?>