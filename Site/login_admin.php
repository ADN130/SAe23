<?php
	// Beginning of the session
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Administration</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<body>
		<section>
			<p>
				<br/>
				<em><strong>Acces au compte administrateur</strong></em>
				<br/>
			</p>
			<form action="login_admin_script.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Saissez le mot de passe...</legend>
					<label for="mdp">Mot de passe : </label>
					<input type="password" name="mdp" id="mdp" />
				</fieldset>
				<p>
					<input type="submit" value="Valider" />
				</p>
			</form>
			<hr />
		</section>
		<footer>
		</footer>
	</body>
</html>
