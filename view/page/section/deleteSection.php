<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page delete, gère la suppression de section dans la database
 */
    session_start();

    // redirection vers la list des sections si jamais l'utilisateur n'a pas les droits nécessaires
    if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100 &&  array_key_exists("id", $_GET))
    {
        include_once("../../../Database.php");
        $database = new Database();
        
        if ($database->deleteSection($_GET["id"]))
        {
            header('Location: ../../../index.php?controller=section&action=list&delete=true');
        }
        else
        {
            header('Location: ../../../index.php?controller=section&action=list&delete=false');
        }
    }
    else
    {
        header('Location: ../../../index.php?controller=section&action=list&delete=false');
    }
?>