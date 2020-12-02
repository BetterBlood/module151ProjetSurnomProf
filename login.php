<?php
    session_start();
    var_dump($_POST);

    if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
    {
        $_SESSION["loged_in"] = false;
    }
    else
    {
        $_SESSION["loged_in"] = true;
        $_SESSION["userName"] = $_POST["userName"];
        $_SESSION["userPermissions"] = "user"; // TODO : modifier selon le get de la base de données
    }
    
    // faire la vérification a la base de donnée
?>

<a href="index.php?controller=teacher&action=list">retour</a>