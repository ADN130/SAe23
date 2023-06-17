<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Accueil SAE23</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<body>
		<p>Page de consultation des mesures</p>
		</br>
		<p><a href="index.php">Retour a l'accueil</a></p>
		</br>
		<?php
			// Connection to the database
			include ("mysql.php"); 

			// Number of buildings in the database
			$nbBatiments=mysqli_query($id_bd, "SELECT COUNT(`id-batiment`) FROM `batiment`"); #get the number of buildings in database
			$nbBatiments=mysqli_fetch_array($nbBatiments); #fetches the result of the query as an array
			$nbBatiments=$nbBatiments[0]; #the first (and only) element of the array is the result

			// Quote needed in queries for the syntax to work properly
			$gui='"';

			// Loop that goes form 0 the the number of buildings excluded
			for ($i=0; $i < $nbBatiments; $i++){ 

				// Gets the ID of each building through the i variable in the loop (e.g. LIMIT 0,1 would display the first line from the result of the query)
				$idBat="SELECT `id-batiment` FROM `batiment` LIMIT ${i},1"; 
				$idBat=mysqli_query($id_bd, $idBat); 

				// Fetches the result of the query as an array
				$idBat=mysqli_fetch_array($idBat); 

				// The first (and only) element of the array is the result
				$idBat=$idBat[0]; 

				// Number of sensors in current building
				$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}"; 
				$nbCapteurs=mysqli_query($id_bd, $nbCapteurs); 
				$nbCapteurs=mysqli_fetch_array($nbCapteurs); 
				$nbCapteurs=$nbCapteurs[0];

				// Loop that will display the last measure of each sensor related to building i
				for ($y=0; $y < $nbCapteurs; $y++){

					// ID of sensor y
					$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$y},1"; 
					$idCapteur=mysqli_query($id_bd, $idCapteur);
					$idCapteur=mysqli_fetch_array($idCapteur);
					$idCapteur=$idCapteur[0];

					// Finds what type of sensor is sensor y
					$typeCapteur="SELECT `type` FROM `capteur` WHERE `id-capteur`={$gui}{$idCapteur}{$gui}";
					$typeCapteur=mysqli_query($id_bd, $typeCapteur);
					$typeCapteur=mysqli_fetch_array($typeCapteur); 
					$typeCapteur=$typeCapteur[0];

					// Displays the last measure of sensor y
					$query="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` WHERE `capteur`.`id-capteur`={$gui}{$idCapteur}{$gui} ORDER BY `id-mesure` DESC LIMIT 1";
					$result = mysqli_query($id_bd, $query);

					// While loop that allows to write into the html page a table with the last measure of sensor y
					while($row = mysqli_fetch_assoc($result)){ 

				        echo "
							  <br><table><tr><td>Derniere mesure du batiment {$idBat}</td></tr>

							  <tr>
						      <td>Date</td>
						      <td>Heure</td>
						      <td>Valeur</td>
							  <td>Type de Capteur</td>
					          </tr>

							  <tr>
				              <td>" . $row["date"] . "</td>
				              <td>" . $row["heure"] . "</td>
				              <td>" . $row["valeur"] . "</td>
							  <td>" . $typeCapteur . "</td>
				              </tr></table><br>";
					}
				}
			}

			// Closes the connection to the database
			$id_bd->close();
		?>
	</body>
</html>
