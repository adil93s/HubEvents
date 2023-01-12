<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurAdmin {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueAdmin;
            $this->modele = new ModeleAdmin;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }
        
        public function exec() {
            if(isset($_SESSION['admin']) && $_SESSION['admin']== TRUE){
                switch ($this->action) {
                    case "gererAdmin":
                        $this->vue->gererAdmin();
                        break;
                    case "gererUtil":
                        $this->vue->gererUtil($this->modele->getUser());
                        break;
                    case "modifU":
                        $this->vue->modifU($this->modele->getInfoUser());
                        break;
                    case "modifinfo":
                        $this->modele->modifierinfo();
                        break;
                    case "formsupp":
                        $this->vue->suppU();
                        break;
                    case "suppU":
                        $this->modele->suppAccount();
                        break;
                    case "gererAsso":
                        $this->vue->gererAsso($this->modele->getAssociation());
                        break;
                    case "modifA":
                        $this->vue->modifA($this->modele->getInfoAsso());
                        break;
                    case "modifinfoA":
                        $this->modele->AdminAsso();
                        break;
                    case "formsuppA":
                        $this->vue->suppA();
                        break;
                    case "suppA":
                        $this->modele->AdmindeleteAsso();
                        break;
                    case "gererEvent":
                        $this->vue->gererEvent($this->modele->getEvent());
                        break;
                    case "modifE":
                        $this->vue->modifE($this->modele->getInfoEvent());
                        break;
                    case "modifinfoE":
                        $this->modele->AdminEvent();
                        break;
                    case "formsuppE":
                        $this->vue->suppE();
                        break;
                    case "suppE":
                        $this->modele->AdminsuppEvent();
                        break;
                    case "gererFAQ":
                        $this->vue->gererFAQ($this->modele->getFAQ());
                        break;
                    case "modifFAQ":
                        $this->vue->modifFAQ($this->modele->getInfoFAQ());
                        break;
                    case "FAQ":
                        $this->modele->AdminFAQ();
                        break;
                    case "formAdd":
                        $this->vue->formaddFAQ();
                        break;
                    case "addFAQ":
                        $this->modele->addFAQ();
                        break;
                    case "formsuppFAQ":
                        $this->vue->formsuppFAQ();
                        break;
                    case "suppFAQ":
                        $this->modele->suppFAQ();
                        break;
                    case "gererSignalement":
                        $this->vue->gererSignalement($this->modele->getSignalement());
                        break;
                    case "formsuppS":
                        $this->vue->formsuppS();
                        break;
                    case "suppS":
                        $this->modele->suppS();
                        break;
                }
            }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }
    }
?>