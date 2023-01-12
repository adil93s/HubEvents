<?php
    require_once("./connexion.php");
    class ModeleHome extends Connexion {
        public function __construct() {
        }

        public function Eventpopulaire(){
            $event = parent::$bdd->prepare("SELECT count(*) as participant, Events.* from Events inner join Participer on (id=idEvents) group by idEvents order by participant desc limit 10");
            $event->execute(array());
            return $event->fetchAll();
        }
        
        public function Assopopulaire(){
        $asso= parent::$bdd->prepare("SELECT count(*) as abonne, Associations.* from Associations inner join Suivre on (id=idAssos) group by idAssos order by abonne desc limit 10");
        $asso->execute(array());
        return $asso->fetchAll();
    }
}
