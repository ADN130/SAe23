#!/bin/bash

#Infinite loop

while true
do


# Subscription to building B

abo_B113=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/B113/data" -C 1) #subscription to the topic
temp=20 #getting the temperature
hum=1 #same thing for the humidity
date=$(date +%F) #getting the date
heure=$(date +%X) #getting the hour

# ID of the different sensors

ID_cap=3
ID_cap2=4

# Subscription to building E

abo_E209=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/E209/data" -C 1)  
temp_209=30
hum_209=3
date_209=$(date +%F)
heure_209=$(date +%X)
ID_cap_E209=1
ID_cap_E209_2=2

# Displaying the values obtained

echo "Bâtiement B :" "température :" $temp "," "date et heure :" $date $heure  
echo "Bâtiement B :" "humidité :" $hum "," "date et heure :" $date $heure  

echo "Bâtiement E :" "température :" $temp_209 "," "date et heure :" $date_209 $heure_209  
echo "Bâtiement E :" "humidité :" $hum_209 "," "date et heure :" $date_209 $heure_209  

#Insertion of temperature and humidity measures for both building

#Insertion for building B

 echo "INSERT INTO sae23.mesure (date, heure, type , valeur, \`id-capteur\`) VALUES ('$date', '$heure', '$temp', '$ID_cap');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85

 echo "INSERT INTO sae23.mesure (date, heure, type, valeur, \`id-capteur\`) VALUES ('$date', '$heure', '$hum', '$ID_cap2');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85

#Insertion for building E 

echo "INSERT INTO sae23.mesure (date, heure, type, valeur, \`id-capteur\`) VALUES ('$date_209', '$heure_209', '$temp_209', '$ID_cap_E209');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85

echo "INSERT INTO sae23.mesure (date, heure, type, valeur, \`id-capteur\`) VALUES ('$date_209', '$heure_209', '$hum_209', '$ID_cap_E209_2');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85

echo "Insertion des valeurs réalisée avec succès" # message to see if the insertion was successful



#--------------------------------------SCRIPT DYNAMIQUE-----------------------------------------

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM sae23.batiment;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | sed -n 2p)

echo "Il y a $nbBatiments batiment(s) dans la base de données"

for (( i=0; i<$nbBatiments; i++ ))
do
bat=$(echo "SELECT nom FROM sae23.batiment LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85 | sed -n 2p)
echo "Batiment traite : $bat "
mes=$(mosquitto_sub -h mqtt.iut-blagnac.fr -t "Student/by-room/$bat/data" -C 1)
date=$(date +%F)
heure=$(date +%X)
temp=$(echo $mes | jq '.[0].temperature')
hum=$(echo $mes | jq '.[0].humidity')
echo "La temperature est de $temp°C"
echo "L'humidite est de $hum g/m3"
echo "INSERT INTO sae23.mesure (date, heure, type, valeur, \`id-capteur\`) VALUES ('$date', '$heure', '$type_temp' ,'$temp', '$idCap');" | /opt/lampp/bin/mysql -h localhost -u bensaid -padnane85
done
done
