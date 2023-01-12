<?php
require_once('vue.php');
require_once('modele.php');

class ControleurMenu {
    private $modele, $vue;
    public function __construct(){
        $this->modele= new ModeleMenu();
        $this->vue= new VueMenu();
    }
    public function exec(){
        $this->vue->completeContenu();
        if(isset($_SESSION['connexion']) AND $this->modele->verifAdmin()){
            $this->vue->vueAdmin();
        }
        return $this->vue->getContenue();
    }
}
?>