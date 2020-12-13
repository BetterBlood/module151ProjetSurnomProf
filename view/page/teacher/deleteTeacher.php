<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page delete, gère la suppression de teacher dans la database
 */
    session_start();

    // redirection vers la list des prof si jamais l'utilisateur n'a pas les droits nécessaires
    if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75 &&  array_key_exists("id", $_GET))
    {
        include_once("../../../model/Database.php");
        $database = new Database();
        $database->deleteTeacher($_GET["id"]);

        header('Location: ../../../index.php?controller=teacher&action=list&delete=true');
    }
    else
    {
        header('Location: ../../../index.php?controller=teacher&action=list&delete=false');
    }
?>