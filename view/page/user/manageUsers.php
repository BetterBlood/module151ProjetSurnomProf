<?php
	// redirection vers la list des prof si jamais l'utilisateur n'a pas les droits nécessaires
    if (!array_key_exists("userPermissionsNumber", $_SESSION))
    {
        header('Location: ../../../index.php?controller=teacher&action=list');
    }
    else
    {
        $userLVL = $_SESSION["userPermissionsNumber"];
        
        if ($userLVL < 100)
        {
            header('Location: ../../../index.php?controller=teacher&action=list');
        }
    }
?>


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
            echo '<a class="btn btn-danger pull-right" href="index.php?controller=user&action=addUser">ajouter un compte</a>';
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