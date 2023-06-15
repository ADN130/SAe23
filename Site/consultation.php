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
		<table>
		<?php
			include ("mysql.php"); #connection to the database

			$nbBatiments=mysqli_query($id_bd, "SELECT COUNT(`id-batiment`) FROM `batiment`"); #get the number of buildings in database
			$nbBatiments=mysqli_fetch_array($nbBatiments); #fetches the result of the query as an array
			$nbBatiments=$nbBatiments[0]; #the first (and only) element of the array is the result

			$gui='"'; #quote needed in queries for the syntax to work properly

			for ($i=0; $i < $nbBatiments; $i++){ #loop that goes form 0 the the number of building excluded

				$idBat="SELECT `id-batiment` FROM `batiment` LIMIT ${i},1"; 
				$idBat=mysqli_query($id_bd, $idBat); #gets the ID of each building through the i variable in the loop (e.g. LIMIT 0,1 would display the first line from the result of the query)
				$idBat=mysqli_fetch_array($idBat); #fetches the result of the query as an array
				$idBat=$idBat[0]; #the first (and only) element of the array is the result

				$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}"; 
				$nbCapteurs=mysqli_query($id_bd, $nbCapteurs); #number of sensors in current building
				$nbCapteurs=mysqli_fetch_array($nbCapteurs); #fetches the result of the query as an array
				$nbCapteurs=$nbCapteurs[0]; #the first (and only) element of the array is the result

				for ($y=0; $y < $nbCapteurs; $y++){ #loop that goes form 0 the the number of sensors excluded

					$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$y},1"; 
					$idCapteur=mysqli_query($id_bd, $idCapteur); #ID of sensor y
					$idCapteur=mysqli_fetch_array($idCapteur); #fetches the result of the query as an array
					$idCapteur=$idCapteur[0]; #the first (and only) element of the array is the result

					$typeCapteur="SELECT `type` FROM `capteur` WHERE `id-capteur`={$gui}{$idCapteur}{$gui}";
					$typeCapteur=mysqli_query($id_bd, $typeCapteur); #finds what type of sensor is sensor y
					$typeCapteur=mysqli_fetch_array($typeCapteur); #fetches the result of the query as an array
					$typeCapteur=$typeCapteur[0]; #the first (and only) element of the array is the result

					$query="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` WHERE `capteur`.`id-capteur`={$gui}{$idCapteur}{$gui} ORDER BY `id-mesure` DESC LIMIT 1";
					$result = mysqli_query($id_bd, $query); #gets the last measure from sensor y that belongs to building i

					while($row = mysqli_fetch_assoc($result)){ #while loop that allows to write into the html a table with the last measure of sensor y

				        echo "
							  <tr><td>Derniere mesure du batiment {$idBat}</td></tr>

							  <tr>
						      <td>ID Mesure</td>
						      <td>Date</td>
						      <td>Heure</td>
						      <td>Valeur</td>
						      <td>ID Capteur</td>
							  <td>Type de Capteur</td>
					          </tr>

							  <tr>
				              <td>" . $row["id-mesure"] . "</td>
				              <td>" . $row["date"] . "</td>
				              <td>" . $row["heure"] . "</td>
				              <td>" . $row["valeur"] . "</td>
							  <td>" . $row["id-capteur"] . "</td>
							  <td>" . $typeCapteur . "</td>
				              </tr>";
					}
				}
			}

			$id_bd->close(); #closes the connection to the database
		?>
		</table>
	</body>
</html>
