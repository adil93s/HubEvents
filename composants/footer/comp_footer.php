<?php
require_once('controleur.php');
class CompFooter {
    private $contenue;
    public function __construct(){
        $controleur = new ControleurFooter();
        $this->contenue= $controleur->exec();
    }
    public function affiche(){
        echo $this->contenue;
    }
}
?>