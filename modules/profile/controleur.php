<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurProfile {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueProfile;
            $this->modele = new ModeleProfile;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }


        
        public function exec() {
            if (isset($_SESSION["connexion"])) {
                switch ($this->action) {
                    case "gerer":  
                        $this->vue->afficheGerer($this->modele->getUser(),$this->modele->getAssos(), $this->modele->getParticipation(),$this->modele->getAbonnements());
                        break;
                    case "creer":  
                        $this->vue->afficheCreer($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        break;
                    case "evenement":
                        $this->vue->afficheEvenement($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        break;
                    case "logout":
                        $this->modele->logout();
                        break;
                    case "settingpassword":
                        $this->vue->afficheProfile($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        $this->vue->formPassword();
                        break;
                    case "settingnotif":
                        $this->vue->afficheProfile($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        $this->vue->formNotif();
                        break;
                    case "settingdesactive":
                        $this->vue->afficheProfile($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        $this->vue->formDesactive(); 
                        break;
                    case "forminfo":
                        $this->vue->forminfo();
                        break;
                    case "modifphoto": 
                        $this->modele->modifierphoto();
                        break;
                    case "modifinfo":
                        $this->modele->modifierinfo();
                      break;
                    case "modifmdp":
                        $this->modele->modifiermdp();
                        break;
                    case "desactive":
                        $this->modele->suppAccount();
                        break;
                    default: 
                        $this->vue->afficheProfile($this->modele->getUser(), $this->modele->getAssos(), $this->modele->getParticipation());
                        $this->vue->formInfo();
                        break; 
                }
            } else {
                header('Location: index.php?module=mod_connexion&action=login');
            }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }

        public function afficheGerer(){
            $this->vue->afficheGerer($this->modele->getAssos());
        }


    }
?>