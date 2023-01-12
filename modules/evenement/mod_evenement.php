<?php
    require_once("controleur.php");
    class ModEvent {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurEvent;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>