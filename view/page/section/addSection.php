<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page add, gère l'ajout de section dans la database (appel insertSection.php si nécessaire)
-->
<?php

    // redirection vers la list des sections si jamais l'utilisateur n'a pas les droits nécessaires
    if (!array_key_exists("userPermissionsNumber", $_SESSION))
    {
        header('Location: ../../../index.php?controller=section&action=list');
    }
    else
    {
        $userLVL = $_SESSION["userPermissionsNumber"];
        
        if ($userLVL < 75) // niveau admin
        {
            header('Location: ../../../index.php?controller=section&action=list');
        }
    }

    $erase = false;

    if (array_key_exists("reload", $_GET) && $_GET["reload"] === "true")
    {
        $erase = true;

        if (array_key_exists("sectionName", $_SESSION))
        {
            unset($_SESSION["sectionName"]);
        }
        if (array_key_exists("error", $_SESSION))
        {
            unset($_SESSION["error"]);
        }
    }
    
?>

<div class="container">
    <h4>Ajouter une Section</h4>

    <form action="view/page/section/insertSection.php" method="post"> 

        <div class="form-row" style="height: fit-content">
            <div class="form-group col-md-4 mb-3">
                <label for="sectionName">Nom de la Section</label>
                <?php
                    echo '<input type="text" class="form-control" name="sectionName" id="sectionName" placeholder="Informatique" ';

                    if (array_key_exists("sectionName", $_SESSION) && !$erase) {
                        echo 'value="' . $_SESSION["sectionName"] . '"';
                    }

                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "sectionName") !== false)
                    {
                        echo 'style="box-shadow:0 0 1em red"';
                    }

                    echo " >";
                ?>
            </div>
        </div>


        <div class="pull-right">
            <button type="submit" class="btn btn-primary mb-2">Ajouter la section</button>
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=section&action=list" class="btn btn-warning">retour</a> <!-- TODO : faire du js pour un onclick qui clear les variables de la session (pas toutes)-->
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=section&action=addSection&reload=true" class="btn btn-danger">Annuler</a>
        </div>

        

    </form>
</div>