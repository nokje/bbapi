#!/bin/sh

#documentatie van de API is te vinden bij http://api.bigbuy.eu/doc

#Stel alle variabelen in zodat deze overeenkomen met jou situatie
#Bij key vul je jouw api key in
key='cat apikey'

#VARs (niet aanpassen)
dat_folder=data
raw_datadir=data/raw
raw_prodls=data/raw/products.raw
raw_imagls=data/raw/images.raw
raw_prod=products.raw
raw_img=images.raw
json_datadir=data/json
json_prod=products.json
json_img=images.json

#Hier worden de functies gedefinieerd
#get_prod download alle producten naar de raw data folder
get_prod() {
  curl -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en > $raw_datadir/$raw_prod
}
#get_prod_img download alle afbeelding informatie over de producten naar de raw data folder
get_prod_img() {
  curl -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en > $raw_datadir/$raw_img
}
#omdat if statements een waarde nodig hebben en ik niets wil invullen, maak ik maar een dummy functie die niks doet. Maar dan is if statement en bash wel gerustgesteld...
dummy () {
  echo >/dev/null
}

#Valideer en creer folder structuur
if [ -d "$dat_folder" ]; then
  dummy
else
  echo "DIRECTORY CHECK: data dir is NOT, so i'm creating whole file structure"
  mkdir $dat_folder
  mkdir $raw_datadir
  mkdir $json_datadir
fi
if [ -d "$raw_datadir" ]; then
  dummy
else
  echo "DIRECTORY CHECK: "$raw_datadir" dir is NOT in place and will be created"
  mkdir $raw_datadir
fi
if [ -d "$json_datadir" ]; then
  dummy
else
  echo "DIRECTORY CHECK: "$json_datadir" dir is NOT in place and will be created"
  mkdir $json_datadir
fi

#Controleren of er data beschikbaar is om mee aan de gang te gaan. Zo niet, download ik het eerst even.
if [ -f $raw_datadir/$raw_prod ]; then
  echo "CONTENT CHECK: "$raw_prod" is available, so not downloading nieuw content"
else
 get_prod
fi
if [ -f $raw_datadir/$raw_img ]; then
  echo "CONTENT CHECK: "$raw_img" is available, so not downloading nieuw content"
else
 get_prod_img
fi

#Rincing raw data to human readable files
if [ $(ls $raw_prodls 2>/dev/null | wc -l) == 1 ]; then
    echo "DATA RINCING: found raw product data and rincing it now for human readability"
    cat $raw_prodls | jq > $json_datadir/$json_prod
fi
if [ $(ls $raw_imagls 2>/dev/null | wc -l) == 1 ]; then
    echo "DATA RINCING: found raw images data and rincing it now for human readability"
    cat $raw_imagls | jq > $json_datadir/$json_img
  else
    echo "DATA RINCING: no raw data to rinse"
fi

tree .
