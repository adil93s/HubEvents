<?php
    require_once("./connexion.php");
    class ModeleAdmin extends Connexion {
        public function __construct() {
        }

        public function getUser () {
            $requete = "SELECT * FROM Users";
            $sth = parent::$bdd->prepare($requete);
            $sth->execute(array());
            return $sth->fetchAll();
        }

        public function getInfoUser(){
            $info = parent::$bdd->prepare('SELECT * FROM Users where id = ?');
            $info->execute(array($_GET['id']));
            return $info->fetch();
        }
        public function getEvent(){
            $event = parent::$bdd->prepare('SELECT * from Events');
            $event->execute(array());
            return $event->fetchAll();
        }

        public function getInfoEvent(){
            $infoE = parent::$bdd->prepare('SELECT * from Events where id= ?');
            $infoE->execute(array($_GET['id']));
            return $infoE->fetch();
        }

        public function getAssociation() {
            $asso = parent::$bdd->prepare('Select * from Associations');
            $asso->execute(array());
            return $asso->fetchAll();
        }

        public function getInfoAsso(){
            $infoA = parent::$bdd->prepare('SELECT * FROM Associations where id = ?');
            $infoA->execute(array($_GET['id']));
            return $infoA->fetch();
        }

        public function getInfoFAQ(){
            $infoF = parent::$bdd->prepare("SELECT * FROM FAQ where id = ?");
            $infoF->execute(array($_GET['id']));
            return $infoF->fetch();
        }

        public function getFAQ(){
            $faq = parent::$bdd->prepare('SELECT * from FAQ');
            $faq->execute(array());
            return $faq->fetchAll();
        }

        public function getSignalement(){
            $signalement = parent::$bdd->prepare('SELECT * from Signalement');
            $signalement->execute(array());
            return $signalement->fetchAll();
        }

        public function suppS(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $delete=parent::$bdd->prepare("DELETE FROM Signalement where id=(?)");
                        $delete->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererSignalement');
                    }
                }
            }
        }
        public function AdminFAQ(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $question= parent::$bdd->prepare("UPDATE FAQ set question=(?) where id=(?)");
                        $question->execute(array($_POST["question"],$_GET["id"]));
                        $reponse = parent::$bdd->prepare("UPDATE FAQ set reponse=(?) where id=(?)");
                        $reponse->execute(array($_POST["reponse"],$_GET["id"]));
                        header('Location: index.php?module=mod_admin&action=gererFAQ');
                    }
                }
            } 
        }

        public function addFAQ(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $faq = parent::$bdd->prepare("INSERT INTO FAQ (question, reponse) VALUES (?,?)");
                        $faq->execute(array($_POST["question"], $_POST["reponse"]));
                        header('Location: index.php?module=mod_admin&action=gererFAQ');
                    }    
                }
            }
        }

        public function suppFAQ(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $delete=parent::$bdd->prepare("DELETE FROM FAQ where id=(?)");
                        $delete->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererFAQ');
                    }
                }
            }
        }

        public function AdminEvent(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $name= parent::$bdd->prepare("UPDATE Events set name=(?) where id=(?)");
                        $name->execute(array($_POST["name"],$_GET["id"]));
                        $type = parent::$bdd->prepare("UPDATE Events set type=(?) where id=(?)");
                        $type->execute(array($_POST["type"],$_GET["id"]));
                        $descr = parent::$bdd->prepare("UPDATE Events set description=(?) where id=(?)");
                        $descr->execute(array($_POST["description"],$_GET["id"]));
                        header('Location: index.php?module=mod_admin&action=gererEvent');
                    }
                }
            }
        }

        public function AdminsuppEvent(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $org = parent::$bdd->prepare("DELETE FROM Organiser where idEvent=(?)");
                        $org->execute(array($_GET['id']));
                        $participe= parent::$bdd->prepare("DELETE FROM Participer where idEvents=?");
                        $participe->execute(array($_GET['id']));
                        $sth = parent::$bdd->prepare("DELETE FROM Events where id=(?)");
                        $sth->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererEvent');
                    }
                }
            }
        }

        public function AdminAsso() {
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
                        $sth = parent::$bdd->prepare("UPDATE Associations set categorie=(?) where id=(?)");
                        $sth->execute(array($_POST["categorie"], $_GET["id"]));
                        header('Location: index.php?module=mod_admin&action=gererAsso');
                    }
                }
            }
        }

        public function AdmindeleteAsso(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $org = parent::$bdd->prepare("DELETE FROM Organiser where idAsso=(?)");
                        $org->execute(array($_GET['id']));
                        $a=parent::$bdd->prepare("DELETE FROM AvoirUnRole where idAsso=(?)");
                        $a->execute(array($_GET['id']));
                        $suivie= parent::$bdd->prepare("DELETE FROM Suivre where idAssos=(?)");
                        $suivie->execute(array($_GET['id']));
                        $sth = parent::$bdd->prepare("DELETE FROM Associations where id=(?)");
                        $sth->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererAsso');
                    }
                }
            }
        }

        public function modifierinfo(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                     $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $sth = parent::$bdd->prepare("UPDATE Users set login=(?)where id=(?)");
                        $sth->execute(array($_POST['login'], $_GET['id']));
                        $sth = parent::$bdd->prepare("UPDATE Users set mail=(?)where id=(?)");
                        $sth->execute(array($_POST['mail'], $_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererUtil');
                    }
                }
            }
        }

        public function suppAccount(){
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (1560);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $a=parent::$bdd->prepare("DELETE FROM AvoirUnRole where idUser=(?)");
                        $a->execute(array($_GET['id']));
                        $participer=parent::$bdd->prepare("DELETE FROM Participer where idUsers=(?)");
                        $participer->execute(array($_GET['id']));
                        $suivre=parent::$bdd->prepare("DELETE FROM Suivre where idUsers=?");
                        $suivre->execute(array($_GET['id']));
                        $sth = parent::$bdd->prepare("DELETE FROM Users where id=(?)");
                        $sth->execute(array($_GET['id']));
                        header('Location: index.php?module=mod_admin&action=gererUtil');
                        }
                    }
                }
            }
        }
    ?>    