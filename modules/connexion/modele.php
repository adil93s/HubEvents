<?php
    require_once("./connexion.php");
    class ModeleConnexion extends Connexion {
        public function __construct() {
        }

        public function getUser () {
            $requete = "SELECT * FROM Users WHERE login = ?";
            $sth = parent::$bdd->prepare($requete);
            $sth->execute(array($_POST["login"]));
            return $sth->fetch();
        }

        private function getMail(){
            $mail = parent::$bdd->prepare("Select * from Users where mail  = ?");
            $mail->execute(array($_POST["mail"]));
            return $mail->fetch();
        }

        public function register() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $user = $this->getUser();
                        $mail = $this->getMail();
                        if(isset($user["login"])) {
                            echo '<script type="text/javascript">
                                alert("Ce nom d\'utilisateur existe déjà.")
                                document.location.href = \'index.php?module=mod_connexion&action=register\';
                            </script>';  
                        } else if(isset($mail["mail"])) {
                            echo '<script type="text/javascript">
                                alert("Cet email existe déjà.")
                                document.location.href = \'index.php?module=mod_connexion&action=register\';
                            </script>'; 
                        } else { 
                            $login = $_POST["login"];
                            $pwd = $_POST["password"];
                            $longLog = strlen($login);
                            $longMdp = strlen($pwd);
                            if($longLog<=12 && $longLog>=4 && $longMdp<=12 && $longMdp>=4){
                                $sth = parent::$bdd->prepare("INSERT INTO Users (login, password, mail, isAdmin, pp) VALUES (?,?,?, FALSE, 'Default.png')");
                                $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);
                                $sth->execute(array($login, $pwd_hashed, $_POST["mail"]));
                                header('Location: index.php?action=login&module=mod_connexion');
                            }
                        }
                    }
                }
            }
        }

        public function login() {
            if(isset($_SESSION['token']) && isset($_SESSION['token_time']) && isset($_POST['token'])) {
                if($_SESSION['token'] == $_POST['token']) {
                    $timestamp_ancien = time() - (15*60);
                    if($_SESSION['token_time'] >= $timestamp_ancien) {
                        $pwd = htmlspecialchars($_POST["password"]);
                        $user = $this->getUser();
                        if (isset($user["login"]) && password_verify($pwd, $user["password"])) {
                                $_SESSION["connexion"] = $user["id"];
                                $_SESSION["username"] = $user["login"];
                                $_SESSION["email"] = $user["mail"];
                                $_SESSION['admin'] = $user["isAdmin"];
                                header('Location: index.php?module=mod_profile');
                        } else {
                            echo '<script type="text/javascript">
                                alert("Nom d\'utilisateur ou mot de passe incorrecte.")
                                document.location.href = \'index.php?module=mod_connexion&action=login\';
                            </script>';
                        }
                    }
                }
            }
        }
    }
?>