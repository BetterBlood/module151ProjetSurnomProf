<div class="container">

	<h2>Liste des enseignants</h2>
	<div class="pull-right">
		<?php
			//var_dump($_SESSION);

			if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"] && array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 50) 
			{
				echo '<a class="btn btn-info" href="index.php?controller=teacher&action=addTeacher">ajouter un professeur</a>';
				echo '<a class="btn btn-info" href="index.php?controller=section&action=list">liste des sections</a>'; // accès a la liste des sections

				if ($_SESSION["userPermissionsNumber"] >= 75) // visibilité de la modification de l'état teaIsDeleted des enseignants
				{
					if(isset($deletedTeacher) && $deletedTeacher)
					{
						echo '<a class="btn btn-success" href="index.php?controller=teacher&action=restoreArchiveList&restoreAll=true">tout restaurer</a>';  // bouton réstaurer
					}
					else
					{
						echo '<a class="btn btn-warning" href="index.php?controller=teacher&action=archiveList">prof supprimés</a>'; // bouton pour accèder aux prof présupprimé
					}
					
				}

				if ($_SESSION["userPermissionsNumber"] >= 100) // visibilité du managment des users
				{
					echo '<a class="btn btn-danger" href="index.php?controller=user&action=manageUsers">manage Users</a>';
				}
			}
			else
			{
				echo '<a class="btn btn-info" onclick="confirm(\'Une élévation est nécessaire\')" href="#">ajouter un professeur</a>';
				echo '<a class="btn btn-info" href="index.php?controller=section&action=list">liste des sections</a>'; // accès a la liste des sections
			}
		?>
	</div>
	
	<div class="row">
		<table class="table table-striped">
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
					if (isset($deletedTeacher) && $deletedTeacher) // affichage des enseignants delete
					{
						if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75)
						{
							echo '<a href="view/page/teacher/moveToDeleteTeacher.php?id=' . htmlspecialchars($teacher['idTeacher']) . '&delete=false"><img style="width:33px" src="resources/image/restore.png" alt="image de restauration pour restaurer l\'enseignant de la base de donnée"></a>';
							echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="view/page/teacher/deleteTeacher.php?id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconDefinitiveTrash.png" alt="image de poubelle pour supprimer définitivement l\'enseignant de la base de donnée"></a>';
						}
					}
					else // affichage des enseignants non delete
					{
						echo '<a href="index.php?controller=teacher&action=detail&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconLoupe.png" alt="image de loupe pour obtenir des informations supplémentaire sur l\'enseignant"></a>';
					
						if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75)
						{
							echo '<a href="view/page/teacher/moveToDeleteTeacher.php?id=' . htmlspecialchars($teacher['idTeacher']) . '&delete=true"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer l\'enseignant de la base de donnée"></a>';
							echo '<a href="index.php?controller=teacher&action=editTeacher&id=' . htmlspecialchars($teacher['idTeacher']) . '"><img src="resources/image/iconPencil.png" alt="image de crayon pour modifier l\'enseignant"></a>';
						}
					}
				}
				
				echo '</td></tr>';
			}
		?>

		</table>
	</div>
</div>