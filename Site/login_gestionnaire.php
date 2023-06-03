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
    	<div class="center">
      		<h1>Acces aux comptes gestionnaires</h1>
      		<form action="login_gestionnaire_script.php" method="post" enctype="multipart/form-data">
        		<div class="txt_field_login">
          		<input type="username" name="login" id="login" />
          		<span></span>
          		<label for="login">Nom de compte</label>
        		</div>
        		<div class="txt_field_login">
          		<input type="password" name="mdp" id="mdp" />
          		<span></span>
          		<label for="mdp">Mot de passe</label>
        		</div>
        		<input type="submit" value="Valider">
      		</form>
    	</div>
		<footer>
		</footer>
	</body>
</html>
