<?php
    require_once("controleur.php");
    class ModConnexion {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurConnexion;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>