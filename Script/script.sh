#!/bin/bash

#Infinite loop

while true
do

#--------------------------------------SCRIPT DYNAMIQUE-----------------------------------------#

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | sed -n 2p) #finds how many buildings are in the "batiment" table

echo "Il y a $nbBatiments batiment(s) dans la base de données"

for (( i=0; i<$nbBatiments; i++ )) #loop that goes from 0 to the number of building minus one

do

bat=$(echo "SELECT nom FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnae85 | sed -n 2p) #variable that contains the name of the building we will be accessing the measures of
echo "Bâtiment traité : $bat "

#mesure=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/$bat/data" -C 1) #may be uncommented in order to use the IUT broker while it's up
mesure=$(mosquitto_sub -h 127.0.0.1 -t "Student/by-room/$bat/data" -C 1) #used together with the broker.sh script for faster debugging

idCap=$(echo "SELECT \`id-capteur\` FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`nom\`=\"$bat\" LIMIT 0,1;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | sed -n 2p) #finds the ID of the sensor located in the current building
echo "ID du capteur correspondant : $idCap"

sujet=$(echo "SELECT type FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`nom\`=\"$bat\" LIMIT 0,1 ;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | sed -n 2p) #finds what type of measures are made by the sensor (e.g. : temperature, humidity...)
echo "La mesure relevée est : $sujet"

date=$(date +%F) #current date on YYYY-MM-DD format
heure=$(date +%X) #current hour on HH:MM:SS format
valeur=$(echo $mesure | jq '.[0].'$sujet) #extracts the value from the JSON payload according to what type of sensor measured it

echo "La valeur relevée est $valeur"

echo "INSERT INTO sae23.mesure (\`date\`, \`heure\`, \`valeur\`, \`id-capteur\`) VALUES ('$date', '$heure', '$valeur', '$idCap');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 #inserts the complete measure into the "mesure" table


# Metrics

avg_temp=$(echo "SELECT AVG(\`valeur\`) FROM sae23.mesure WHERE \`id-capteur\` = '$idCap';" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | awk 'NR==2{printf "%.2f", $1}')
    min_temp=$(echo "SELECT MIN(\`valeur\`) FROM sae23.mesure WHERE \`id-capteur\` = '$idCap';" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | awk 'NR==2{print $1}')
    max_temp=$(echo "SELECT MAX(\`valeur\`) FROM sae23.mesure WHERE \`id-capteur\` = '$idCap';" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | awk 'NR==2{print $1}')


done
done

