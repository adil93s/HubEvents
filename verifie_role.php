<?php
    header('Content-Type:application/json;charset=utf-8');
    session_start();
    require_once("./connexion.php");
    Connexion::initConnexion();
    $userID = $_POST['idUser'];
    $assoID = $_POST['idAsso'];
    $result = Connexion::getBDD()->prepare("Select * from AvoirUnRole inner join Users on AvoirUnRole.idUser = Users.id where idAsso = ? and idUser = ? LIMIT 12");
    $result->execute(array($assoID, $userID));  
    $resultat = $result->fetch();
    $reponse = array();
    if (isset($resultat["role"])) {
        if ($resultat["role"] == "Membre" || $resultat["role"] == "Support" || $resultat["role"] == "Administrateur") {
            $reponse["role"] = "true";
        } else {
            $reponse["role"] = "false";
        }
    } else {
        $reponse["role"] = "false";
    }
    echo json_encode($reponse);

?>