#!/bin/bash

#--------------------------------------BROKER SAE23-----------------------------------------

temp=${RANDOM:0:2} #generation of a random 2 digits integer (from 00 to 99)
hum=${RANDOM:0:2}
hum=${RANDOM:0:2}
act=${RANDOM:0:2}
co2=${RANDOM:0:2}
tvoc=${RANDOM:0:2}
illum=${RANDOM:0:2}
infra=${RANDOM:0:2}
visible=${RANDOM:0:2}
pres=${RANDOM:0:2}

payload=[{\"temperature\":$temp,\"humidity\":$hum,\"activity\":$act,\"co2\":$co2,\"tvoc\":$tvoc,\"illumination\":$illum,\"infrared\":$infra,\"infrared_and_visible\":$visible,\"pressure\":$pres},{\"deviceName\":\"AM107-37\",\"devEUI\":\"24e124128c019569\",\"room\":\"E208\",\"floor\":1,\"Building\":\"E\"}] #JSON payload that is going to be published, same format as the IUT broker

nbBatiments=$(echo "SELECT COUNT(\`id-batiment\`) FROM \`sae23\`.\`batiment\`;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds how many buildings are in the "batiment" table

for (( i=0; i<$nbBatiments; i++ )) #loop that goes from 0 to the number of building minus one

do

bat=$(echo "SELECT \`id-batiment\` FROM \`sae23\`.\`batiment\` LIMIT $i,1;" | /opt/lampp/bin/mysql -h localhost -u sarrat -ppassroot | sed -n 2p) #finds which building i.e. which sensor is used (e.g. : E208 or E211...)

mosquitto_pub -h 127.0.0.1 -t Student/by-room/$bat/data -m $payload #publishes the JSON payload to the topic of the current building

sleep 1 #waits for 1 second so that the mosquitto_sub can keep up

done
