#!/bin/bash

# Recuperation of the MySQL database id from the arguments
echo "Entrez votre identifiant PHPmyAdmin :"
read user

# Makes sure the password is not displayed on the screen when it is entered 
echo "Entrez votre mot de passe :"
read -s password


#--------------------------------------BROKER DYNAMIQUE (BOUCHONNAGE)-----------------------------------------

# This broker is used as a stub for fast and reliable debugging of script.sh

#generation of a random 2 digits integer (from 00 to 99)

temp=${RANDOM:0:2} 
hum=${RANDOM:0:2}
hum=${RANDOM:0:2}
act=${RANDOM:0:2}
co2=${RANDOM:0:2}
tvoc=${RANDOM:0:2}
illum=${RANDOM:0:2}
infra=${RANDOM:0:2}
visible=${RANDOM:0:2}
pres=${RANDOM:0:2}

payload=[{\"temperature\":$temp,\"humidity\":$hum,\"activity\":$act,\"co2\":$co2,\"tvoc\":$tvoc,\"illumination\":$illum,\"infrared\":$infra,\"infrared_and_visible\":$visible,\"pressure\":$pres},{\"deviceName\":\"AM107-37\",\"devEUI\":\"24e124128c019569\",\"room\":\"E208\",\"floor\":1,\"Building\":\"E\"}] #json payload that is going to be published, same format as the IUT broker

#finds how many buildings are in the "batiment" table

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) 

#loop that goes from 0 to the number of building minus one

for (( i=0; i<$nbBatiments; i++ )) 

do

bat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u $user -p$password | sed -n 2p) #finds which building i.e. which sensor is used (depending on room you chosed)

#publishes the JSON payload to the topic of the current building

mosquitto_pub -h 127.0.0.1 -t Student/by-room/$bat/data -m $payload 

sleep 2 #waits for 2 seconds so that the mosquitto_sub can keep up

done

