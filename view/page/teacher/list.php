<div class="container">

	<?php
		if(isset($deletedTeacher) && $deletedTeacher)
		{
			?>
				<h2>Liste des enseignants archivés</h2>
			<?php

			if (array_key_exists("modif", $_GET)) // affichage de test, s'occupe d'informer l'utilisateur de la réussite ou non de la restauration d'un enseignant
			{
				if ($_GET["modif"] == "true")
				{ 
					// en développement :
					?>
					<div class="bg-success">oppération réussie</div>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Bien joué !!</strong> L'Enseignant a corrêctement été restauré
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php
				}
				else
				{
					// en développement :
					?>
					<div class="bg-danger">oppération échouée</div>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>OUPS !</strong> il semble que l'enseignant n'a pas pu être restauré
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php
				}
			}
		}
		else
		{
			?>
				<h2>Liste des enseignants</h2>
			<?php
		}
	?>
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
		<form action="index.php?controller=teacher&action=list&multipleVotes=true" method="post">
			<table class="table table-striped">
				<button class="btn btn-success" type="submit">Elire plusieurs</button>
				<tr>
					<th>Nom</th>
					<th>Surnom</th>
					<th>Option(s)</th>
					<th>Vote</th>
				</tr>
				
				<?php
					$popularIndex = true; // permet d'afficher du text supplémentaire pour le premier enseignant du foreach

					// Affichage de chaque enseignant
					foreach ($teachers as $teacher) 
					{
						echo '<tr>';
						echo '<td><input type="checkbox" id="checkbox' . htmlspecialchars($teacher['idTeacher']) . '" name="checkbox' . htmlspecialchars($teacher['idTeacher']) . '" value="' . htmlspecialchars($teacher['idTeacher']) . '">';
						echo ' ' . htmlspecialchars($teacher['teaLastName']) . " " .  htmlspecialchars($teacher['teaFirstName']) . '</td>';
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
						
						echo '</td>';

						echo '<td>';
							echo '<a href="index.php?controller=teacher&action=list&id=' . htmlspecialchars($teacher['idTeacher']) . '&vote=true">J\'élis </a>';

							if ($teacher["teaVotes"] != null)
							{
								echo htmlspecialchars($teacher['teaVotes']);
							}
							else
							{
								echo 'Allez élisez-moi';
							}

							if ($popularIndex)
							{
								$popularIndex = false;
								echo ' Surnom le plus populaire';
							}

						echo'</td>';
						
						echo '</tr>';
					}
				?>
			

			</table>
		</form>
	</div>
</div>