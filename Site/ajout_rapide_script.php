<?php
	session_start();
	include ("mysql.php");

	$typeArray = $_POST['type'];

	$idBatiment=$_POST["nom"];
	#$idBatiment=substr($idBatiment, 1);

	$nomBatiment="Batiment$idBatiment";

	$loginBatiment="gest$idBatiment";

	$mdpBatiment="pass$idBatiment";

	$nbCapteurs=mysqli_query($id_bd, "SELECT COUNT(`id-capteur`) FROM `sae23`.`capteur`");
	$nbCapteurs=mysqli_fetch_array($nbCapteurs);
	$nbCapteurs=$nbCapteurs[0];
	$nbCapteurs++;

	$nbTypes=count($typeArray);

	$idCapteur=$nbCapteurs;
	
	$virg=','; 
	$gui='"';


	for ($i=0; $i < $nbTypes; $i++){

		$nomCapteur="CAPT$typeArray[$i]$idBatiment";
		$valeurs="({$gui}{$gui}{$virg} {$gui}{$nomCapteur}{$gui}{$virg} {$gui}{$typeArray[$i]}{$gui}{$virg} {$gui}{$idBatiment}{$gui})";
		$req="INSERT INTO `capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES {$valeurs}";
		mysqli_query($id_bd, $req)
			or die("Execution de l ajout impossible : $req");
		$nbCapteurs++;
		$idCapteur=$nbCapteurs;
		$nomCapteur="capt$nbCapteurs";

	}

	$valeurs="({$gui}{$idBatiment}{$gui}{$virg} {$gui}{$nomBatiment}{$gui}{$virg} {$gui}{$loginBatiment}{$gui}{$virg} {$gui}{$mdpBatiment}{$gui})";
	$req="INSERT INTO `batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$valeurs}";

	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

