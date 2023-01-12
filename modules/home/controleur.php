<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurHome {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueHome;
            $this->modele = new ModeleHome;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "vueHome";
        }

        
        public function exec() {
            switch ($this->action) {
                default:
                    $event = $this->modele->Eventpopulaire();
                    $asso = $this->modele->Assopopulaire();
                    $this->vue->vuehome($event, $asso);
                    break;
                }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }
    }
?>