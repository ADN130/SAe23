<?php
	session_start();
	$nom=$_POST["nom"];
	$nom="$nom";
	$gui='"';
	include ("mysql.php");	

	$req="DELETE FROM `sae23`.`batiment` WHERE nom={$gui}{$nom}{$gui}";
	mysqli_query($id_bd, $req)
		or die("Execution de l ajout impossible : $req");
	mysqli_close($id_bd);
	echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful addition											
?>

