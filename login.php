<?php
    session_start();
    //var_dump($_POST);
    $_SESSION["loginError"] = false;

    //var_dump($_SESSION);

    if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
    {
        session_destroy(); // déconnection
    }
    else
    {
        include_once("Database.php");
        $database = new Database();

        if (array_key_exists("userName", $_POST) && $database->userExist($_POST["userName"])) // on vérifie si l'utilisateur existe // sinon on empeche la connection
        {
            if (array_key_exists("userPassword", $_POST) && $database->verifyPassword($_POST["userName"], $_POST["userPassword"])) // on verrifie le mot de pass
            {
                $_SESSION["loged_in"] = true;
                $_SESSION["userName"] = $_POST["userName"];
                $userLVL = (int) $database->getUserRight($_POST["userName"]);
                $_SESSION["userPermissionsNumber"] = $userLVL;

                switch ($userLVL) { // on set les permissions
                    case ($userLVL >= 100):
                        //var_dump($userLVL);
                        $_SESSION["userPermissions"] = "superAdmin";
                        //var_dump($_SESSION["userPermissions"]);
                        break;
                        
                    case ($userLVL >= 75):
                        $_SESSION["userPermissions"] = "admin";
                        break;

                    case ($userLVL >= 50):
                        $_SESSION["userPermissions"] = "user";
                        break;

                    case ($userLVL > 0):
                        $_SESSION["userPermissions"] = "noRight";
                        break;

                    default:
                        $_SESSION["userPermissions"] = "not set";
                        break;
                }
            }
            else 
            {
                $_SESSION["loginError"] = true;
            }
        }
        else
        {
            $_SESSION["loginError"] = true;
        }
    }

    //var_dump($_SESSION);

    header('Location: index.php?controller=teacher&action=list');
?>

<a href="index.php?controller=teacher&action=list">retour</a>