<div class="container">

	<h2>
		<?php
			echo $teacher['teaLastName'] . ' ' . $teacher['teaFirstName'];
		?>
	</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php
			echo '<p>Nom : ' . $teacher['teaLastName'] . '</p>';
            echo '<p>prénom : ' . $teacher['teaFirstName'] . '</p>';
            echo '<p>genre : ' . $teacher['teaGender'] . '</p>';
            echo '<p>surnom : ' . $teacher['teaNickname'] . '</p>';
			echo '<p>origine : ' . $teacher['teaNicknameOrigin'] . '</p>';
			
			$database = new Database();
			$section = $database->getOneSection($teacher['idSection']);
			echo '<p>Section : ' . $section['secName'] . '</p>'; 

		?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="\module151\index.php?controller=teacher&action=list">Retour à la liste des enseignants</a>
		</div>
	</div>
</div>