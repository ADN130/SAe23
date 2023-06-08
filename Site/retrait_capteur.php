<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Administration</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<body>
		<section>
			<div class="centre">
				<h1>Administrateur</h1>
				<hr/>
			</div>
			<?php
				session_start();
				if ($_SESSION["login"] != "admin")
						header("Location: login_error.php");
				include ("mysql.php");
				$requete = "SELECT nom FROM `capteur` ORDER BY `nom` DESC";
				$resultat = mysqli_query($id_bd, $requete)
					or die("Execution de la requete impossible : $requete");
				mysqli_close($id_bd);

				echo '<div class="tablo">';
				while($ligne = mysqli_fetch_assoc($resultat))
				{	
					extract($ligne);
					echo '</br>';
					echo '<ul>';
					echo "<li> $nom </li>";
					echo '</ul>';
				}
				echo '</div>';
			?>
		<section>
			<form action="retrait_capteur_script.php" method="post" enctype="multipart/form-data">
		    	<div class="txt_field">
		      		<input type="text" name="nom" id="nom" />
		      		<span></span>
		      		<label for="nom">Capteur à retirer</label>
		    	</div>
				<input type="submit" value="Valider">
      		</form>
			<?php
				session_start();
				include("mysql.php");

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$nom = mysqli_real_escape_string($id_bd, $_POST["nom"]);
					$req = "DELETE FROM `capteur` WHERE nom='$nom'";
					mysqli_query($id_bd, $req)
						or die("Execution de la suppression impossible : $req");
					
					mysqli_close($id_bd);
					echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful deletion
				}
			?>
		</section>
		<footer>
		</footer>
	</body>
</html>
