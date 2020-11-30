<?php
    $erase = false;

    if (array_key_exists("reload", $_GET) && $_GET["reload"] === "true")
    {
        $erase = true;

        if (array_key_exists("surname", $_SESSION))
        {
            unset($_SESSION["surname"]);
        }
        if (array_key_exists("firstname", $_SESSION))
        {
            unset($_SESSION["firstname"]);
        }
        if (array_key_exists("gender", $_SESSION))
        {
            unset($_SESSION["gender"]);
        }
        if (array_key_exists("nickname", $_SESSION))
        {
            unset($_SESSION["nickname"]);
        }
        if (array_key_exists("origineNickname", $_SESSION))
        {
            unset($_SESSION["origineNickname"]);
        }
        if (array_key_exists("section", $_SESSION))
        {
            unset($_SESSION["section"]);
        }
        if (array_key_exists("error", $_SESSION))
        {
            unset($_SESSION["error"]);
        }
    }
?>

<div class="container">
    <h4>Ajouter un enseignant</h4>

    <?php
        // DEBUG
        /*if (array_key_exists("error", $_SESSION))
        { 
            echo "test";
            var_dump($_SESSION);
            echo "test";
        } // */
    ?>

    <form action="insertTeacher.php" method="post">

        <div class="form-row">
            <div class="form-group col-md-4 mb-3">
                <label for="name">Nom</label>
                <?php
                    echo '<input type="text" class="form-control" name="name" id="name" placeholder="Laurent" ';

                    if (array_key_exists("surname", $_SESSION) && !$erase) {
                        echo 'value="' . $_SESSION["surname"] . '"';
                    }

                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "surname") !== false)
                    {
                        echo 'style="box-shadow:0 0 1em red"';
                    }

                    echo " >";
                ?>
            </div>

            <div class="form-group col-md-4 mb-3">
                <label for="firstname">Prénom</label>
                <?php
                    echo '<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Duding" ';

                    if (array_key_exists("firstname", $_SESSION) && !$erase)
                    {
                        echo 'value="' . $_SESSION["firstname"] . '"';
                    }

                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "firstname") !== false)
                    {
                        echo 'style="box-shadow:0 0 1em red"';
                    }

                    echo '>';
                ?>
            </div>

            
               <div class="form-group col-md-4 mb-3" >
                
                <label>Genre</label>
                <?php

                echo '<div class="form-check-inline"';
                
                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "gender") !== false)
                    {
                        echo 'style="box-shadow: inset 0 0 1em red, 0 0 1em red"';
                    }
                    echo '>';
                    
                        echo '<input class="form-check-input" type="radio" name="gender" id="m" value="m" ';

                        if (array_key_exists("gender", $_SESSION) && !$erase && $_SESSION["gender"] == "m")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="m">Homme</label>
                
                    <?php
                        echo '<input class="form-check-input" type="radio" name="gender" id="w" value="w" ';

                        if (array_key_exists("gender", $_SESSION) && !$erase && $_SESSION["gender"] == "w")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="w">Femme</label>
                
                    <?php
                        echo '<input class="form-check-input" type="radio" name="gender" id="o" value="o" ';

                        if (array_key_exists("gender", $_SESSION) && !$erase && $_SESSION["gender"] == "o")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="o">Autre</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="nickname">Surnom</label>
            <?php
                echo '<input type="text" class="form-control" name="nickname" id="nickname" placeholder="Ding Dgin Ding" ';

                if (array_key_exists("nickname", $_SESSION) && !$erase)
                {
                    echo 'value="' . $_SESSION["nickname"] . '" ';
                }

                if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "nickname") !== false)
                {
                    echo 'style="box-shadow: 0 0 1em red" ';
                }

                echo 'aria-describedby="nicknameHelpLine">';
            ?>
            <small id="nicknameHelpLine" class="text-muted">
                Some funny one
            </small>
        </div>

        <div class="form-group">
            <label for="origineNickname">Origine du surnom</label>
            <?php
                echo '<textarea class="form-control" name="origineNickname" id="origineNickname" placeholder="il a sonné l\'heure" rows="3" ';

                if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "origineNickname") !== false)
                {
                    echo 'style="box-shadow: 0 0 1em red" ';
                }
                echo '>';
                
                if (array_key_exists("origineNickname", $_SESSION) && !$erase)
                {
                    echo $_SESSION["origineNickname"];
                }

                echo '</textarea>';
            ?>
        </div>

        <div class="form-group col-md-4">
            <label for="section">Section</label>
            <select id="section" name="section" class="form-control" 
                <?php if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "section") !== false)
                    {
                        echo 'style="box-shadow: 0 0 1em red" ';
                    }
                ?>
                >
                <?php
                    echo '<option value="-1" ';

                    if (array_key_exists("section", $_SESSION) && $_SESSION["section"] == "-1")
                    {
                        echo 'selected';
                    }
                    
                    echo '</option>';

                    foreach ($sections as $section) {
                        echo '<option value="' . $section["idSection"] . '"';

                        if (array_key_exists("section", $_SESSION) && !$erase && $_SESSION["section"] == $section["idSection"])
                        {
                            echo 'selected';
                        }
                        
                        echo '>' . $section["secName"] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="pull-right">
            <button type="submit" class="btn btn-primary mb-2">Ajouter enseignant</button>
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=teacher&action=list" class="btn btn-warning">retour</a> <!-- TODO : faire du js pour un onclick qui clear les variables de la session (pas toutes)-->
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=teacher&action=addTeacher&reload=true" class="btn btn-danger">Annuler</a>
        </div>

        

    </form>
</div>