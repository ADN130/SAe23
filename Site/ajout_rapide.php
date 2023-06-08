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
				if ($_SESSION["login"] != "admin") {
					header("Location: login_error.php");
					exit();
				}
			?>
		</section>
		<section>
			<br />
			<form action="ajout_rapide_script.php" method="post" enctype="multipart/form-data">
		    	<div class="txt_field">
				  	<input type="text" name="nom" id="nom" required />
				  	<span></span>
				  	<label for="nom">Nom du bâtiment</label>
		    	</div>
		    	<div class="mult_choice">
					<label for="type">Types de capteurs (CTRL + clic pour sélectionner plusieurs)</label>
				  	<select name="type[]" multiple="multiple" required>
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
		    	</div>

		    	<input type="submit" value="Valider">
      		</form>
		</section>
		<footer>
		</footer>
	</body>
</html>
