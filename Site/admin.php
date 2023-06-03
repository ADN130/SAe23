<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Administration</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
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
						header("Location:login_error.php");
				$motdep=$_SESSION["mdp"];
				$utilisateur=$_SESSION["login"];
				/* Displaying database data  */
				echo '<div class="tablo">';
					echo "<p></br>Connecte en tant que <em>$utilisateur</em></p>";

				echo '</div>';
			?>
			</br>
			<hr/>
		</section>
		<section>
			<p><a href="ajout_batiment.php">Ajouter un batiment</a></p></br>
			<p><a href="retrait_batiment.php">Retirer un batiment</a></p></br>
			<p><a href="ajout_capteur.php">Ajouter un capteur</a></p></br>
			<p><a href="retrait_capteur.php">Retirer un capteur</a></p></br>
			<p><a href="ajout_rapide.php">Ajout rapide</a></p></br>
			<p><a href="retrait_rapide.php">Retrait rapide</a></p></br>
			<p><a href="gestionnaire.php">Page gestionnaire</a></p></br>
		</section>
		<footer>
		</footer>
	</body>
</html>
