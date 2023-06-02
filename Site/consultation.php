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
			<tr>
				<td>ID Mesure</td>
				<td>Date</td>
				<td>Heure</td>
				<td>Valeur</td>
				<td>ID Capteur</td>
			</tr>
		<?php
			include ("mysql.php");
			$query="SELECT DISTINCT * FROM `mesure` ORDER BY `id-mesure` DESC LIMIT 5";
			$result = mysqli_query($id_bd, $query);
			while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                      <td>" . $row["id-mesure"] . "</td>
                      <td>" . $row["date"] . "</td>
                      <td>" . $row["heure"] . "</td>
                      <td>" . $row["valeur"] . "</td>
					  <td>" . $row["id-capteur"] . "</td>
                      </tr>";
			}
			$id_bd->close();
		?>
		</table>
	</body>
</html>
