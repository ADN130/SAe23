#!/bin/bash

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

payload=[{\"temperature\":$temp,\"humidity\":$hum,\"activity\":$act,\"co2\":$co2,\"tvoc\":$tvoc,\"illumination\":$illum,\"infrared\":$infra,\"infrared_and_visible\":$visible,\"pressure\":$pres},{\"deviceName\":\"AM107-37\",\"devEUI\":\"24e124128c019569\",\"room\":\"E208\",\"floor\":1,\"Building\":\"E\"}]
pub=$payload

mosquitto_pub -h 127.0.0.1 -t Student/by-room/E208/data -m $pub


