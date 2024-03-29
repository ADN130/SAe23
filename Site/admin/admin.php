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

				$utilisateur=$_SESSION["login"];

				/* Displaying user data */
				echo '<div>';
					echo "<p></br>Connecte en tant que <em>$utilisateur</em></p>";

				echo '</div>';
			?>
			</br>
			<hr/>
		</section>

		<section>
			<p><a href="ajout_rapide.php">Ajout rapide</a></p></br>
			<p><a href="retrait_rapide.php">Retrait rapide</a></p></br>
			<p><a href="../gestionnaire/gestionnaire.php">Page gestionnaire</a></p></br>
		</section>

		<footer>
			<p><a href="../logout.php">Déconnexion</a></p>
		</footer>
	</body>
</html>
