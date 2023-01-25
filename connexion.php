<?php
    class Connexion {

        protected static $bdd;

        public function __construct() {

        }

        public static function initConnexion() {
            /* $dsn = "mysql:host=localhost;dbname=hubevent";
            $username = "root";
            $password = "root"; */

            
            $dsn = "mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201632;charset=UTF8";
            $username = "dutinfopw201632";
            $password = "jynuhuby";
        
            self::$bdd = new PDO($dsn, $username, $password);  
        }

        public static function getBDD() {
            return self::$bdd;
        }

    }
?>