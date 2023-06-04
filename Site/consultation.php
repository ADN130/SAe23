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
			include ("mysql.php");

			$nbBatiments=mysqli_query($id_bd, "SELECT COUNT(`id-batiment`) FROM `batiment`");
			$nbBatiments=mysqli_fetch_array($nbBatiments);
			$nbBatiments=$nbBatiments[0];

			$gui='"';

			for ($i=0; $i < $nbBatiments; $i++){

				$idBat="SELECT `id-batiment` FROM `batiment` LIMIT ${i},1";
				$idBat=mysqli_query($id_bd, $idBat);
				$idBat=mysqli_fetch_array($idBat);
				$idBat=$idBat[0];

				$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}";
				$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
				$nbCapteurs=mysqli_fetch_array($nbCapteurs);
				$nbCapteurs=$nbCapteurs[0];

				for ($y=0; $y < $nbCapteurs; $y++){

					$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$y},1";
					$idCapteur=mysqli_query($id_bd, $idCapteur);
					$idCapteur=mysqli_fetch_array($idCapteur);
					$idCapteur=$idCapteur[0];

					$typeCapteur="SELECT `type` FROM `capteur` WHERE `id-capteur`={$gui}{$idCapteur}{$gui}";
					$typeCapteur=mysqli_query($id_bd, $typeCapteur);
					$typeCapteur=mysqli_fetch_array($typeCapteur);
					$typeCapteur=$typeCapteur[0];

					$query="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` WHERE `capteur`.`id-capteur`={$gui}{$idCapteur}{$gui} ORDER BY `id-mesure` DESC LIMIT 1";
					$result = mysqli_query($id_bd, $query);

					while($row = mysqli_fetch_assoc($result)){

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

			$id_bd->close();
		?>
		</table>
	</body>
</html>
