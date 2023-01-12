<?php
require_once('controleur.php');
class CompMenu {
    private $contenue;
    public function __construct(){
        $controleur = new ControleurMenu();
        Connexion::initConnexion();
        $this->contenue= $controleur->exec();
    }
    public function affiche(){
        echo $this->contenue;
    }
}
?>