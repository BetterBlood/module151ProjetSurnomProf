<?php
    $teacher = array();

    if (array_key_exists("name", $_POST) && $_POST["name"] != "") // TODO : modifier !!!!!
    {
        $teacher["name"] = $_POST["name"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("surname", $_POST)) // TODO : modifier !!!!!
    {
        $teacher["surname"] = $_POST["surname"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("gender", $_POST)) // TODO : modifier !!!!!
    {
        $teacher["gender"] = $_POST["gender"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("nickname", $_POST)) // TODO : modifier !!!!!
    {
        $teacher["nickname"] = $_POST["nickname"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("origineNickname", $_POST)) // TODO : modifier !!!!!
    {
        $teacher["origineNickname"] = $_POST["origineNickname"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    if (array_key_exists("section", $_POST)) // TODO : modifier !!!!!
    {
        $teacher["section"] = $_POST["section"];
    }
    else
    {
        header('Location: index.php?controller=teacher&action=addTeacher');
    }

    var_dump($teacher);
    // TODO : ajout a la base de donnée

?>