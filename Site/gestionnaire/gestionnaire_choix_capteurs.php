<?php
	session_start();
	include ("../mysql.php");	

	$gui='"';
	$afficheArray = $_POST['affich'];
	$_SESSION['nom'] = $afficheArray;

	mysqli_close($id_bd);

	echo "<script type='text/javascript'>document.location.replace('gestionnaire.php');</script>"; // Redirection on successful selection											
?>

