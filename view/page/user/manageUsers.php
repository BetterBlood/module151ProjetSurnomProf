<div class="container">

	<h2>Liste des comptes</h2>
	
	<div class="row">
		<table class=" table table-striped">
		<tr>
			<th>Nom</th>
			<th>Rights</th>
            <th>Option</th>
		</tr>
		<?php
            echo '<a href="index.php?controller=user&action=addUser"><button class="pull-right">ajouter un compte</button></a>';
			// Affichage de chaque enseignant
			foreach ($users as $user) 
			{
				echo '<tr>';
                echo '<td>' . htmlspecialchars($user['useUsername']) . '</td>';
                echo '<td>' . htmlspecialchars($user['useAdminRight']) . '</td>';

                echo '<td>';
                
				echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="index.php?controller=user&action=deleteUser&id=' . htmlspecialchars($user['idUser']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer l\'enseignant de la base de donnée"></a>';
				
				echo '</td></tr>';
			}
		?>

		</table>
	</div>
</div>