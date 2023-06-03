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
