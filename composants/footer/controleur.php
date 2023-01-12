<?php
require_once('vue.php');
require_once('modele.php');

class ControleurFooter {
    private $modele, $vue;
    public function __construct(){
        $this->modele= new ModeleFooter();
        $this->vue= new VueFooter();
    }
    public function exec(){
        $this->vue->completeContenu();
        return $this->vue->getContenue();
    }
}
?>