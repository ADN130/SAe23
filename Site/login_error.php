<?php
	// Beginning of the session
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
	   <meta charset="UTF-8" />
	   <title>Erreur d identification </title>
	   <link rel="stylesheet" type="text/css" href="./styles/style.css" />
	 </head>

	<body>
		<!-- Affichage entete -->
		<?php 
			$_SESSION = array(); // Session reinitialization
			session_destroy();   // Session is dumped
			unset($_SESSION);    // Session table is dumped
		?>
		<section>
			<p>
				<br />
				<em><strong>Acces au compte impossible</strong></em>
				<br />
			</p>
			<br />
			<p class="erreur">Mot de passe non saisi ou erron&eacute;</p>
			<br />
			<hr />
		</section>
		<footer>
		</footer>
	</body>
</html>
