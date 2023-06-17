<?php
	session_start();
	include ("../mysql.php");

	// Array that contains the sensors selected by the user in ajout_rapide form
	$typeArray =$_POST['type']; 

	$idBatiment=mysqli_real_escape_string($id_bd, $_POST["nom"]);

	$nomBatiment=mysqli_real_escape_string($id_bd, "Batiment$idBatiment");

	$loginBatiment=mysqli_real_escape_string($id_bd, "gest$idBatiment");

	$mdpBatiment=mysqli_real_escape_string($id_bd, "pass$idBatiment");

	// Number of sensors that were selected by the user
	$nbTypes=count($typeArray);
	
	$virg=','; #coma
	$gui='"'; #quote

	/* Result for "$valeurs" variable is for example: ("E208", "BatimentE208", "gestE208", "passE208")
	   After the request the building entered by the admin will be added to the "batiment" table */
	$valeurs="({$gui}{$idBatiment}{$gui}{$virg} {$gui}{$nomBatiment}{$gui}{$virg} {$gui}{$loginBatiment}{$gui}{$virg} {$gui}{$mdpBatiment}{$gui})"; 
	$req="INSERT INTO `batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$valeurs}";

	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	// Loop for adding selected types of sensors to the "capteur" table
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

