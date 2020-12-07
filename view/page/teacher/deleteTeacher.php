<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page delete, gère la suppression de teacher dans la database
 */
    session_start();

    include_once("../../../Database.php");
    $database = new Database();

    if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75 &&  array_key_exists("id", $_GET))
    {
        $database->deleteTeacher($_GET["id"]);
        header('Location: ../../../index.php?controller=teacher&action=list&delete=true');
    }
    else
    {
        header('Location: ../../../index.php?controller=teacher&action=list&delete=false');
    }
?>