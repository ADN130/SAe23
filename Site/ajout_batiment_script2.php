<?php
	session_start();

	include ("mysql.php");	

	$id='"'+$_POST["id"]+'"';
	$nom='"'+$_POST["nom"]+'"';
	$login='"'+$_POST["login"]+'"';
	$mdp='"'+$_POST["mdp"]+'"';

	$req='INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES '+'('+$id+',' +$nom+',' +$login+',' +$mdp+')';
	//$req='INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES ("98", "E98", "gest_E98", "passE98")';
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req / $id / $nom / $_POST["login"] / $_POST["mdp"]");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('login_admin.php');</script>"; // Redirection on successful addition											
?>

