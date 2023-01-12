<?php
    require_once("controleur.php");
    class ModProfile {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurProfile;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>