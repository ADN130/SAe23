<?php
	session_start();
	
	// Session variables, "auth" is set to "FALSE" by default
	$_SESSION["auth"]=FALSE;
	$_SESSION["login"]=$_POST["login"];
	$_SESSION["mdp"]=$_POST["mdp"];

	$utilisateur=$_SESSION["login"];
	$motdep=$_SESSION["mdp"];

	// Authentication script using "batiment" table

	if(empty($motdep))
		header("Location:../login_error.php");
	else
     {
		/* Access to database */
		include ("../mysql.php");

		$gui='"';

		$user="SELECT `login` FROM `batiment` WHERE `login`={$gui}{$utilisateur}{$gui}";
		$user=mysqli_query($id_bd, $user);
		$user = mysqli_fetch_row($user);
		$user=$user[0];
		
		$pass="SELECT `mdp` FROM `batiment` WHERE `mdp`={$gui}{$motdep}{$gui}";
		$pass=mysqli_query($id_bd, $pass);		
		$pass = mysqli_fetch_row($pass);
		$pass=$pass[0];


		/* If user input matches with admin name and password then authentication is made, else user is redirected to login error page */
		if ($utilisateur==$user) 
		 {
		 	if ($motdep==$pass) 
		 		{
					$_SESSION["auth"]=TRUE;		
            		mysqli_close($id_bd);
					echo "<script type='text/javascript'>document.location.replace('gestionnaire.php');</script>"; // Redirection on successful login
		 		}
		 	else
		    	{
            		echo "<script type='text/javascript'>document.location.replace('../login_error.php');</script>"; // Redirection on failed login
				}
		 }
		else
		 {
            echo "<script type='text/javascript'>document.location.replace('../login_error.php');</script>"; // Redirection on failed login
		 }
     } 
 ?>
