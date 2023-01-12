<?php
    require_once("./connexion.php");
    class ModeleFooters extends Connexion {
        public function __construct() {
        }

        public function getreponse($id){
            $faq = parent::$bdd->prepare("SELECT reponse FROM FAQ where id = ?");
            $faq->execute(array($id));
            return $faq->fetch();
        }

        public function getquestion(){
            $question = parent::$bdd->query('SELECT * from FAQ');
            return $question->fetchAll();
        }
    }
?>
