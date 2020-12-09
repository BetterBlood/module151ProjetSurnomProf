<?php
    session_start();
?>

<!DOCTYPE html>
<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page insert, gère l'insertion de section dans la database
-->
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>insertSection</title>
    </head>
    <body>
        <?php

            $section = array();
            $error = false;

            // TODO : ptetre voir s'il faut faire des pregmatch, etc avec des vérifications de string
            $_SESSION["error"] = "";

            if (array_key_exists("sectionName", $_POST) && $_POST["sectionName"] != "" && $_POST["sectionName"] != " ") 
            {
                $section["sectionName"] = $_POST["sectionName"];
                $_SESSION["sectionName"] = $_POST["sectionName"];
            }
            else
            {
                $_SESSION["error"] .= "sectionName";
                $error = true;
            }

            if (!$error)
            {
                include_once("../../../Database.php");
                $database = new Database();
                $database->insertSection($section); // TODO : ptetre faire une vérification de l'ajout et si réussi effacer les variable de session

                if (array_key_exists("sectionName", $_SESSION))
                {
                    unset($_SESSION["sectionName"]);
                }
                if (array_key_exists("error", $_SESSION))
                {
                    unset($_SESSION["error"]);
                }
                
                header('Location: ../../../index.php?controller=section&action=list');
            }
            else
            {
                header('Location: ../../../index.php?controller=section&action=addSection');
            }
        ?>
    </body>
</html>