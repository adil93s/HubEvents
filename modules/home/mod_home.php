<?php
    require_once("controleur.php");
    class ModHome {
        private $controleur;

        public function __construct() {
            $this->controleur = new ControleurHome;
            Connexion::initConnexion();
            $this->controleur->exec();
        }       
        
        public function afficheMod() {
            return $this->controleur->afficheModule();
        }

    }
?>