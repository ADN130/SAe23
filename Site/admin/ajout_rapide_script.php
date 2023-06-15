<?php
	session_start();
	include ("../mysql.php");

	$typeArray =$_POST['type']; #array that contains the sensors selected by the user in ajout_rapide form

	$idBatiment=mysqli_real_escape_string($id_bd, $_POST["nom"]);

	$nomBatiment=mysqli_real_escape_string($id_bd, "Batiment$idBatiment");

	$loginBatiment=mysqli_real_escape_string($id_bd, "gest$idBatiment");

	$mdpBatiment=mysqli_real_escape_string($id_bd, "pass$idBatiment");

	$nbTypes=count($typeArray); #number of sensors that were selected by the user
	
	$virg=','; #coma
	$gui='"'; #quote

	$valeurs="({$gui}{$idBatiment}{$gui}{$virg} {$gui}{$nomBatiment}{$gui}{$virg} {$gui}{$loginBatiment}{$gui}{$virg} {$gui}{$mdpBatiment}{$gui})"; #result is e.g. ("E208", "BatimentE208", "gestE208", "passE208")
	$req="INSERT INTO `batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$valeurs}";

	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	for ($i=0; $i < $nbTypes; $i++){

		$nomCapteur="CAPT$typeArray[$i]$idBatiment";
		$valeurs="({$gui}{$gui}{$virg} {$gui}{$nomCapteur}{$gui}{$virg} {$gui}{$typeArray[$i]}{$gui}{$virg} {$gui}{$idBatiment}{$gui})";
		$req="INSERT INTO `capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES {$valeurs}";
		mysqli_query($id_bd, $req)
			or die("Execution de l ajout impossible : $req");
	}

	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // redirection on successful addition											
?>

