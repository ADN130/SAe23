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
				// If session authentication is different from true then redirects to login error page
				if ($_SESSION["auth"]!=TRUE)
						header("Location:../login_error.php"); 

				/* Access to database */
				include ("../mysql.php");

				$utilisateur=$_SESSION["login"];
				$gui='"';

				/* Displaying database data  */
				echo '<div class="tablo">';
				echo "<p></br>Connecte en tant que <em>$utilisateur</em></p>";
				echo '</div>';
				echo '</br>';

				// If session login is different from admin, then proceeds to display measures and metrics of logged-in "gestionnaire"
				if ($_SESSION["login"]!="admin"){ 

					// ID of the building related to logged-in "gestionnaire"
					$idBat="SELECT `id-batiment` FROM `batiment` WHERE `login`={$gui}{$utilisateur}{$gui}";
					$idBat=mysqli_query($id_bd, $idBat);
					$idBat=mysqli_fetch_array($idBat);
					$idBat=$idBat[0];

					// Number of sensors in that building 
					$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}";
					$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
					$nbCapteurs=mysqli_fetch_array($nbCapteurs);
					$nbCapteurs=$nbCapteurs[0];

					
					
					// Loop that will display the metrics of each sensor in the building (average, minimum and maximum)
					for ($i=0; $i < $nbCapteurs; $i++) {

						echo "<br><table>";

						// ID of sensor i
						$idCapteur="SELECT `id-capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$i},1";
						$idCapteur=mysqli_query($id_bd, $idCapteur);
						$idCapteur=mysqli_fetch_array($idCapteur);
						$idCapteur=$idCapteur[0];

						// Type of measure made by sensor i
						$typeCapteur="SELECT `type` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui} LIMIT {$i},1";
						$typeCapteur=mysqli_query($id_bd, $typeCapteur);
						$typeCapteur=mysqli_fetch_array($typeCapteur);
						$typeCapteur=$typeCapteur[0];

						// Average value of the measures made by sensor i
						$avg="SELECT AVG(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$avg=mysqli_query($id_bd, $avg);
						$avg=mysqli_fetch_array($avg);
						$avg=$avg[0];

						// Lowest value measured by sensor i
						$min="SELECT MIN(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$min=mysqli_query($id_bd, $min);
						$min=mysqli_fetch_array($min);
						$min=$min[0];

						// Highest value measured by sensor i
						$max="SELECT MAX(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$max=mysqli_query($id_bd, $max);
						$max=mysqli_fetch_array($max);
						$max=$max[0];

						/* Displaying metrics for sensor i */
						echo "<tr><td>Moyenne de {$typeCapteur}</td><td>{$avg}</td></tr>
							  <tr><td>Minimum de {$typeCapteur}</td><td>{$min}</td></tr>
							  <tr><td>Maximum de {$typeCapteur}</td><td>{$max}</td></tr>";

						echo "<table><br>";
					}
					
					/* Table for measures of the building related to logged-in "gestionnaire" account */
					echo "<table><tr>
						      <td>Date</td>
						      <td>Heure</td>
						      <td>Valeur</td>
					         </tr><br><br>";

					$requete="SELECT * FROM `mesure` JOIN `capteur` ON `mesure`.`id-capteur` = `capteur`.`id-capteur` JOIN `batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`id-batiment`={$gui}{$idBat}{$gui}";
					$resultat = mysqli_query($id_bd, $requete);

					// Extract the data from the SQL request as values of "row" array
					while($row = mysqli_fetch_assoc($resultat)){
		            echo "<tr>
		                  <td>" . $row["date"] . "</td>
		                  <td>" . $row["heure"] . "</td>
		                  <td>" . $row["valeur"] . "</td>
		            	  </tr>";
					}
				}

				/* If admin is on "gestionnaire" page, display all measures from every building */
				if ($_SESSION["login"]=="admin"){

					// Number of sensors in the database
					$nbCapteurs="SELECT COUNT(`id-capteur`) FROM `capteur`";
					$nbCapteurs=mysqli_query($id_bd, $nbCapteurs);
					$nbCapteurs=mysqli_fetch_array($nbCapteurs);
					$nbCapteurs=$nbCapteurs[0];

					/* Loop that will display metrics for all sensors in the database */
					for ($i=0; $i < $nbCapteurs; $i++) {

						echo "<br><table>";

						// ID of sensor i in the database
						$idCapteur="SELECT `id-capteur` FROM `capteur` LIMIT {$i},1";
						$idCapteur=mysqli_query($id_bd, $idCapteur);
						$idCapteur=mysqli_fetch_array($idCapteur);
						$idCapteur=$idCapteur[0];

						// Type of measure made by sensor i						
						$typeCapteur="SELECT `type` FROM `capteur` LIMIT {$i},1";
						$typeCapteur=mysqli_query($id_bd, $typeCapteur);
						$typeCapteur=mysqli_fetch_array($typeCapteur);
						$typeCapteur=$typeCapteur[0];

						// What building (i.e. room) sensor i is in
						$salle="SELECT `batiment`.`id-batiment` FROM `batiment` JOIN `capteur` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `id-capteur`={$gui}${idCapteur}{$gui}";
						$salle=mysqli_query($id_bd, $salle);
						$salle=mysqli_fetch_array($salle);
						$salle=$salle[0];

						// Average value of the measures made by sensor i
						$avg="SELECT AVG(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$avg=mysqli_query($id_bd, $avg);
						$avg=mysqli_fetch_array($avg);
						$avg=$avg[0];

						// Lowest value measured by sensor i
						$min="SELECT MIN(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$min=mysqli_query($id_bd, $min);
						$min=mysqli_fetch_array($min);
						$min=$min[0];

						// Highest value measured by sensor i
						$max="SELECT MAX(`valeur`) FROM `mesure` WHERE `id-capteur` = {$gui}${idCapteur}{$gui}";
						$max=mysqli_query($id_bd, $max);
						$max=mysqli_fetch_array($max);
						$max=$max[0];

						/* Displaying metrics for sensor i */
						echo "<tr><td>Moyenne de {$typeCapteur} en salle {$salle}</td><td>{$avg}</td></tr>
							  <tr><td>Minimum de {$typeCapteur} en salle {$salle}</td><td>{$min}</td></tr>
							  <tr><td>Maximum de {$typeCapteur} en salle {$salle}</td><td>{$max}</td></tr>";

						echo "</table><br>";
				    }


					/* Table for measures of all buildings, includes technical information such as measure ID and sensor ID for the admin to see */
					echo "<table><tr>
				          <td>ID Mesure</td>
				          <td>Date</td>
				          <td>Heure</td>
				          <td>Valeur</td>
				          <td>ID Capteur</td>
			              </tr>";

					$requete="SELECT * FROM `mesure`";
					$resultat = mysqli_query($id_bd, $requete);

					// Extract the data from the SQL request as values of "row" array
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
			<p><a href="../logout.php">Déconnexion</a></p>
		</footer>
	</body>
</html>
