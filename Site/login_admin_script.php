<?php
	session_start();
	$_SESSION["mdp"]=$_REQUEST["mdp"];  // recovering password from login_admin form
	$motdep=$_SESSION["mdp"];
	$_SESSION["auth"]=FALSE;

	// Authentication script using "administration" table

	if(empty($motdep))
		header("Location:login_error.php");
	else
     {
		/* Access to database */
		include ("mysql.php");

		$requete = "SELECT `mdp` FROM `administration`";
		$resultat = mysqli_query($id_bd, $requete)
			or die("Execution de la requete impossible : $requete");

		$ligne = mysqli_fetch_row($resultat);
		if ($motdep==$ligne[0])
		 {
			$_SESSION["auth"]=TRUE;		
            mysqli_close($id_bd);
			echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful login
		 }
		else
		 {
			$_SESSION = array();
            session_destroy();  
            unset($_SESSION); 
            mysqli_close($id_bd);
            echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirection on failed login
		 }
     } 
 ?>
