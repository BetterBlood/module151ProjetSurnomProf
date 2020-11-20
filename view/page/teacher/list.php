<div class="container">

	<h2>Liste des enseignants</h2>
	<div>
		<a href="index.php?controller=teacher&action=addTeacher"><button class=pull-right>ajouter un professeur</button></a>
	</div>
	
	<div class="row">
		<table class=" table table-striped">
		<tr>
			<th>Nom</th>
			<th>Surnom</th>
			<th>Option</th>
		</tr>
		<?php

			include_once("Database.php");
			$database = new Database();
			$teachers = $database->getAllTeachers();

			// Affichage de chaque enseignant
			foreach ($teachers as $teacher) {
				echo '<tr>';
				echo '<td>' . htmlspecialchars($teacher['teaLastName']) . " " .  htmlspecialchars($teacher['teaFirstName']) . '</td>';
				echo '<td>' . htmlspecialchars($teacher['teaNickname']) . '</td>';
				echo '<td>' . '<a href="index.php?controller=teacher&action=detail&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconLoupe.png" alt="image de loupe pour obtenir des informations supplémentaire sur l\'enseignat"></a></td>';
				echo '</tr>';
			}
		?>

		</table>
	</div>
</div>