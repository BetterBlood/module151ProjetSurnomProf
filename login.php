<?php
    session_start();
    var_dump($_POST);

    if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
    {
        $_SESSION["loged_in"] = false;
    }
    else
    {
        // vérifier que l'user exist :
            //parcourir les users et voir si correspondance 
            // si correspond vérifier password
                // si correspond >> login !!! 
                //erreur de login !!
            //erreur de login !!
        include_once("Database.php");
        $database = new Database();

        if ($database->userExist($_POST["userName"]))
        {
            if ($database->verifyPassword($_POST["userName"], $_POST["userPassword"]))
            {
                $_SESSION["loged_in"] = true;
                $_SESSION["userName"] = $_POST["userName"];
                $_SESSION["userPermissionsNumber"] = $database->getUserRight($_POST["userName"]);

                switch ($_SESSION["userPermissionsNumber"]) {
                    case 100:
                        $_SESSION["userPermissions"] = "admin";
                        break;
                    case 50:
                        $_SESSION["userPermissions"] = "user";
                        break;
                    case 0:
                        $_SESSION["userPermissions"] = "noRight";
                        break;
                    default:
                        $_SESSION["userPermissions"] = "not set";
                        break;
                }
            }
            else 
            {
                echo 'erreur de login !';
            }
        }
        else
        {
            echo 'erreur de login !';
        }

        var_dump($_SESSION);
    }
?>

<a href="index.php?controller=teacher&action=list">retour</a>