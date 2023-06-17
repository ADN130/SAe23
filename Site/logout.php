<?php
	session_start();	 // Session starts or is resumed
	$_SESSION = array(); // Session reinitialization
	session_destroy();   // Session is dumped
	unset($_SESSION);    // Session table is dumped
	echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
?>
