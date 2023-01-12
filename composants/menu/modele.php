<?php
require_once("./connexion.php");
class ModeleMenu extends Connexion {
    
    public function __construct(){

    }

    public function verifAdmin(){
        $user = parent::$bdd->prepare('Select * from Users where id= ?');
        $user->execute(array($_SESSION['connexion'])) ;
        $userr = $user->fetch();
        return ($userr["isAdmin"]==1);
    }

}
?>