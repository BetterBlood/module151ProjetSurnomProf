<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page update, gère la modification de section dans la database (appel editSection.php si nécessaire)
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
?>

<div class="container">
    <h4>Modifier une Section</h4>

    <?php
        if (isset($section))
        {
            $_SESSION["sectionInModification"] = $section;
            $_SESSION["idSectionInModification"] = $section["idSection"];
        }
        else
        {
            echo '<h1>probleme !!!!</h1>';
        }
    ?>

    <form action="view/page/section/editSection.php" method="post">

        <div class="form-row" style="height: fit-content">
            <div class="form-group col-md-4 mb-3">
                <label for="secName">Nom</label>
                <?php
                    echo '<input type="text" class="form-control" name="secName" id="secName" placeholder="Elec" ' . 'value="' . $section["secName"] . '"';

                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "secName") !== false)
                    {
                        echo 'style="box-shadow:0 0 1em red"';
                    }

                    echo " >";
                ?>
            </div>
        </div>

        <div class="pull-right">
            <button type="submit" class="btn btn-primary mb-2">Modifier la section</button>
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=section&action=list" class="btn btn-warning">retour</a> <!-- TODO : faire du js pour un onclick qui clear $_SESSION["error"] et $_SESSION["teacherInModification"] -->
        </div>
        
    </form>
</div>