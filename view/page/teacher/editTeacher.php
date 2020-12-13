<?php
    session_start();

    // redirection vers la list des prof si jamais l'utilisateur n'a pas les droits nécessaires
    if (!array_key_exists("userPermissionsNumber", $_SESSION))
    {
        header('Location: ../../../index.php?controller=teacher&action=list');
    }
    else
    {
        $userLVL = $_SESSION["userPermissionsNumber"];
        
        if ($userLVL < 75) // niveau admin
        {
            header('Location: ../../../index.php?controller=teacher&action=list');
        }
    }
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

        $teacher = array();
        $error = false;

        // TODO : ptetre voir s'il faut faire des pregmatch, etc avec des vérification de string
        $_SESSION["error"] = "";

        if (array_key_exists("name", $_POST) && $_POST["name"] != "" && $_POST["name"] != " ") 
        {
            $teacher["name"] = $_POST["name"];
            $_SESSION["surname"] = $_POST["name"];
        }
        else
        {
            $_SESSION["error"] .= "surname";
            $error = true;
        }

        $_SESSION["error"] .= ",";

        if (array_key_exists("firstname", $_POST) && $_POST["firstname"] != "" && $_POST["firstname"] != " ")
        {
            $teacher["firstname"] = $_POST["firstname"];
            $_SESSION["firstname"] = $_POST["firstname"];
        }
        else
        {
            $_SESSION["error"] .= "firstname";
            $error = true;
        }

        $_SESSION["error"] .= ",";

        if (array_key_exists("gender", $_POST) && ($_POST["gender"] == 'm' || $_POST["gender"] == 'w' || $_POST["gender"] == 'o'))
        {
            $teacher["gender"] = $_POST["gender"];
            $_SESSION["gender"] = $_POST["gender"];
        }
        else
        {
            $_SESSION["error"] .= "gender";
            $error = true;
        }

        $_SESSION["error"] .= ",";

        if (array_key_exists("nickname", $_POST) && $_POST["nickname"] != "" && $_POST["nickname"] != " ")
        {
            $teacher["nickname"] = $_POST["nickname"];
            $_SESSION["nickname"] = $_POST["nickname"];
        }
        else
        {
            $_SESSION["error"] .= "nickname";
            $error = true;
        }

        $_SESSION["error"] .= ",";

        if (array_key_exists("origineNickname", $_POST) && $_POST["origineNickname"] != "" && $_POST["origineNickname"] != " ")
        {
            $teacher["origineNickname"] = $_POST["origineNickname"];
            $_SESSION["origineNickname"] = $_POST["origineNickname"];
        }
        else
        {
            $_SESSION["error"] .= "origineNickname";
            $error = true;
        }

        $_SESSION["error"] .= ",";

        if (array_key_exists("section", $_POST) && $_POST["section"] != "-1" && $_POST["section"] != "0")
        {
            $teacher["section"] = (int)$_POST["section"];
            $_SESSION["section"] = $_POST["section"];
        }
        else
        {
            $_SESSION["error"] .= "section";
            $error = true;
        }

        //var_dump($_SESSION);

        //var_dump($teacher);

        if (!$error) // pas d'erreurs, les modifications vont être enregistrées
        {
            include_once("../../../model/Database.php");
            $database = new Database();
            $database->editTeacher($_SESSION["idTeacherInModification"], $teacher); // TODO : ptetre faire une vérification de l'ajout et si réussi effacer les variable de session

            if (array_key_exists("surname", $_SESSION))
            {
                unset($_SESSION["surname"]);
            }
            if (array_key_exists("firstname", $_SESSION))
            {
                unset($_SESSION["firstname"]);
            }
            if (array_key_exists("gender", $_SESSION))
            {
                unset($_SESSION["gender"]);
            }
            if (array_key_exists("nickname", $_SESSION))
            {
                unset($_SESSION["nickname"]);
            }
            if (array_key_exists("origineNickname", $_SESSION))
            {
                unset($_SESSION["origineNickname"]);
            }
            if (array_key_exists("section", $_SESSION))
            {
                unset($_SESSION["section"]);
            }
            
            if (array_key_exists("error", $_SESSION))
            {
                unset($_SESSION["error"]);
            }

            if (array_key_exists("idTeacherInModification", $_SESSION))
            {
                unset($_SESSION["idTeacherInModification"]);
            }
            if (array_key_exists("teacherInModification", $_SESSION))
            {
                unset($_SESSION["teacherInModification"]);
            }
            
            header('Location: ../../../index.php?controller=teacher&action=list');
        }
        else
        {
            if (array_key_exists("teacherInModification", $_SESSION))
            {
                unset($_SESSION["teacherInModification"]);
            }
            header('Location: ../../../index.php?controller=teacher&action=editTeacher&id=' . $_SESSION["idTeacherInModification"]);
        }
        ?>
    </body>
</html>