<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Administration</title>
		<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	</head>
	<body>
		<section>
			<div class="centre">
				<h1>Administrateur</h1>
				<hr/>
			</div>
			<?php
				// Session starts or is resumed
				session_start();

				// If session login is different from "admin" then redirects to "login_error" page
				if ($_SESSION["login"]!="admin")
						header("Location:../login_error.php"); 

				include ("../mysql.php");
				// Quote needed in following variable in order not to break the line
				$gui='"';
				$requete = "SELECT `id-batiment` AS {$gui}id{$gui} FROM `batiment` ORDER BY `id-batiment` DESC";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
				mysqli_close($id_bd);

				// Form that allows the admin to select buildings to be removed
				echo '<form action="retrait_rapide_script.php" method="post" enctype="multipart/form-data">';
				echo '<div class="mult_choice">
					<label for="nom">Batiments retirables (CTRL + clic pour sélectionner plusieurs)</label>
					<select name="nom[]" multiple="multiple">';

				while($ligne=mysqli_fetch_assoc($resultat))
				{
					// "id" variable is extracted from the query
					extract($ligne);
					echo "<option value=\"{$id}\">{$id}</option>";
				}

				echo '</select';
				echo '</div>';
				echo '</form>';
			?>
		    	<input type="submit" value="Valider">
			</form>
		</section>
		<footer>
		</footer>
	</body>
</html>
