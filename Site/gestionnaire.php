<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Gestion</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<body>
		<section>
			<div class="centre">
				<h1>Gestionnaire</h1>
				<hr />
			</div>
			<table>
				<tr>
					<td>ID Mesure</td>
					<td>Date</td>
					<td>Heure</td>
					<td>Valeur</td>
					<td>ID Capteur</td>
				</tr>
			<?php
				session_start();
				if ($_SESSION["auth"]!=TRUE)
						header("Location:login_error.php");
				$motdep=$_SESSION["mdp"];
				$utilisateur=$_SESSION["login"];
				/* Displaying database data  */
				include ("mysql.php");
				echo '<div class="tablo">';
				echo "<p></br>Connecte en tant que <em>$utilisateur</em></p>";
				echo '</div>';
				echo '</br>';
				$gui='"';
				$req_id="SELECT `id-batiment` FROM `batiment` WHERE login={$gui}{$utilisateur}{$gui}"; 
				$id=mysqli_query($id_bd, $req_id);
				$id=mysqli_fetch_array($id);
				$query="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` WHERE `capteur`.`id-batiment`={$gui}{$id[0]}{$gui}";
				$result = mysqli_query($id_bd, $query);

				$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `sae23`.`capteur` JOIN `sae23`.`batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`nom`={$gui}{$utilisateur}{$gui}";
				$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
				$nbCapteurs=mysqli_fetch_array($nbCapteurs);
				$nbCapteurs=$nbCapteurs[0];


				for ($i=0; $i < $nbCapteurs; $i++) {
					$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `sae23`.`batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`nom`={$gui}{$utilisateur}{$gui} LIMIT {$i},1";
					$idCapteur=mysqli_query($id_bd, $idCapteur);
					$typeCapteur="SELECT `type` FROM `capteur` JOIN `sae23`.`batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`nom`={$gui}{$utilisateur}{$gui} LIMIT {$i},1";
					$typeCapteur=mysqli_query($id_bd, $typeCapteur);
					$avg="SELECT AVG(`valeur`) FROM `sae23`.`mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
					$avg=mysqli_query($id_bd, $avg);
					$min="SELECT MIN(`valeur`) FROM `sae23`.`mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
					$min=mysqli_query($id_bd, $min);
					$max="SELECT MAX(`valeur`) FROM `sae23`.`mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
					$max=mysqli_query($id_bd, $max);

					echo "<tr><td>Moyenne de {$typeCapteur}</td>td>{$avg}</td></tr>
						  <tr><td>Minimum de {$typeCapteur}</td>td>{$min}</td></tr>
					 	  <tr><td>Maximum de {$typeCapteur}</td>td>{$max}</td></tr>";
				}
				
				echo "<tr>
				          <td>ID Mesure</td>
				          <td>Date</td>
				          <td>Heure</td>
				          <td>Valeur</td>
				          <td>ID Capteur</td>
			             </tr>";

				while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $row["id-mesure"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["heure"] . "</td>
                    <td>" . $row["valeur"] . "</td>
					<td>" . $row["id-capteur"] . "</td>
                </tr>";
				}
				if ($_SESSION["login"]=="admin")
					{
						$query="SELECT * FROM `mesure`";
						$result = mysqli_query($id_bd, $query);
						while($row = mysqli_fetch_assoc($result)) 
							{
						    echo "<tr>
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
			<hr />
		</section>
		<footer>
		</footer>
	</body>
</html>
