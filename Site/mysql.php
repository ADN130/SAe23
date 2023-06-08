<?php
/* connection to database script */

  $id_bd = mysqli_connect("localhost","bensaid","adnane85","sae23") // ("host","username","password","database")
    or die("Connexion au serveur et/ou à la base de données impossible");

  /* character encoding setting */
  mysqli_query($id_bd, "SET NAMES 'utf8'");

?>
