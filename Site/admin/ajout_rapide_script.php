<?php
	session_start();
	include ("../mysql.php");

	$typeArray =$_POST['type'];

	$idBatiment=mysqli_real_escape_string($id_bd, $_POST["nom"]);

	$nomBatiment=mysqli_real_escape_string($id_bd, "Batiment$idBatiment");

	$loginBatiment=mysqli_real_escape_string($id_bd, "gest$idBatiment");

	$mdpBatiment=mysqli_real_escape_string($id_bd, "pass$idBatiment");

	$nbTypes=count($typeArray);
	
	$virg=','; 
	$gui='"';

	for ($i=0; $i < $nbTypes; $i++){

		$nomCapteur="CAPT$typeArray[$i]$idBatiment";
		$valeurs="({$gui}{$gui}{$virg} {$gui}{$nomCapteur}{$gui}{$virg} {$gui}{$typeArray[$i]}{$gui}{$virg} {$gui}{$idBatiment}{$gui})";
		$req="INSERT INTO `capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES {$valeurs}";
		mysqli_query($id_bd, $req)
			or die("Execution de l ajout impossible : $req");
	}

	$valeurs="({$gui}{$idBatiment}{$gui}{$virg} {$gui}{$nomBatiment}{$gui}{$virg} {$gui}{$loginBatiment}{$gui}{$virg} {$gui}{$mdpBatiment}{$gui})";
	$req="INSERT INTO `batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$valeurs}";

	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

