<div class="container">
    <h4>Suppression de compte</h4>

    <?php
        if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100)
        {
            if (array_key_exists("id", $_GET))
            {
                include_once("../model/Database.php");
                $database = new Database();
                $database->deleteUser($_GET["id"]); // TODO : voir si deleteUser() ne pourrait pas renvoyer un boolean

                header('Location: index.php?controller=user&action=manageUser&delete=true');
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