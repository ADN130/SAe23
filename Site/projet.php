<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Gestion de projet</title>
		<link rel="stylesheet" type="text/css" href="./styles/style.css" />
	</head>
	<header>
		<h2>Gestion de projet</h2>
    </header>
	<body>	
        <section>
            <h3>Diagramme de GANTT :</h3>
            </br>
            <p><img src="images/ganttfinal.png" alt="GANTT" width="90%" height="90%"></p>
            </br>
            </section>
        </br>
		<section>
            <h2>Outils collaboratifs utilisés</h2>
            <h3>Github</h3>
            </br>
            <p><img src="images/gengit.png" alt="Github" width="75%" height="75%"></p>
            </br>
            <p><img src="images/sitegit.png" alt="Github" width="75%" height="75%"></p>
            </br>
            <p><img src="images/scriptgit.png" alt="Github" width="75%" height="75%"></p>
            </br>
            <p>Nous avons utilisé Github afin de pouvoir travailler en groupe sur la production de code php, html et css; la réalisation de script en bash et de requête sql.</p>
            </br>
            <h3>Google Drive :</h3>
            </br>
            <p><img src="images/drive.png" alt="Google Drive" width="75%" height="75%"></p>
            </br>
            <p>Nous avons utilisé Google Drive dans le partage de fichiers qui étaient différent de ceux de la programmation comme les images ou les diagramme de GANTT.</p>
        </section>
        <section>
            <h2>Synthèse Personelle</h2>
            <h3>Adnane :</h3>
            </br>
            <p>Travail réalisé : J’étais en charge de la partie base de données, gestion, récupération et publication des mesures. En clair, j’avais pour rôle de créer la base de donnée, gérer les tables crées, les relations entre les tables (clé primaire, étrangère), et tout ce qui se rapportait de près ou de loin à la base de donnée.

            C'est moi qui ait façonné le squelette du script de récupération et publication des mesures sur la base données. Il a été amélioré plus tard avec l’aide de Benjamin. J’étais aussi en charge des requêtes pour les métriques et du chiffrement des mots de passe stockés.

            Ceci est une liste non exhaustive des problèmes les plus conséquents que j’ai pu rencontrer.</p>
            </br>
            <p>
            Les problèmes rencontrés : 

            Difficulté à créer une relation clé étrangère, clé primaire sur l’onglet conception de  Phpmyadmin 

            Difficulté avec les instructions d’envoi de mesures vers la base de données sur le script de récupération, surtout avec les noms des tables avec des  - 

            Difficulté à mettre en place des requêtes pour la sécurisation des formulaires via le No SQL injection
            </p>
            </br>
            <p>

            Les solutions proposées : 

            Changement de la version de xamp, plus ancienne que celle utilisée au départ avec ce faisant une autre version de phpmyadmin qui a résolu le problème.

            Mise en place de requêtes avec le format : INSERT INTO \`nom de la table\’ pour prendre en compte les caractères spéciaux empêchant l’envoi de données.

            Mis en place de la fonction mysqli_real_escape_string permettant d’échapper les caractères spéciaux des variables afin d’éviter les injections SQL.

            Pour ce qui est du respect du cahier des charges, je dirais qu’on l’a respecté à 95%. Toutes les fonctionnalités et contraintes liées au projet sont respectées. Je ne mets pas la note maximale car il y a toujours des petites corrections ou ajouts qu’on pourrait faire pour vraiment le respecter à 100% qu’on a pas forcément remarqué au vu de la robustesse du projet.
            </p>
            </br>
            <h3>Benjamin :</h3>
            </br>
            <p>Concernant la partie PHP, la gestion des sessions et des formulaires ont été un défi à cause du manque d’expérience dans le domaine, la ressource R209 m’a aidé à comprendre leur fonctionnement mais on a dû effectuer des recherches en parallèle pour pouvoir faire des formulaires basés sur des listes et protégés contre les injection SQL.</p>
            </br>
            <h3>Rayan :</h3>
            </br>
            <p>Travail réalisé : J'étais en charge de la création du flux Node-RED permettant
            la récupération des valeurs de température et de CO2 des bâtiments respectifs de Réseaux et Télécommunications
            et de GIM à l'aide d'un noeud MQTT in permettant se souscrire dont on voulait. Une fois ces valeurs récupérées, il fallait faire en sorte de pouvoir les afficher sur le site de Node-RED
            à l'aide d'un debug, d'avoir une visualisation sur un tableau de bord créé sur Node-RED aussi, mais surtout de transférer
            les valeurs des capteurs vers InfluxDB qui est une base de données de type NO-SQL. Une fois stockées sur InfluxDB,
            il fallait faire en sorte de les visualiser à l'aide de Grafana 
            </p>
            </br>
            <p>
            Problèmes rencontrés : Je n'arrivais pas à extraire les valeurs de température et de C02 de la payload reçu par le noeud MQTT in, je n'arrivais pas également à stocker dans InfluxDB ces différentes valeurs.
            </p>
            </br>
            <p>
            Solutions proposées : Pour le premier problème, il suffisait d'utiliser le convertisseur set msg.payload afin de récupérer la valeur dont j'avais besoin, en indiquant
            temperature ou co2 dans le champ où se trouvait la valeur. Pour le second problème, chaque fois que l'on veut dans InfluxDB ajouter une salle, un bâtiment ou un type de mesure,
            il faut insérer ce que l'on ajoute en créant un champ.
            </p>
            </br>
        </section>
        </br>
		<section>
		<p><a href="index.php">Retour à l'accueil</a></p>
		</br>
	</body>
</html>
