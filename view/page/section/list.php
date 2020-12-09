<div class="container">

	<h2>Liste des Sections</h2>
	<div>
		<?php
			//var_dump($_SESSION);

			if (array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"] && array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 50) // TODO : à vérifier s'il y a besoin de droit pour ajouter un prof
			{
				echo '<a href="index.php?controller=section&action=addSection"><button class="pull-right">ajouter une section</button></a>';

				if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 100)
				{
					echo '<a href="index.php?controller=user&action=manageUsers"><button class="pull-right">manage Users</button></a>';
				}
			}
			else
			{
				echo '<a onclick="confirm(\'Une élévation est nécessaire\')" href="#"><button class="pull-right">ajouter un professeur</button></a>';
			}
		?>
	</div>
	
	<div class="row">
		<table class="table table-striped">
		<tr>
            <th>Nom</th>
            <th>Options</th>
		</tr>
		<?php
			// Affichage de chaque enseignant
			foreach ($sections as $section) 
			{
				echo '<tr>';
                echo '<td>' . htmlspecialchars($section['secName']) . '</td>';

                echo '<td>';
				// vérifier la connection :
				if ( array_key_exists("loged_in", $_SESSION) && $_SESSION["loged_in"])
				{
					echo '<a href="index.php?controller=section&action=detail&id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconLoupe.png" alt="image de loupe pour obtenir des informations supplémentaire sur la section"></a>';
					
					if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 50)
					{
						//echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="view/page/section/deleteSection.php?id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer la section de la base de donnée"></a>';
						echo '<a href="index.php?controller=section&action=editSection&id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconPencil.png" alt="image de crayon pour modifier la section"></a>';
					}
				}
				
				echo '</td></tr>';
            }
		?>

		</table>
	</div>
</div>