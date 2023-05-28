<?php
	session_start();
	$_SESSION["mdp"]=$_REQUEST["mdp"];  // recovering password from login_gestionnaire form
	$motdep=$_SESSION["mdp"];
	$_SESSION["login"]=$_REQUEST["login"];  // recovering username from login_gestionnaire form
	$utilisateur=$_SESSION["login"];
	$_SESSION["auth"]=FALSE;

	// Authentication script using "batiment" table

	if(empty($motdep))
		header("Location:login_error.php");
	else
     {
		/* Access to database */
		include ("mysql.php");

		$requete1 = "SELECT `mdp` FROM `batiment`";
		$requete2 = "SELECT `login` FROM `batiment`";
		$resultat1 = mysqli_query($id_bd, $requete1)
			or die("Execution de la requete impossible : $requete1");
		$resultat2 = mysqli_query($id_bd, $requete2)
			or die("Execution de la requete impossible : $requete2");

		$ligne1 = mysqli_fetch_row($resultat1);
		$ligne2 = mysqli_fetch_row($resultat2);
		if ($motdep==$ligne1[0]) 
		 {
		 	if ($utilisateur==$ligne2[0])
		 		{
					$_SESSION["auth"]=TRUE;		
            		mysqli_close($id_bd);
					echo "<script type='text/javascript'>document.location.replace('gestionnaire.php');</script>"; // Redirection on successful login
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
