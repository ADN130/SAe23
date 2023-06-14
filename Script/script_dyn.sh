#!/bin/bash

#--------------------------------------SCRIPT DYNAMIQUE-----------------------------------------

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds how many buildings are in the "batiment" table

echo "Il y a $nbBatiments batiment(s) dans la base de données" #displays how many buildings are in the database ("batiment" table)

for (( i=0; i<$nbBatiments; i++ )) #loop that goes from 0 to the number of building not included
do

bat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #variable that contains the name of the building we will be accessing the measures of
echo "Bâtiment traité : $bat "

#mesure=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/$bat/data" -C 1) #may be uncommented in order to use the IUT broker while it's up
mesure=$(mosquitto_sub -h 127.0.0.1 -t "Student/by-room/$bat/data" -C 1) #used together with the broker.sh script for faster debugging

nbTypes=$(echo "SELECT COUNT(\`type\`) FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\";" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds how many sensors are in the building currently processed

for (( y=0; y<$nbTypes; y++ )) #loop that goes from 0 to the number of sensors in the building unincluded
do

idCap=$(echo "SELECT \`id-capteur\` FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds the ID of the sensor located in the current building
echo "ID du capteur correspondant : $idCap"

sujet=$(echo "SELECT type FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds what type of measures are made by the sensor (e.g. : temperature, humidity...)
echo "La mesure relevée est : $sujet"

date=$(date +%F) #current date on YYYY-MM-DD format
heure=$(date +%X) #current hour on HH:MM:SS format
valeur=$(echo $mesure | jq '.[0].'$sujet) #extracts the value from the JSON payload according to what type of sensor measured it

echo "La valeur relevée est $valeur"

echo "INSERT INTO sae23.mesure (\`date\`, \`heure\`, \`valeur\`, \`id-capteur\`) VALUES ('$date', '$heure', '$valeur', '$idCap');" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot #inserts the complete measure into the "mesure" table

done

done
