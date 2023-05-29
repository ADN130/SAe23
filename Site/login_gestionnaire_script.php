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

		$utilisateur='"'+"$utilisateur"+'"';
		$motdep='"'+"$motdep"+'"';
		$req1="SELECT `login` FROM `batiment` WHERE login=$utilisateur";
		$req2="SELECT `mdp` FROM `batiment` WHERE mdp=$motdep";
		$user = mysqli_query($id_bd, $req1)
			or die("Execution de la requete1 impossible : $req1");
		$pass = mysqli_query($id_bd, $req2)
			or die("Execution de la requete2 impossible : $req2");

		$ligne1 = mysqli_fetch_row($user);
		$ligne2 = mysqli_fetch_row($pass);
		if ($utilisateur==$ligne1[0]) 
		 {
		 	if ($motdep==$ligne2[0])
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
