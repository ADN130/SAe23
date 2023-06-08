<?php
	session_start();

	$_SESSION["mdp"] = mysqli_real_escape_string($id_bd, $_REQUEST["mdp"]); // recovering password from login_admin form
	$motdep = $_SESSION["mdp"];
	$_SESSION["login"] = mysqli_real_escape_string($id_bd, $_REQUEST["login"]); // recovering username from login_admin form
	$utilisateur = $_SESSION["login"];
	$_SESSION["auth"] = FALSE;

	// Authentication script using "administration" table

	if (empty($motdep)) {
		header("Location: login_error.php");
	} else {
		/* Access to database */
		include("mysql.php");

		$user = mysqli_query($id_bd, 'SELECT `login` FROM `administration` WHERE login="admin"')
			or die("Execution de la requete impossible : $user");
		$pass = mysqli_query($id_bd, 'SELECT `mdp` FROM `administration` WHERE login="admin"')
			or die("Execution de la requete impossible : $pass");

		$ligne1 = mysqli_fetch_row($user);
		$ligne2 = mysqli_fetch_row($pass);
		if ($utilisateur == $ligne1[0]) {
			if ($motdep == $ligne2[0]) {
				$_SESSION["auth"] = "admin";
				mysqli_close($id_bd);
				echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection on successful login
			} else {
				$_SESSION = array();
				session_destroy();
				unset($_SESSION);
				mysqli_close($id_bd);
				echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirection on failed login
			}
		} else {
			$_SESSION = array();
			session_destroy();
			unset($_SESSION);
			mysqli_close($id_bd);
			echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirection on failed login
		}
	}
?>
