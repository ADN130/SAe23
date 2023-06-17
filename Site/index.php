<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Accueil SAE23</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css">
	</head>
	<body>
		<header>
			<h2 class="titre"><em>SAE23</em></h2>
		</header>
		<p>Bienvenue sur le site web de la SAE23</p>
		<br>
		<p><a href="consultation.php">Consulter les mesures</a></p>
		<br>
		<p><a href="gestionnaire/login_gestionnaire.php">Connexion gestionnaire</a></p>
		<br>
		<p><a href="admin/login_admin.php">Connexion administrateur</a></p>
		<br>
		<p><a href="projet.php">Gestion de projet</a></p>
		<br>
		<p><a href="legal.php">Mentions légales</a></p>
		<br>
		<p>
			<strong>A propos du projet :</strong><br><br> Ce site web correspond à solution apportée au cahier des charges du projet SAE23.<br>
			Développé par <em>Adnane BENSAID, Rayan ARROUD</em> et <em>Benjamin SARRAT</em>, ce projet a pour but la récupération, le traitement et l'affichage
			de données provenant de capteurs en tous genres situés dans l'IUT de Blagnac.<br>
			Ce site est l'interface Homme-machine vous permettant de visualiser les données récupérées et les métriques calculées par un script Bash
			qui s'exécute régulièrement sur un serveur Lubuntu. Il est aussi possible de voir des graphiques évoluant selon les mesures relevées, grâce
			à la création d'un flux NodeRed utilisant une base de données InfluxDB, et grâce à des courbes créées sous Grafana.			
		</p>
	</body>
</html>
