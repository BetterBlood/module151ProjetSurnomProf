<div class="container">
    <h4>Ajouter un enseignant</h4>

    <form action="InsertTeacher.php" method="post">

        <div class="form-row">
            <div class="form-group col-md-4 mb-3">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Laurent">
            </div>

            <div class="form-group col-md-4 mb-3">
                <label for="surname">Prénom</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Duding">
            </div>

            <div class="form-group col-md-4 mb-3">
                <label>Genre</label>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="m" value="m">
                    <label class="form-check-label" for="m">Homme</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="w" value="w">
                    <label class="form-check-label" for="w">Femme</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="o" value="o">
                    <label class="form-check-label" for="o">Autre</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="nickname">Surnom</label>
            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Ding Dgin Ding">
        </div>

        <div class="form-group">
            <label for="origineNickname">Origine du surnom</label>
            <textarea class="form-control" id="origineNickname" name="origineNickname" rows="3"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label for="section">State</label>
            <select id="section" name="section" class="form-control">
                <option value="-1" selected>Aucune</option>
                <?php
                    foreach ($sections as $section) {
                        echo '<option value="' . $section["idSection"] . '">' . $section["secName"] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="pull-right">
            <button type="submit" class="btn btn-primary mb-2">ajouter enseignant</button>
        </div>

    </form>
</div>