<?php
    session_start(); 

    require_once('composants/menu/comp_menu.php');
    require_once('composants/footer/comp_footer.php');
    
    $module = isset($_GET["module"]) ? $_GET["module"] : $module = "default";

    switch($module) {
        case "mod_connexion":
            require_once("modules/connexion/mod_connexion.php");
            $module = new ModConnexion;
            $affichage = $module->afficheMod();
            break;
        case "mod_profile":
            require_once("modules/profile/mod_profile.php");
            $module = new ModProfile;
            $affichage = $module->afficheMod();
            break;
        case "mod_association":
            require_once("modules/association/mod_association.php");
            $module = new ModAssociation;
            $affichage = $module->afficheMod();
            break;
        case "mod_evenement":
            require_once("modules/evenement/mod_evenement.php");
            $module = new ModEvent;
            $affichage = $module->afficheMod();
            break;
        case "mod_admin":
            require_once("modules/admin/mod_admin.php");
            $module = new ModAdmin;
            $affichage = $module->afficheMod();
            break;
        case "mod_footer":
            require_once("modules/footer/mod_footer.php");
            $module = new ModFooters;
            $affichage = $module->afficheMod();
            break;
        default :
            require_once("modules/home/mod_home.php");
            $module = new ModHome;
            $affichage = $module->afficheMod();
            break;
    }
    $menu = new CompMenu();
    $footer = new CompFooter();
    include("template.php");
?>