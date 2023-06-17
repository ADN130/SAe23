<?php
	// Session starts or is resumed
	session_start();

	/* Connection to database */
	include ("../mysql.php");	

    // Array containing the buildings to be removed
	$retraitArray = $_POST['nom']; 

	// Number of buildings to be removed
	$nbRetraits=count($retraitArray); 

	for ($i=0; $i < $nbRetraits; $i++){

	/* The two following requests are protected against SQL injections even 
	   if it is not necessary because the values are pre-determined by the form */

	// %s will be substituted with $retraitArray[i]
	$req=sprintf("DELETE `capteur` FROM `capteur` JOIN `batiment` ON `capteur`.`id-batiment` = `batiment`.`id-batiment` WHERE `batiment`.`id-batiment` = '%s'", 
    mysqli_real_escape_string($id_bd, $retraitArray[$i]));
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");

	// %s will be substituted with $retraitArray[i]
	$req=sprintf("DELETE FROM `batiment` WHERE `id-batiment`='%s'",
    mysqli_real_escape_string($id_bd, $retraitArray[$i])); 
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	}

	mysqli_close($id_bd);

	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful removal											
?>

