<?php
	session_start();
	$id = $_POST["id"];
	$nom = $_POST["nom"];
	$type = $_POST["type"];
	$idBatiment = $_POST["idBatiment"];

	include("mysql.php");

	$id = mysqli_real_escape_string($id_bd, $id);
	$nom = mysqli_real_escape_string($id_bd, $nom);
	$type = mysqli_real_escape_string($id_bd, $type);
	$idBatiment = mysqli_real_escape_string($id_bd, $idBatiment);

	$virg = ',';
	$gui = '"';
	$i = "({$gui}{$id}{$gui}{$virg} {$gui}{$nom}{$gui}{$virg} {$gui}{$type}{$gui}{$virg} {$gui}{$idBatiment}{$gui})";

	$req = "INSERT INTO `sae23`.`capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES {$i}";
	mysqli_query($id_bd, $req) or die("Execution de l'ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition
?>
