<div class="container">

	<h2>Liste des Sections</h2>
	<div class="pull-right">
		<?php
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
			<th>Nombre de prof dans la section</th>
            <th>Options</th>
		</tr>
		<?php
			// Affichage de chaque enseignant
			foreach ($sections as $section) 
			{
				echo '<tr>';
                echo '<td>' . htmlspecialchars($section['secName']) . '</td>';
				echo '<td>' . htmlspecialchars($section['nbrTeacher']) . '</td>';

                echo '<td>';
				// vérifier la connection :
				if ( array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
				{
					echo '<a href="index.php?controller=section&action=detail&id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconLoupe.png" alt="image de loupe pour obtenir des informations supplémentaire sur la section"></a>';
					
					if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75)
					{
						if ($_SESSION["userPermissionsNumber"] >= 100)
						{
							echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="view/page/section/deleteSection.php?id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer la section de la base de donnée"></a>';
						}
						echo '<a href="index.php?controller=section&action=editSection&id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconPencil.png" alt="image de crayon pour modifier la section"></a>';
					}
				}
				
				echo '</td></tr>';
            }
		?>

		</table>
	</div>
</div>