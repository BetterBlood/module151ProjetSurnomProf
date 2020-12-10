<div class="container">
    <h4>ajout de compte</h4>

    <?php
        // redirection vers la list des prof si jamais l'utilisateur n'a pas les droits nécessaires
        if (!array_key_exists("userPermissionsNumber", $_SESSION))
        {
            header('Location: ../../../index.php?controller=teacher&action=list');
        }
        else
        {
            $userLVL = $_SESSION["userPermissionsNumber"];
            
            if ($userLVL < 100)
            {
                header('Location: ../../../index.php?controller=teacher&action=list');
            }
        }

        $error = false;

        if (!$database->userExist($_POST["pseudo"]))
        {
            if (array_key_exists("pseudo", $_POST) && $_POST["pseudo"] != "" && $_POST["pseudo"] != " ") 
            {
                $user["useUsername"] = $_POST["pseudo"];
            }
            else
            {
                $error = true;
            }

            if (array_key_exists("password", $_POST) && $_POST["password"] != "" && strlen($_POST["password"]) > 1) 
            {
                $user["usePassword"] = $_POST["password"];
            }
            else
            {
                $error = true;
            }

            if (array_key_exists("right", $_POST) && $_POST["right"] > 0 && $_POST["right"] <= 100) 
            {
                $user["useAdminRight"] = $_POST["right"];
            }
            else
            {
                $error = true;
            }
        }


        if (!$error)
        {
            $database->insertUser($user); 
            header('Location: index.php?controller=user&action=manageUser&add=true');
        }
        else 
        {
            header('Location: index.php?controller=user&action=manageUser&add=false');
        }
    ?>