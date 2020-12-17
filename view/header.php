
<div class="container">
    <div class="pull-right">
        <form action="view/page/user/login.php" method="post">
            <div class="form-row form-inline" style="height:fit-content">
                <?php 
                    
                    
                    if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"]) // si on est login
                    {
                        ?>
                        <div class="form-group col-md-4 mb-3" style="width:fit-content">
                            <?php
                                echo $_SESSION["userName"] . ' (' . $_SESSION["userPermissions"] . ')';
                            ?>
                        </div>

                        <div class="form-group col-md-4 mb-3">
                            <button type="submit" class="btn btn-warning mb-2">Se déconnecter</button>
                        </div>

                        <?php
                    }
                    else // si on est pas login
                    {
                        if (array_key_exists("loginError", $_SESSION) && $_SESSION["loginError"]) // affichage d'une erreur de login
                        {
                            ?>

                            <div class="form-group col-md-4 mb-3">
                                <input type="text" class="form-control" name="userName" id="userName" placeholder="Login" style="box-shadow:0 0 1em red">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Mot de Passe" style="box-shadow:0 0 1em red">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <button type="submit" class="btn btn-info mb-2">Se connecter</button>
                            </div>

                            <?php
                        }
                        else // affichage normal du login
                        {
                            ?>

                            <div class="form-group col-md-4 mb-3">
                                <input type="text" class="form-control" name="userName" id="userName" placeholder="Login">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Mot de Passe">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <button type="submit" class="btn btn-info mb-2">Se connecter</button>
                            </div>

                            <?php
                        }
                    }
                ?>
            </div>
        </form>
    </div>

    <div class="masthead">
        <h3 class="text-muted">Surnom des enseignants</h3>
