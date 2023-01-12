<?php
    header('Content-Type:application/json;charset=utf-8');
    session_start();
    require_once("./connexion.php");
    Connexion::initConnexion();
    $name = $_POST['username'];
    $result = Connexion::getBDD()->prepare("SELECT * FROM Users WHERE login like ? LIMIT 12");
    $result->execute(array($name."%"));  
    $output=array();
    foreach($result as $row){
        if ($row["id"] != $_SESSION["connexion"]) {
            $imagelien = "img/Users/".htmlspecialchars($row["PP"])."";
            $imagetime = filemtime($imagelien);
            $temp_array = array();
            $temp_array['icon'] = htmlspecialchars($row['PP']);
            $temp_array['value'] = htmlspecialchars($row['login']);
            $temp_array['id'] = $row['id'];
            $temp_array['label'] = '
            <a href="javascript:void(0);">
                <img src="'.$imagelien.'?'.$imagetime.'"/>
                <span>'.htmlspecialchars($row['login']).'</span>
            </a>';
            $output[] = $temp_array;
        }
    }
    echo json_encode($output);

?>