<div class="container">
    <h4>Suppression de compte</h4>

    <?php
        if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100)
        {
            if (array_key_exists("id", $_GET))
            {
                include_once("../model/Database.php");
                $database = new Database();

                if ($database->userExist($_GET["id"]))
                {
                    $database->deleteUser($_GET["id"]);
                    header('Location: index.php?controller=user&action=manageUser&delete=true');
                }
                else
                {
                    header('Location: index.php?controller=user&action=manageUser&delete=false');
                }
            }
            else
            {
                header('Location: index.php?controller=user&action=manageUser&delete=false');
            }
        }
        else
        {
           header('Location: index.php?controller=teacher&action=list&delete=false');
        }
    
    ?>

</div>