<?php
    require_once("controleur.php");
    class ModAdmin {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurAdmin;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>