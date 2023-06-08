<?php
	session_start();
	include ("mysql.php");

	$nom = mysqli_real_escape_string($id_bd, $_POST["nom"]);
	
	$req = "DELETE FROM `sae23`.`batiment` WHERE nom='$nom'";
	mysqli_query($id_bd, $req) or die("Execution de la suppression impossible : $req");

	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful deletion
?>
