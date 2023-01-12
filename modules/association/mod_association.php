<?php
    require_once("controleur.php");
    class ModAssociation {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurAssociation;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>