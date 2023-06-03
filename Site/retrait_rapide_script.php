<?php
	session_start();
	include ("mysql.php");	

	$gui='"';
	$retraitArray = $_POST['nom'];
	$nbRetraits=count($retraitArray);

	for ($i=0; $i < $nbRetraits; $i++){

	$req="DELETE FROM `sae23`.`batiment` WHERE nom={$gui}{$retraitArray[$i]}{$gui}";
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	$req="DELETE `capteur` FROM `sae23`.`capteur` JOIN `sae23`.`batiment` ON `capteur`.`id-batiment`=`batiment`.`id-batiment` WHERE batiment.nom={$gui}{$retraitArray[$i]}{$gui}";
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	}

	mysqli_close($id_bd);

	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

