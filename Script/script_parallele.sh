#!/bin/bash

# Indicating the path of the file to the crontab for the automatisation 

cd "$(pwd)"

# Recuperation of the MySQL database id from the arguments

echo "Entrez votre identifiant PHPmyAdmin :"
read user

# make sure the password is not displayed on the screen when it is entered 

echo "Entrez votre mot de passe :"
read -s password



#-------------------------------------- SCRIPT PARALLELE -----------------------------------------

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p)

echo "Il y a $nbBatiments batiment(s) dans la base de données"

for (( i=0; i<$nbBatiments; i++ ))
do

bat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p)
echo "Bâtiment traité : $bat "

touch $bat.sh

echo '#!/bin/bash


# Using one of the both broker available according script execution time

hour=$(date +%H)

if [ $hour -ge 8 ] && [ $hour -lt 19 ]; then
    broker="mqtt.iut-blagnac.fr"
else
    broker="127.0.0.1"
fi

mesure=$(mosquitto_sub -h $broker -t "Student/by-room/$bat/data" -C 1) 

nbTypes=$(echo "SELECT COUNT(\`type\`) FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\";" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p)

for (( y=0; y<$nbTypes; y++ ))
do

#finds the ID of the sensor located in the current building

idCap=$(echo "SELECT \`id-capteur\` FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 

echo "ID du capteur correspondant : $idCap"

#finds what type of measures are made by the sensor (e.g. : temperature, humidity...)

sujet=$(echo "SELECT type FROM \`sae23\`.\`capteur\` JOIN \`sae23\`.\`batiment\` ON \`capteur\`.\`id-batiment\`=\`batiment\`.\`id-batiment\` WHERE \`batiment\`.\`id-batiment\`=\"$bat\" LIMIT $y,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 
echo "La mesure relevée est : $sujet"' >> $bat.sh

echo 'date=$(date +"%d-%m-%Y") #current date on DD-MM-YYYY format
heure=$(date +%X) #current hour on HH:MM:SS format' >> $bat.sh

printf 'valeur=$(echo $mesure | jq ' >> $bat.sh

printf \' >> $bat.sh
printf '.[0].' >> $bat.sh
printf \' >> $bat.sh

# extracts the value from the JSON payload according to what type of sensor measured it

echo '$sujet) 

echo La valeur relevée est $valeur' >> $bat.sh

printf 'echo "INSERT INTO sae23.mesure (\`date\`, \`heure\`, \`valeur\`, \`id-capteur\`) VALUES (' >> $bat.sh

# send data to the corresponding room file

printf \' >> $bat.sh
printf '$date' >> $bat.sh
printf \' >> $bat.sh
printf ', ' >> $bat.sh
printf \' >> $bat.sh
printf '$heure' >> $bat.sh
printf \' >> $bat.sh
printf ', ' >> $bat.sh
printf \' >> $bat.sh
printf '$valeur' >> $bat.sh
printf \' >> $bat.sh
printf ', ' >> $bat.sh
printf \' >> $bat.sh
printf '$idCap' >> $bat.sh
printf \' >> $bat.sh
echo ');" | /opt/lampp/bin/mysql -h localhost -u $user -p$password #inserts the complete measure into the "mesure" table' >> $bat.sh

echo 'done' >> $bat.sh

echo 'rm -- "$0"' >> $bat.sh

chmod 777 $bat.sh

var='$bat'
sed -i "s/$var/$bat/g" $bat.sh

./$bat.sh &

done
