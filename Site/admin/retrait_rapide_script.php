<?php
	session_start();
	include ("../mysql.php");	

	$retraitArray = $_POST['nom']; #array containing the buildings to be removed
	$nbRetraits=count($retraitArray); #number of buildings to be removed

	for ($i=0; $i < $nbRetraits; $i++){

	#the two following requests are protected against SQL injections even if it is not necessary because the values are pre-determined by the form

	$req=sprintf("DELETE `capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`id-batiment` = '%s'", # %s will be substituted with $retraitArray[i]
    mysqli_real_escape_string($id_bd, $retraitArray[$i]));
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	$req=sprintf("DELETE FROM `batiment` WHERE `id-batiment`='%s'",
    mysqli_real_escape_string($id_bd, $retraitArray[$i])); # %s will be substituted with $retraitArray[i]
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	}

	mysqli_close($id_bd);

	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // redirection on successful removal											
?>

