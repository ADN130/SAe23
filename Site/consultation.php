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
			$nbBatiments=mysqli_query($id_bd, "SELECT COUNT(`id-batiment`) FROM `sae23`.`batiment`");
			$nbBatiments=mysqli_fetch_array($nbBatiments);
			$nbBatiments=$nbBatiments[0];
			$gui='"';

			for ($i=0; $i < $nbBatiments; $i++){

				$bat=mysqli_query($id_bd, "SELECT nom FROM `sae23`.`batiment` LIMIT $i,1;");
				$raw=mysqli_fetch_array($bat);
				$query="SELECT * FROM `mesure` JOIN `sae23`.`capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` JOIN `sae23`.`batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`nom`={$gui}{$raw[0]}{$gui} ORDER BY `id-mesure` DESC LIMIT 1";
				$result = mysqli_query($id_bd, $query);

				while($row = mysqli_fetch_assoc($result)){

		            echo "
						  <tr><td>Derniere mesure du batiment {$raw[0]}</td></tr>

						  <tr>
				          <td>ID Mesure</td>
				          <td>Date</td>
				          <td>Heure</td>
				          <td>Valeur</td>
				          <td>ID Capteur</td>
			             </tr>

						  <tr>
		                  <td>" . $row["id-mesure"] . "</td>
		                  <td>" . $row["date"] . "</td>
		                  <td>" . $row["heure"] . "</td>
		                  <td>" . $row["valeur"] . "</td>
						  <td>" . $row["id-capteur"] . "</td>
		                  </tr>";
				}
			}

			$id_bd->close();
		?>
		</table>
	</body>
</html>
