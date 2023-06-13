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
				session_start();
				if ($_SESSION["login"]!="admin")
						header("Location:../login_error.php");

				include ("../mysql.php");
				$gui='"';
				$requete = "SELECT `id-batiment` AS {$gui}id{$gui} FROM `batiment` ORDER BY `id-batiment` DESC";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
				mysqli_close($id_bd);

				echo '<form action="retrait_rapide_script.php" method="post" enctype="multipart/form-data">';
				echo '<div class="mult_choice">
					<label for="nom">Batiments retirables (CTRL + clic pour sélectionner plusieurs)</label>
					<select name="nom[]" multiple="multiple">';

				while($ligne=mysqli_fetch_assoc($resultat))
				{
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
