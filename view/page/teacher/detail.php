<div class="container">

	<h2>
		<?php
			echo $teacher['teaLastName'] . ' ' . $teacher['teaFirstName'];
		?>
	</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<div class="pull-right">
				<?php

				if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75)
				{
					echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="deleteTeacher.php?id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer l\'enseignant de la base de donnée"></a>';
					echo '<a href="index.php?controller=teacher&action=editTeacher&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconPencil.png" alt="image de loupe pour obtenir des informations supplémentaire sur l\'enseignant"></a>';
				}

				?>
			</div>
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