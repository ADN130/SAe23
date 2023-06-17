#!/bin/bash

# Indicating the path of the file to the crontab

#cd /home/abensaid/Desktop/Sae23 

# Recuperation of the MySQL database id from the arguments

echo "Entrez votre identifiant PHPmyAdmin :"
read user
echo "Entrez votre mot de passe :"
read password


#--------------------------------------SCRIPT DYNAMIQUE-----------------------------------------

#finds how many buildings are in the "batiment" table

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 

#displays how many buildings are in the database ("batiment" table)

echo "Il y a $nbBatiments batiment(s) dans la base de données" 

#loop that goes from 0 to the number of building not included

for (( i=0; i<$nbBatiments; i++ )) 
do

#variable that contains the name of the building we will be accessing the measures of

bat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 
echo "Bâtiment traité : $bat"


# Using one of the both broker available according script execution time

heure=$(date +%H)


if [ $heure -ge 8 ] && [ $heure -lt 19 ]; then
    broker="mqtt.iut-blagnac.fr"
else
    broker="127.0.0.1"
fi


mesure=$(mosquitto_sub -h $broker -t "Student/by-room/$bat/data" -C 1)


#finds how many sensors are in the building currently processed

nbTypes=$(echo "SELECT COUNT(\`type\`) FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\";" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 

#loop that goes from 0 to the number of sensors in the building unincluded

for (( y=0; y<$nbTypes; y++ )) 
do

#finds the ID of the sensor located in the current building

idCap=$(echo "SELECT \`id-capteur\` FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 
echo "ID du capteur correspondant : $idCap"

#finds what type of measures are made by the sensor (e.g. : temperature, humidity...)

sujet=$(echo "SELECT type FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 
echo "La mesure relevée est : $sujet"


#current date on DD-MM-YYYY format with the hour 

date=$(date +"%d-%m-%Y") 
heure=$(date +%X) 

#extracts the value from the JSON payload according to what type of sensor measured it

valeur=$(echo $mesure | jq '.[0].'$sujet) 

echo "La valeur relevée est $valeur"

#Insertion in the SQL database

echo "INSERT INTO sae23.mesure (\`date\`, \`heure\`, \`valeur\`, \`id-capteur\`) VALUES ('$date', '$heure', '$valeur', '$idCap');" | /opt/lampp/bin/mysql -h localhost -u $user -p$password 


done

done
