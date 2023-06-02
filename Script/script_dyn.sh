#!/bin/bash

#--------------------------------------SCRIPT DYNAMIQUE-----------------------------------------

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p)

echo "Il y a $nbBatiments batiment(s) dans la base de données"

for (( i=0; i<$nbBatiments; i++ ))

do

bat=$(echo "SELECT nom FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p)
echo "Bâtiment traité : $bat "

#mes=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/$bat/data" -C 1)
mesure=$(mosquitto_sub -h 127.0.0.1 -t "Student/by-room/$bat/data" -C 1)

date=$(date +%F)
heure=$(date +%X)
valeur=$(echo $mesure | jq '.[0].temperature')

echo "La température est de $temp°C"
echo "L'humidité est de $hum g/m3"

idBat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p)
echo "ID du bâtiment traité : $idBat"

idCap=$(echo "SELECT \`id-capteur\` FROM \`sae23\`.\`capteur\` WHERE \`id-batiment\`=\"$idBat\" LIMIT 0,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p)
echo "ID du capteur traité : $idCap"

echo "INSERT INTO sae23.mesure (\`date\`, \`heure\`, \`valeur\`, \`id-capteur\`) VALUES ('$date', '$heure', '$temp', '$idCap');" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot

done

