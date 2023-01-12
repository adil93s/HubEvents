<?php
    require_once("controleur.php");
    class ModFooters {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurFooters;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>