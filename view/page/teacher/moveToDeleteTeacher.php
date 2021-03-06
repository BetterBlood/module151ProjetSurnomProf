<?php
/**
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 17.12.2020
 * page modifTeaIsDeleted, gère la modification du champ teaIsDeleted de teacher dans la database
 */
    session_start();

    // redirection vers la list des prof si jamais l'utilisateur n'a pas les droits nécessaires
    if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75 && array_key_exists("id", $_GET) && array_key_exists("delete", $_GET))
    {
        include_once("../../../model/Database.php");
        $database = new Database();
        $database->moveTeacherToDeleted($_GET["id"], $_GET["delete"]);

        if ($_GET["delete"] == "true")
        {
            header('Location: ../../../index.php?controller=teacher&action=list&modif=true'); 
        }
        else
        {
            header('Location: ../../../index.php?controller=teacher&action=archiveList&modif=true'); 
        }
    }
    else
    {
        header('Location: ../../../index.php?controller=teacher&action=list&modif=false');
    }
?>