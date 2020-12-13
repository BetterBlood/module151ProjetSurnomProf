<?php
    session_start();
?>

<!DOCTYPE html>
<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page edit, gère l'édition de teacher dans la database
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>editTeacher</title>
    </head>

    <body>
        <?php
        
        // redirection vers la list des sections si jamais l'utilisateur n'a pas les droits nécessaires
        if (!array_key_exists("userPermissionsNumber", $_SESSION))
        {
            header('Location: ../../../index.php?controller=section&action=list');
        }
        else
        {
            $userLVL = $_SESSION["userPermissionsNumber"];
            
            if ($userLVL < 75) // niveau admin
            {
                header('Location: ../../../index.php?controller=section&action=list');
            }
        }

        $section = array();
        $error = false;

        // TODO : ptetre voir s'il faut faire des pregmatch, etc avec des vérification de string
        $_SESSION["error"] = "";

        if (array_key_exists("secName", $_POST) && $_POST["secName"] != "" && $_POST["secName"] != " ") 
        {
            $section["secName"] = $_POST["secName"];
            $_SESSION["secName"] = $_POST["secName"];
        }
        else
        {
            $_SESSION["error"] .= "secName";
            $error = true;
        }

        if (!$error) // pas d'erreurs, les modifications vont être enregistrées
        {
            include_once("../../../model/Database.php");
            $database = new Database();
            $database->editSection($_SESSION["idSectionInModification"], $section); // TODO : ptetre faire une vérification de l'ajout et si réussi effacer les variable de session

            if (array_key_exists("secName", $_SESSION))
            {
                unset($_SESSION["secName"]);
            }
            if (array_key_exists("error", $_SESSION))
            {
                unset($_SESSION["error"]);
            }

            if (array_key_exists("idSectionInModification", $_SESSION))
            {
                unset($_SESSION["idSectionInModification"]);
            }
            if (array_key_exists("sectionInModification", $_SESSION))
            {
                unset($_SESSION["sectionInModification"]);
            }
            
            header('Location: ../../../index.php?controller=section&action=list');
        }
        else
        {
            if (array_key_exists("sectionInModification", $_SESSION))
            {
                unset($_SESSION["sectionInModification"]);
            }
            header('Location: ../../../index.php?controller=section&action=editSection&id=' . $_SESSION["idSectionInModification"]);
        }
        ?>
    </body>
</html>