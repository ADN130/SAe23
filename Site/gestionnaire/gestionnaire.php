<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Gestion</title>
		<link rel="stylesheet" type="text/css" href="../styles/style.css" />
	</head>
	<body>
		<section>
			<div class="centre">
				<h1>Gestionnaire</h1>
				<hr />
			</div>
			<?php
				session_start();
				if ($_SESSION["auth"]!=TRUE)
						header("Location:../login_error.php"); #if session login is different from admin then redirects to login error page

				include ("../mysql.php");

				$utilisateur=$_SESSION["login"];
				$gui='"';

				/* Displaying database data  */
				echo '<div class="tablo">';
				echo "<p></br>Connecte en tant que <em>$utilisateur</em></p>";
				echo '</div>';
				echo '</br>';

				if ($_SESSION["login"]!="admin"){

					$idBat="SELECT `id-batiment` FROM `batiment` WHERE `login`={$gui}{$utilisateur}{$gui}";
					$idBat=mysqli_query($id_bd, $idBat);
					$idBat=mysqli_fetch_array($idBat);
					$idBat=$idBat[0];

					$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}";
					$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
					$nbCapteurs=mysqli_fetch_array($nbCapteurs);
					$nbCapteurs=$nbCapteurs[0];

					echo "<table>";
					for ($i=0; $i < $nbCapteurs; $i++) {

						$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$i},1";
						$idCapteur=mysqli_query($id_bd, $idCapteur);
						$idCapteur=mysqli_fetch_array($idCapteur);
						$idCapteur=$idCapteur[0];

						$typeCapteur="SELECT `type` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} AND `capteur`.`id-capteur` = {$gui}{$idCapteur}{$gui} LIMIT {$i},1";
						$typeCapteur=mysqli_query($id_bd, $typeCapteur);
						$typeCapteur=mysqli_fetch_array($typeCapteur);
						$typeCapteur=$typeCapteur[0];

						$avg="SELECT AVG(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$avg=mysqli_query($id_bd, $avg);
						$avg=mysqli_fetch_array($avg);
						$avg=$avg[0];

						$min="SELECT MIN(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$min=mysqli_query($id_bd, $min);
						$min=mysqli_fetch_array($min);
						$min=$min[0];

						$max="SELECT MAX(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$max=mysqli_query($id_bd, $max);
						$max=mysqli_fetch_array($max);
						$max=$max[0];

						echo "<tr><td>Moyenne de {$typeCapteur}</td><td>{$avg}</td></tr>
							  <tr><td>Minimum de {$typeCapteur}</td><td>{$min}</td></tr>
							  <tr><td>Maximum de {$typeCapteur}</td><td>{$max}</td></tr>";
					}

					echo "</table>";
					
					echo "<table><tr>
						      <td>ID Mesure</td>
						      <td>Date</td>
						      <td>Heure</td>
						      <td>Valeur</td>
						      <td>ID Capteur</td>
					         </tr>";

					$requete="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` JOIN `batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}";
					$resultat = mysqli_query($id_bd, $requete);

					while($row = mysqli_fetch_assoc($resultat)){
		            echo "<tr>
		                  <td>" . $row["id-mesure"] . "</td>
		                  <td>" . $row["date"] . "</td>
		                  <td>" . $row["heure"] . "</td>
		                  <td>" . $row["valeur"] . "</td>
						  <td>" . $row["id-capteur"] . "</td>
		            	  </tr>";
					}
				}

				if ($_SESSION["login"]=="admin"){

					echo "<table>";

					$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur`";
					$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
					$nbCapteurs=mysqli_fetch_array($nbCapteurs);
					$nbCapteurs=$nbCapteurs[0];

					for ($i=0; $i < $nbCapteurs; $i++) {

						$idCapteur="SELECT `id-capteur` FROM `capteur` LIMIT {$i},1";
						$idCapteur=mysqli_query($id_bd, $idCapteur);
						$idCapteur=mysqli_fetch_array($idCapteur);
						$idCapteur=$idCapteur[0];

						$typeCapteur="SELECT `type` FROM `capteur` LIMIT {$i},1";
						$typeCapteur=mysqli_query($id_bd, $typeCapteur);
						$typeCapteur=mysqli_fetch_array($typeCapteur);
						$typeCapteur=$typeCapteur[0];

						$salle="SELECT `batiment`.`id-batiment` FROM `batiment` JOIN `capteur` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `id-capteur`={$gui}${idCapteur}{$gui}";
						$salle=mysqli_query($id_bd, $salle);
						$salle=mysqli_fetch_array($salle);
						$salle=$salle[0];

						$avg="SELECT AVG(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$avg=mysqli_query($id_bd, $avg);
						$avg=mysqli_fetch_array($avg);
						$avg=$avg[0];

						$min="SELECT MIN(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$min=mysqli_query($id_bd, $min);
						$min=mysqli_fetch_array($min);
						$min=$min[0];

						$max="SELECT MAX(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$max=mysqli_query($id_bd, $max);
						$max=mysqli_fetch_array($max);
						$max=$max[0];

						echo "<tr><td>Moyenne de {$typeCapteur} en salle {$salle}</td><td>{$avg}</td></tr>
							  <tr><td>Minimum de {$typeCapteur} en salle {$salle}</td><td>{$min}</td></tr>
							  <tr><td>Maximum de {$typeCapteur} en salle {$salle}</td><td>{$max}</td></tr>";
				    }

					echo "</table>";

					echo "<table><tr>
				          <td>ID Mesure</td>
				          <td>Date</td>
				          <td>Heure</td>
				          <td>Valeur</td>
				          <td>ID Capteur</td>
			              </tr>";

					$requete="SELECT * FROM `mesure`";
					$resultat = mysqli_query($id_bd, $requete);

					while($row = mysqli_fetch_assoc($resultat)){
						echo "<tr>
						      <td>" . $row["id-mesure"] . "</td>
						      <td>" . $row["date"] . "</td>
						      <td>" . $row["heure"] . "</td>
						      <td>" . $row["valeur"] . "</td>
						      <td>" . $row["id-capteur"] . "</td>
						      </tr>";
					}
					echo "</table>";
				}
				$id_bd->close();
			?>
		</section>
		<footer>
		</footer>
	</body>
</html>
