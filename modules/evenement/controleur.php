<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurEvent {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueEvent;
            $this->modele = new ModeleEvent;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        
        public function exec() {
            switch ($this->action) {
                case "ajoutevenement":
                    $this->modele->addEvenement();
                    break;
                case "gerer":
                    $event = $this->modele->getEvent();
                    $this->modele->updateStatut($event["id"]);
                    $this->vue->gerer($event);
                    break;
                case "modifevent":
                    $this->modele->modifierEvent();
                    break;
                case "supp":
                    $this->modele->supprimerEvent();
                    break;
                case "signalement":
                    $this->vue->signalement($this->modele->getEvent());
                    break;
                case "signaler":
                    $this->modele->signaler();
                    break;
                case "participer";
                    $this->modele->participer();
                    break;
                case "annuler";
                    $this->modele->annulerParticiper();
                    break;
                case "recent":
                    $this->modele->lastEvent();
                    break;
                default:
                    if (isset($_GET["id"])) {
                        if($this->modele->EventExist()){
                            $event = $this->modele->getEvent();
                            $association = $this->modele->getAssociation();
                            $participant = $this->modele->getParticipants();
                            $this->modele->updateStatut($event["id"]);
                            $this->vue->afficheEvenement($event, $association,$participant);
                        }else{
                            header('Location: index.php?module=mod_evenement');
                        }
                    } else {
                        $this->modele->updatePopularite();
                        $this->modele->updateRecentE();
                        $this->vue->afficherTousLesEvents($this->modele->getAllEvents());
                    }
                    break;
            }
        }

        public function afficheModule() {
            return $this->vue->getAffichage();
        }
    }
?>