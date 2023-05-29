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
				if ($_SESSION["auth"]!=TRUE)
						header("Location:login_error.php");
				$motdep=$_SESSION["mdp"];
				$utilisateur=$_SESSION["login"];
				/* Displaying database data  */
				echo '<div class="tablo">';
					echo '<p></br>Connecte en tant que :</p>';
					echo "<p></br>$utilisateur</p>";
					echo "<p></br>$motdep</p>";
				echo '</div>';
			?>
			</br>
			<hr/>
		</section>
		<section>
			<p><a href="ajout_batiment.php">Ajouter un batiment</a></p>
		</section>
		<footer>
		</footer>
	</body>
</html>
