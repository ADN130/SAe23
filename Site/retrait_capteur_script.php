<?php
	session_start();
	include("mysql.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nom = mysqli_real_escape_string($id_bd, $_POST["nom"]);
		$req = "DELETE FROM `capteur` WHERE nom='$nom'";
		mysqli_query($id_bd, $req)
			or die("Execution de la suppression impossible : $req");
		
		mysqli_close($id_bd);
		echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful deletion
	}
?>
