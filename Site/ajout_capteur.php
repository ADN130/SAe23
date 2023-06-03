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
		    	<div class="mult_choice">
				  	<select name="type">
						<option value="temperature">Temperature</option>
						<option value="humidity">Humidite</option>
						<option value="activity">Activite</option>
						<option value="co2">CO2</option>
						<option value="tvoc">TVOC</option>
						<option value="illumination">Lumiere</option>
						<option value="infrared">Infrarouge</option>
						<option value="infrared_and_visible">Infrarouge et visible</option>
						<option value="pressure">Pression</option>
					</select>
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
