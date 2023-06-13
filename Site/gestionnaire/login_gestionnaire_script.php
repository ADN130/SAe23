<?php
	session_start();
	
	$_SESSION["auth"]=FALSE;
	$_SESSION["login"]=$_POST["login"];
	$_SESSION["mdp"]=$_POST["mdp"];

	$utilisateur=$_SESSION["login"];
	$motdep=$_SESSION["mdp"];

	// Authentication script using "batiment" table

	if(empty($motdep))
		header("Location:login_error.php");
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
					$_SESSION = array();
            		session_destroy();  
            		unset($_SESSION); 
            		mysqli_close($id_bd);
            		echo "<script type='text/javascript'>document.location.replace('../login_error.php');</script>"; // Redirection on failed login
				}
		 }
		else
		 {
			$_SESSION = array();
            session_destroy();  
            unset($_SESSION); 
            mysqli_close($id_bd);
            echo "<script type='text/javascript'>document.location.replace('../login_error.php');</script>"; // Redirection on failed login
		 }
     } 
 ?>
