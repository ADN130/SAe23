<?php
	/* Connection to database script */
	$id_bd = mysqli_connect("127.0.0.1","sarrat","passroot","sae23") // ("host","username","password","database")
    	or die("Connexion au serveur et/ou à la base de données impossible");

	/* Character encoding setting */
	mysqli_query($id_bd, "SET NAMES 'utf8'");

?>
