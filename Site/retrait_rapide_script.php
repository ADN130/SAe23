<?php
	session_start();
	include ("mysql.php");	

	$gui='"';
	$retraitArray = $_POST['nom'];
	$nbRetraits=count($retraitArray);

	for ($i=0; $i < $nbRetraits; $i++){

	$req="DELETE `capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`id-batiment` = {$gui}{$retraitArray[$i]}{$gui}";
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	$req="DELETE FROM `batiment` WHERE `id-batiment`={$gui}{$retraitArray[$i]}{$gui}";
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	}

	mysqli_close($id_bd);

	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

