<div class="container">

	<h2>Liste des enseignants</h2>
	<div>
		<?php
			var_dump($_SESSION);

			if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
			{
				echo '<a href="index.php?controller=teacher&action=addTeacher"><button class="pull-right">ajouter un professeur</button></a>';
			}
			else
			{
				echo '<a onclick="confirm(\'Vous devez vous connecter pour pouvoir ajouter un prof\')" href="#"><button class="pull-right">ajouter un professeur</button></a>';
			}
		?>
	</div>
	
	<div class="row">
		<table class=" table table-striped">
		<tr>
			<th>Nom</th>
			<th>Surnom</th>
			<th>Option(s)</th>
		</tr>
		<?php
			// Affichage de chaque enseignant
			foreach ($teachers as $teacher) 
			{
				echo '<tr>';
				echo '<td>' . htmlspecialchars($teacher['teaLastName']) . " " .  htmlspecialchars($teacher['teaFirstName']) . '</td>';
				echo '<td>' . htmlspecialchars($teacher['teaNickname']) . '</td>';

				echo '<td>';
				// vérifier la connection :
				if ( array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
				{
					echo '<a href="index.php?controller=teacher&action=detail&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconLoupe.png" alt="image de loupe pour obtenir des informations supplémentaire sur l\'enseignant"></a>';
					echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="deleteTeacher.php?id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer l\'enseignant de la base de donnée"></a>';
					echo '<a href="index.php?controller=teacher&action=editTeacher&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconPencil.png" alt="image de loupe pour obtenir des informations supplémentaire sur l\'enseignant"></a>';
				}
				
				echo '</td></tr>';
			}
		?>

		</table>
	</div>
</div>