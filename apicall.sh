#!/bin/sh

#documentatie van de API is te vinden bij http://api.bigbuy.eu/doc


#Stel alle variabelen in zodat deze overeenkomen met jou situatie
#Bij key vul je jouw api key in
key=NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA

#VARs (niet aanpassen)
dat_folder=data/
raw_datadir=data/raw/
raw_prodls=data/raw/products.raw
raw_prod=products.raw
raw_img=images.raw
json_datadir=/data/json/
json_prod=products.json
json_img=images.json

#Valideer en creer folder structuur
if [ -d "$dat_folder" ]; then
  if [ -d "$raw_datadir" ]; then
  if [ -d "$json_datadir" ]; then
  echo "data en rawdata folder zijn aanwezig"
  else
    echo "raw data folder wordt aangemaakt"
    mkdir $raw_datadir
  fi
  if [ -d "$json_datadir" ]; then
    echo "data en json data folder zijn aanwezig"
  else
    echo "data en json data folder wordt aangemaakt"
    mkdir $json_datadir
  fi
else
  echo "geen data folder aangetroffen en folder structuur wordt aangemaakt"
  mkdir $dat_folder
  mkdir $raw_datadir
  mkdir $json_datadir
fi


#Hier worden de functies gedefinieerd
#get_prod download alle producten naar de raw data folder
get_prod() {
  curl -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en > $raw_datadir$raw_prod
}
#get_prod_img download alle afbeelding informatie over de producten naar de raw data folder
get_prod_img() {
  curl -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en > $raw_datadir$raw_img
}

#get_prod
#get_prod_img

#Rincing raw data to human readable files
if [ $(ls $raw_prodls 2>/dev/null | wc -l) == 1 ]; then
  cat $raw_prodls | jq > $json_datadir$json_prod
else
  echo "nothing to rince!"
fi



#"\ -H\ "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA"

#Example CURL
#curl --header "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw
#curl -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw
#curlkey https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw
#echo "curl -v $key https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw"
#echo "curl $key https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw"

#Verwerk de output data van raw data naar human readable jsonformat
#cat output.raw | jq > output.json
#curl -H "Accept: application/xhtml+xml"  -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw
