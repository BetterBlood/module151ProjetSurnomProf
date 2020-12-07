<!--
 * ETML
 * Auteur : Jeremiah Steiner
 * Date: 22.11.2020
 * page update, gère la modification de teacher dans la database (appel editTeacher.php si nécessaire)
-->

<?php
    $erase = false;
?>

<div class="container">
    <h4>Modifier un enseignant</h4>

    <?php
        // DEBUG
        /*if (array_key_exists("error", $_SESSION))
        { 
            echo "debugstart";
            var_dump($_SESSION);
            echo "debugend";
        } // */

        if (isset($teacher))
        {
            $_SESSION["teacherInModification"] = $teacher;
            $_SESSION["idTeacherInModification"] = $teacher["idTeacher"];
        }
        else
        {
            echo '<h1>probleme !!!!</h1>';
        }
    ?>

    <form action="editTeacher.php" method="post">

        <div class="form-row" style="height: fit-content">
            <div class="form-group col-md-4 mb-3">
                <label for="name">Nom</label>
                <?php
                    echo '<input type="text" class="form-control" name="name" id="name" placeholder="Laurent" ' . 'value="' . $teacher["teaLastName"] . '"';

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
                    echo '<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Duding" ' . 'value="' . $teacher["teaFirstName"] . '"';

                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "firstname") !== false)
                    {
                        echo 'style="box-shadow:0 0 1em red"';
                    }

                    echo '>';
                ?>
            </div>

            
            <div class="form-group col-md-4 mb-3" >
                
                <label style="height: 30px">Genre</label>
                <?php

                echo '<div class="form-check-inline" ';
                
                    if (array_key_exists("error", $_SESSION) && strpos($_SESSION["error"], "gender") !== false)
                    {
                        echo 'style="box-shadow: inset 0 0 1em red, 0 0 1em red"';
                    }
                    echo '>';
                    
                        echo '<input class="form-check-input" type="radio" name="gender" id="m" value="m" ';

                        if (array_key_exists("teaGender", $teacher) && !$erase && $teacher["teaGender"] == "m")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="m">Homme</label>
                
                    <?php
                        echo '<input class="form-check-input" type="radio" name="gender" id="w" value="w" ';

                        if (array_key_exists("teaGender", $teacher) && !$erase && $teacher["teaGender"] == "w")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="w">Femme</label>
                
                    <?php
                        echo '<input class="form-check-input" type="radio" name="gender" id="o" value="o" ';

                        if (array_key_exists("teaGender", $teacher) && !$erase && $teacher["teaGender"] == "o")
                        {
                            echo 'checked';
                        }

                        echo '>';
                    ?>
                    <label class="form-check-label" for="o">Autre</label>
                </div>
            </div>
        </div>

        <div class="form-row" style="height:fit-content">
            <div class="form-group">
                <label for="nickname">Surnom</label>
                <?php
                    echo '<input type="text" class="form-control" name="nickname" id="nickname" placeholder="Ding Dgin Ding" ';

                    if (array_key_exists("teaNickname", $teacher) && !$erase)
                    {
                        echo 'value="' . $teacher["teaNickname"] . '" ';
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
                    
                    if (array_key_exists("teaNicknameOrigin", $teacher) && !$erase)
                    {
                        echo $teacher["teaNicknameOrigin"];
                    }

                    echo '</textarea>';
                ?>
            </div>
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

                    if (array_key_exists("idSection", $teacher) && $teacher["idSection"] == "-1")
                    {
                        echo 'selected';
                    }
                    
                    echo '>aucune</option>';

                    foreach ($sections as $section) {
                        echo '<option value="' . $section["idSection"] . '"';

                        if (array_key_exists("idSection", $teacher) && !$erase && $teacher["idSection"] == $section["idSection"])
                        {
                            echo 'selected';
                        }
                        
                        echo '>' . $section["secName"] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="pull-right">
            <button type="submit" class="btn btn-primary mb-2">Modifier l'enseignant</button>
        </div>

        <div class="pull-right" style="margin-right: 15px">
            <a href="index.php?controller=teacher&action=list" class="btn btn-warning">retour</a> <!-- TODO : faire du js pour un onclick qui clear $_SESSION["error"] et $_SESSION["teacherInModification"] -->
        </div>
    </form>
</div>