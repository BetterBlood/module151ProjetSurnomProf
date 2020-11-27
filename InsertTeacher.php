<?php
    session_start();

    $teacher = array();
    $error = false;

    // TODO : ptetre voir s'il faut faire des pregmatch, etc avec des vérification de string
    $_POST["error"] = "";

    if (array_key_exists("name", $_POST) && $_POST["name"] != "" && $_POST["name"] != " ") 
    {
        $teacher["name"] = $_POST["name"];
        $_SESSION["name"] = $_POST["name"];
    }
    else
    {
        $_POST["error"] = "name";
        $error = true;
    }

    $_POST["error"] += ",";

    if (array_key_exists("firstname", $_POST) && $_POST["firstname"] != "" && $_POST["firstname"] != " ")
    {
        $teacher["firstname"] = $_POST["firstname"];
        $_SESSION["firstname"] = $_POST["firstname"];
    }
    else
    {
        $_POST["error"] = "firstname";
        $error = true;
    }

    $_POST["error"] += ",";

    if (array_key_exists("gender", $_POST) && ($_POST["gender"] == 'm' || $_POST["gender"] == 'w' || $_POST["gender"] == 'o'))
    {
        $teacher["gender"] = $_POST["gender"];
        $_SESSION["gender"] = $_POST["gender"];
    }
    else
    {
        $_POST["error"] = "gender";
        $error = true;
    }

    $_POST["error"] += ",";

    if (array_key_exists("nickname", $_POST) && $_POST["nickname"] != "" && $_POST["nickname"] != " ")
    {
        $teacher["nickname"] = $_POST["nickname"];
        $_SESSION["nickname"] = $_POST["nickname"];
    }
    else
    {
        $_POST["error"] = "nickname";
        $error = true;
    }

    $_POST["error"] += ",";

    if (array_key_exists("origineNickname", $_POST) && $_POST["origineNickname"] != "" && $_POST["origineNickname"] != " ")
    {
        $teacher["origineNickname"] = $_POST["origineNickname"];
        $_SESSION["origineNickname"] = $_POST["origineNickname"];
    }
    else
    {
        $_POST["error"] = "origineNickname";
        $error = true;
    }

    $_POST["error"] += ",";

    if (array_key_exists("section", $_POST) && $_POST["section"] != "-1" && $_POST["section"] != "0")
    {
        $teacher["section"] = (int)$_POST["section"];
        $_SESSION["section"] = $_POST["section"];
    }
    else
    {
        $_POST["error"] += "section";
        $error = true;
    }

    //var_dump($_POST);

    //var_dump($teacher);

    if (!$error)
    {
        include_once("Database.php");
        $database = new Database();
        $database->insertTeacher($teacher);
        header('Location: index.php?controller=teacher&action=list');
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }
    

?>