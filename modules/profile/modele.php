<?php
    require_once("./connexion.php");
    class ModeleProfile extends Connexion {
        public function __construct() {
        }

        public function logout() {
            session_unset();
            header('Location: index.php?action=login&module=mod_connexion');
        }
        
        public function getAssos(){
            $assos = parent::$bdd->prepare('Select Associations.* from Associations inner join AvoirUnRole on(AvoirUnRole.idAsso=Associations.id) where idUser = ?');
            $assos->execute(array($_SESSION["connexion"])) ;
            return $assos->fetchAll();
        }



        public function modifierinfo(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                     $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $sth = parent::$bdd->prepare("UPDATE Users set login=(?)where id=(?)");
                        $sth->execute(array($_POST['login'],$_SESSION['connexion']));
                        $sth = parent::$bdd->prepare("UPDATE Users set mail=(?)where id=(?)");
                        $sth->execute(array($_POST['mail'],$_SESSION['connexion']));
                        $_SESSION['username'] = $_POST['login'];
                        $_SESSION['email'] = $_POST['mail']; 
                    }
                }
            }
            header('Location: index.php?module=mod_profile');
        }

        public function modifierphoto() {
            if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])){
                $taille = 2097152;
                $formatBon = array('png','jpeg','jpg');
                if($_FILES['photo']['size']<= $taille){
                    $format = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
                    if(in_array($format,$formatBon)){
                        $emplacement = 'img/Users/'.$_SESSION['connexion'].'.'.$format;
                        $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'],$emplacement);
                        if($deplacement){
                            $pp = parent::$bdd->prepare('Update Users set pp = ?  where id = ?');
                            $pp->execute(array($_SESSION["connexion"].".".$format,$_SESSION["connexion"]));
                            header("Cache-Control: no-cache, must-revalidate");
                        } else
                        echo '<script type="text/javascript">alert("Depacement imposible")</script>';
                    } else
                    echo '<script type="text/javascript">alert("Format pas bon (jpg,jpeg,png)")</script>';

                } else
                echo '<script type="text/javascript">alert("Fichier trop grand 2mo maximum")</script>';
            }
            header('Location: index.php?module=mod_profile');
        }

        public function modifiermdp(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $pwd = htmlspecialchars($_POST["oldpwd"]);
                        $user = $this->getUser();
                        if (password_verify($pwd, $user["password"])) {
                            if($_POST["newpwd"] == $_POST["newpwd2"]){
                                $sth = parent::$bdd->prepare("UPDATE Users set password=(?) where id=(?)");
                                $pwd1 = htmlspecialchars($_POST["newpwd"]);
                                $pwd_hashed = password_hash($pwd1, PASSWORD_DEFAULT);
                                $sth->execute(array($pwd_hashed,$_SESSION['connexion']));
                                header('Location: index.php?module=mod_profile');
                            }else{
                                echo '<script type="text/javascript">alert("Les Mots de passe sont different.")</script>';
                            }
                        }else{
                            echo '<script type="text/javascript">alert("Mot de passe incorrect.")</script>';
                        }
                    }
                }
            }
        }

        public function suppAccount(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $pwd = htmlspecialchars($_POST["pwd"]);
                        $user = $this->getUser();
                        if (password_verify($pwd, $user["password"])) {
                            $role=parent::$bdd->prepare("DELETE FROM AvoirUnRole where idUser=(?)");
                            $role->execute(array($_SESSION['connexion']));
                            $participation=parent::$bdd->prepare("DELETE FROM Participer where idUsers=?");
                            $participation->execute(array($_SESSION["connexion"]));
                            $suivre=parent::$bdd->prepare("DELETE FROM Suivre where idUsers=?");
                            $suivre->execute(array($_SESSION["connexion"]));
                            $sth = parent::$bdd->prepare("DELETE FROM Users where id=(?)");
                            $sth->execute(array($_SESSION['connexion']));
                            $this->logout();
                        }
                    }
                }
            }
        }

        public function getParticipation(){
            $participation = parent::$bdd->prepare('Select * from Participer inner join Events on (idEvents=id) where idUsers = ?');
            $participation->execute(array($_SESSION['connexion']));
            return $participation->fetchAll();
        }



        public function getUser(){
            $user = parent::$bdd->prepare('Select * from Users where id= ?');
            $user->execute(array($_SESSION['connexion'])) ;
            return $user->fetch();
        }


        public function getAbonnements(){
            $abonnements = parent::$bdd->prepare('Select * from Suivre inner join Associations on (Suivre.idAssos = Associations.id) where idUsers = ?');
            $abonnements->execute(array($_SESSION["connexion"]));
            return $abonnements->fetchAll();
        }

    }
?>