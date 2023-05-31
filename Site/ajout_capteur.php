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
			<form action="ajout_capteur_script.php" method="post" enctype="multipart/form-data">
        	<div class="txt_field">
          	<input type="number" name="id" id="id" />
          	<span></span>
          	<label for="id">ID du capteur</label>
        	</div>
        	<div class="txt_field">
          	<input type="text" name="nom" id="nom" />
          	<span></span>
          	<label for="nom">Nom du capteur</label>
        	</div>
        	<div class="txt_field">
          	<input type="text" name="type" id="type" />
          	<span></span>
          	<label for="type">Type de capteur</label>
        	</div>
        	<div class="txt_field">
          	<input type="number" name="idBatiment" id="idBatiment" />
          	<span></span>
          	<label for="idBatiment">ID du batiment correspondant</label>
        	</div>
        	<input type="submit" value="Valider">
      	</form>
		</section>
		<footer>
		</footer>
	</body>
</html>
