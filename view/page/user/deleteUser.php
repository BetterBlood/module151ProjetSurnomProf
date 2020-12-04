<div class="container">
    <h4>Suppression de compte</h4>

    <?php
        include_once("Database.php");
        $database = new Database();
    
        if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100 &&  array_key_exists("id", $_GET))
        {
            $database->deleteUser($_GET["id"]);
            header('Location: index.php?controller=user&action=manageUser&delete=true');
        }
        else
        {
           header('Location: index.php?controller=user&action=manageUser&delete=false');
        }
    
    ?>

</div>