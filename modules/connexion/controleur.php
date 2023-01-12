<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurConnexion {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueConnexion;
            $this->modele = new ModeleConnexion;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        public function form_register() {
            $this->vue->form_inscription();
        }

        public function form_login() {
            $this->vue->form_connexion();
        }

        public function ajout() {
            $this->modele->register();
        }

        public function connexion() {
            $this->modele->login();
        }

        
        public function exec() {
            if (!isset($_SESSION["connexion"])) {
                switch ($this->action) {
                    case "register":
                        $this->form_register();
                        break;
                    case "ajout": 
                        $this->ajout();
                        break;
                    case "login":
                        $this->form_login();
                        break;
                    case "connexion":
                        $this->connexion();
                        break;
                    default:
                        $this->form_login();
                }
            } else {
                header('Location: index.php?module=mod_profile');
            }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }
    }
?>