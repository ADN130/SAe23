<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Liste des pi&egrave;ces propos&eacute;es</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<body>
		<section>
			<div class="centre">
				<h1>Page administrateur</h1>
				<hr />
			</div>
			<?php
				/* Access to database */
				include ("mysql.php");
				$requete = "SELECT * FROM `administration`";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
				mysqli_close($id_bd);

				/* Displaying database data  */
				echo '<div class="tablo">';
				while($ligne=mysqli_fetch_assoc($resultat))
				 {	
					extract($ligne);
					echo '<p>Connecte en tant que :</p>';
					echo "<p></br>$login</p>";
					echo "<p></br>$mdp</p>";
				 }
				echo '</div>';
			?>
			<hr />
		</section>
		<footer>
		</footer>
	</body>
</html>
