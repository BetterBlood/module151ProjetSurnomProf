
<div class="container">
    <nav class="pull-right">
        <form action="view/page/user/login.php" method="post">
            <div class="form-row form-inline" style="height:fit-content">
                <?php 
                    if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"]) // array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"]
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
                    else 
                    {
                        if (array_key_exists("loginError", $_SESSION) && $_SESSION["loginError"])
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
                        else
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
    </nav>

    <div class="masthead">
        <h3 class="text-muted">Surnom des enseignants</h3>
