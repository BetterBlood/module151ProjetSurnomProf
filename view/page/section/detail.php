<div class="container">

	<?php 
		if (!isset($section))
		{
			header("Location: index.php?controller=section&action=list");
		}
		else
		{
			echo '<h2>' . htmlspecialchars($section['secName']) . '</h2>';
		}
	?>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="pull-right">
				<?php

				if (array_key_exists("userPermissionsNumber", $_SESSION) && $_SESSION["userPermissionsNumber"] >= 75)
				{
					if ($_SESSION["userPermissionsNumber"] >= 100)
					{
						echo '<a onclick="return confirm(\'Voulez-vous vraiment supprimer cette entrée ?\')" href="view/page/section/deleteSection.php?id=' . htmlspecialchars($section['idSection']) . '"><img src="resources/image/iconTrash.png" alt="image de poubelle pour supprimer la section de la base de donnée"></a>';
					}
					echo '<a href="index.php?controller=section&action=editSection&id=' . htmlspecialchars($section['secName']) . '"><img src="resources/image/iconPencil.png" alt="image de crayon pour modifier la section"></a>';
				}

				?>
            </div>
            <div>
                <?php
                echo '<p>Nom de la section : ' . htmlspecialchars($section['secName']) . '</p>';
                ?>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="\module151\index.php?controller=section&action=list">Retour à la liste des sections</a>
		</div>
	</div>
</div>