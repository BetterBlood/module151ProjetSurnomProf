<?php
    $teacher = array();

    // TODO : ptetre voir s'il faut faire des pregmatch, etc avec des vérification de string
    $_POST["error"] = "";

    if (array_key_exists("name", $_POST) && $_POST["name"] != "" && $_POST["name"] != " ") 
    {
        $teacher["name"] = $_POST["name"];
    }
    else
    {
        $_POST["error"] = "name";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("firstname", $_POST) && $_POST["firstname"] != "" && $_POST["firstname"] != " ")
    {
        $teacher["firstname"] = $_POST["firstname"];
    }
    else
    {
        $_POST["error"] = "firstname";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("gender", $_POST) && ($_POST["gender"] == 'm' || $_POST["gender"] == 'w' || $_POST["gender"] == 'o'))
    {
        $teacher["gender"] = $_POST["gender"];
    }
    else
    {
        $_POST["error"] = "gender";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("nickname", $_POST) && $_POST["nickname"] != "" && $_POST["nickname"] != " ")
    {
        $teacher["nickname"] = $_POST["nickname"];
    }
    else
    {
        $_POST["error"] = "nickname";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("origineNickname", $_POST) && $_POST["origineNickname"] != "" && $_POST["origineNickname"] != " ")
    {
        $teacher["origineNickname"] = $_POST["origineNickname"];
    }
    else
    {
        $_POST["error"] = "origineNickname";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("section", $_POST) && $_POST["section"] != "-1" && $_POST["section"] != "0")
    {
        $teacher["section"] = $_POST["section"];
    }
    else
    {
        $_POST["error"] = "section";
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    var_dump($_POST);

    var_dump($teacher);
    // TODO : ajout a la base de donnée
    if ($_POST["error"] == "")
    {
        include_once("Database.php");
        $database = new Database();
        $database->insertTeacher($teacher);
        header('Location: index.php?controller=teacher&action=list');
    }
    else
    {
        echo $_POST["error"];
    }
    

?>