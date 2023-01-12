<?php
    require_once("vue.php");
    require_once("modele.php");

    class ControleurAssociation {
        private $vue;
        private $modele;
        private $action;

        public function __construct() {
            $this->vue = new VueAssociation;
            $this->modele = new ModeleAssociation;
            $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        }

        
        public function exec() {
            switch ($this->action) {
                case "ajoutassociation": 
                    $this->modele->addAssociation();
                    break;
                case "gerer":
                    $this->gerer();
                    break;
                case "informations":
                    if ($this->modele->checkPerms($this->modele->getAssociation())) {
                        $membres = $this->modele->getCountMembre($this->modele->getAssociation());
                        $this->vue->formulaireInformations($this->modele->getAssociation(), $membres);
                    }
                    break;
                case "editinformation":
                    $this->modele->editInformations();
                    break;
                case "addmembre":
                    $this->modele->addMembre();
                    break;
                case "removemembre":
                    $this->modele->removeMembre();
                    break;        
                case "editbanniere":
                    $this->modele->editBanniere();
                    break;
                case "supprimer":
                    $this->modele->deleteAssociation();
                    break;
                case "evenement":
                    $this->vue->formulaireEvenement($this->modele->getAssociation(), $this->modele->getEvent());
                    break;
                case "listeAssociations":
                    $this->vue->afficherListeAssociations($this->modele->getAllAssociations());
                    break;
                case "suivre":
                    $this->modele->suivre();
                    break;
                case "nePlusSuivre":
                    $this->modele->nePlusSuivre();
                    break;
                case "recent":
                    $this->modele->lastAsso();
                    break;
                default:
                    if (isset($_GET["id"])) {
                        if($this->modele->AssoExist()){
                            $association = $this->modele->getAssociation();
                            if ($this->modele->checkPerms($association)) {
                                header('Location: index.php?module=mod_association&action=gerer&id='.$association["id"].'');
                            } else {
                                $membres = $this->modele->getMembres($association);
                                $events = $this->modele->getEventsParticipants($this->modele->getEvent());        
                                $this->modele->updateStatut();
                                $this->modele->updateProgression();
                                $this->vue->afficheAssociation($association, $membres, $events, $this->modele->getAbonnes());
                            }
                        }else{
                            header('Location: index.php?module=mod_association');
                        }
                    } else {
                        $this->modele->updateRecentA();
                        $this->modele->updatePopularite();
                        $this->vue->afficherListeAssociations($this->modele->getAllAssociations());
                    }
                    break;
            }
        }

        public function gerer(){
            if (isset($_GET["id"])) {
                $association = $this->modele->getAssociation();
                if ($this->modele->checkPerms($association)) {
                    $association = $this->modele->getAssociation();
                    $membres = $this->modele->getMembres($association);
                    $roleUser = $this->modele->getRole($association);
                    $events = $this->modele->getEventsParticipants($this->modele->getEvent());        
                    $this->modele->updateStatut();
                    $this->modele->updateProgression();
                    $this->vue->afficheGerer($association, $roleUser);
                    $this->vue->afficheAssociation($association, $membres, $events, $this->modele->getAbonnes());
                } else {
                    header('Location: index.php?module=mod_association&id='.$association["id"].'');
                }
            }
        }
       
       
        public function afficheModule() {
            return $this->vue->getAffichage();
        }

    }


    


?>