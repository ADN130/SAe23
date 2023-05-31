<?php
	session_start();
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$login=$_POST["login"];
	$mdp=$_POST["mdp"];

	include ("mysql.php");	

	$id="$id";
	$nom="$nom";
	$login="$login";
	$mdp="$mdp";
	$virg=',';
	$gui='"';
	$i="({$gui}{$id}{$gui}{$virg} {$gui}{$nom}{$gui}{$virg} {$gui}{$login}{$gui}{$virg} {$gui}{$mdp}{$gui})";

	$req="INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$i}";
	//$req='INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES '+'('+$id+',' +$nom+',' +$login+',' +$mdp+')';
	//$req='INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES ("98", "E98", "gest_E98", "passE98")';
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

