<?php
session_start();
$id = $_POST["id"];
$nom = $_POST["nom"];
$login = $_POST["login"];
$mdp = $_POST["mdp"];

include("mysql.php");

// Nettoyage des données (évite les attaques par injection SQL)
$id = mysqli_real_escape_string($id_bd, $id);
$nom = mysqli_real_escape_string($id_bd, $nom);
$login = mysqli_real_escape_string($id_bd, $login);
$mdp = mysqli_real_escape_string($id_bd, $mdp);

$id = "$id";
$nom = "$nom";
$login = "$login";
$mdp = "$mdp";
$virg = ',';
$gui = '"';
$i = "({$gui}{$id}{$gui}{$virg} {$gui}{$nom}{$gui}{$virg} {$gui}{$login}{$gui}{$virg} {$gui}{$mdp}{$gui})";

$req = "INSERT INTO `sae23`.`batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES {$i}";

mysqli_query($id_bd, $req) or die("Execution de l'ajout impossible : $req");

mysqli_close($id_bd);

echo "<script type='text/javascript'>document.location.replace('admin.php');</script>"; // Redirection en cas d'ajout réussi
?>
