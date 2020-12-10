<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page add, gère l'ajout de user dans la database (appel insertUser.php si nécessaire)
-->

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
?>

<div class="container">
    <h4>Ajouter un Compte</h4>

    <form action="index.php?controller=user&action=insertUser" method="post">

        <div>
            <div class="form-group col-md-4 mb-3">
                <label for="pseudo">Pseudo</label>
                <?php
                    echo '<input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="pseudo">';
                ?>
            </div>

            <div class="form-group col-md-4 mb-3" style="width:fit-content">
                <label for="password">Password</label>
                <?php
                    echo '<input type="password" class="form-control" name="password" id="password">';
                ?>
            </div>

            <div class="form-group col-md-4 mb-3" style="width:fit-content">
                <label for="right">Right</label>
                <?php
                    echo '<input type="number" class="form-control" name="right" id="right" placeholder="50" min="1" max="100">';
                ?>
            </div>
        </div>

        <div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary mb-2">Ajouter compte</button>
            </div>

            <div class="pull-right" style="margin-right: 15px">
                <a href="index.php?controller=user&action=manageUsers" class="btn btn-warning">retour</a> <!-- TODO : faire du js pour un onclick qui clear les variables de la session (pas toutes)-->
            </div>
        </div>
    </form>
</div>