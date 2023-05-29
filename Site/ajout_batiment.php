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
			?>
		</section>
		<section>
			<br />
			<form action="ajout_batiment_script.php" method="post" enctype="multipart/form-data">
        	<div class="txt_field">
          	<input type="number" name="id" id="id" />
          	<span></span>
          	<label for="id">ID du batiment</label>
        	</div>
        	<div class="txt_field">
          	<input type="text" name="nom" id="nom" />
          	<span></span>
          	<label for="nom">Nom du batiment</label>
        	</div>
        	<div class="txt_field">
          	<input type="text" name="login" id="login" />
          	<span></span>
          	<label for="login">Login du gestionnaire</label>
        	</div>
        	<div class="txt_field">
          	<input type="password" name="mdp" id="mdp" />
          	<span></span>
          	<label for="mdp">Mot de passe du gestionnaire</label>
        	</div>
        	<input type="submit" value="Valider">
      	</form>
		</section>
		<footer>
		</footer>
	</body>
</html>
