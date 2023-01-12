<?php
    require_once("vue.php");
    require_once("modele.php");
    class ControleurFooters {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueFooters;
            $this->modele = new ModeleFooters;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        
        public function exec() {
            switch ($this->action) {
                case "politique": 
                    $this->vue->politique();
                    break;
                case "mention":
                    $this->vue->mention();
                    break;
                case "CGU":
                    $this->vue->ConditionG();
                    break;
                case "info":
                    $this->vue->info();
                    break;
                case "afficherfaq":
                    $this->vue->afficher_question($this->modele->getquestion());
                    break;
                case "reponse":
                    $this->vue->afficher_reponse($this->modele->getreponse($_GET['id']));
                    break;
            }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }
    }
?>