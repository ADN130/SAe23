<?php
	session_start();
	include ("mysql.php");

	$typeArray = $_POST['type'];

	$idBatiment=$_POST["nom"];
	$idBatiment=substr($idBatiment, 1);
	$nomBatiment=$_POST["nom"];
	$loginBatiment="gest_$nomBatiment";
	$mdpBatiment="pass$nomBatiment";

	$nbCapteurs=mysqli_query($id_bd, "SELECT COUNT(`id-capteur`) FROM `sae23`.`capteur`");
	$nbCapteurs=mysqli_fetch_array($nbCapteurs);
	$nbCapteurs=$nbCapteurs[0];
	$nbCapteurs++;

	$nbTypes=count($typeArray);

	$idCapteur=$nbCapteurs;
	$nomCapteur="capt$nbCapteurs";
	

	$virg=','; 
	$gui='"';


	for ($i=0; $i < $nbTypes; $i++){

		$valeurs="({$gui}{$idCapteur}{$gui}{$virg} {$gui}{$nomCapteur}{$gui}{$virg} {$gui}{$typeArray[$i]}{$gui}{$virg} {$gui}{$idBatiment}{$gui})";
		$req="INSERT INTO `sae23`.`capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES {$valeurs}";
		mysqli_query($id_bd, $req)
			or die("Execution de l ajout impossible : $req");
		$nbCapteurs++;
		$idCapteur=$nbCapteurs;
		$nomCapteur="capt$nbCapteurs";

	}

	$valeurs="({$gui}{$idBatiment}{$gui}{$virg} {$gui}{$nomBatiment}{$gui}{$virg} {$gui}{$loginBatiment}{$gui}{$virg} {$gui}{$mdpBatiment}{$gui})";
	$req="INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$valeurs}";

	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

