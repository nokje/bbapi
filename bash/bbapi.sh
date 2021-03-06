#!/bin/sh

#documentatie van de API is te vinden bij http://api.bigbuy.eu/doc

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
key=$( cat apikey )
dt=$(date '+%d/%m/%Y %H:%M:%S');

#clean_start; scrubs the place en makes it ready to play again
clean_start () {
  echo "$dt [bb.api] Cleaning asks: Do you want me to hold still and go on? [1]"
  echo "$dt [bb.api] Cleaning asks: Or you want to clean up the scipt deployment and quit? [2]"
  echo "$dt [bb.api] Cleaning asks: Or do you want quit? [q]"
  read -n1 input_cleanstart
  if [ $input_cleanstart == 1 ]; then
    dummy
  else
    if [ $input_cleanstart == 2 ]; then
      rm -r data
      rm apikey
      echo "$dt [bb.api] Cleaned up te place and ill exit 1, have fun!"
      exit 1
    else
      if [ $input_cleanstart == q ]; then
        echo "$dt [bb.api] oke, byeeee...!"
        exit 1
      fi
    fi
  fi
}
#dummy; omdat if statements een waarde nodig hebben en ik niets wil invullen, maak ik maar een dummy functie die niks doet. Maar dan is if statement en bash wel gerustgesteld...
dummy () {
  echo >/dev/null
}
#check_auth; Controleren of er een apikey file is en of de gevuld is.
check_auth () {
if [ ! -f apikey ]; then
  echo "$dt bb.api AUTH CHECK : apikey file is missing!, created it. Please fill in your apikey and try again"
  touch apikey
  exit 1
else
  if [ ! -s apikey ]; then
  echo "$dt [bb.api] AUTH CHECK : apikey file is empty. Please fill in your apikey and try again"
  exit 1
else
  echo "$dt [bb.api] AUTH CHECK : got your apikey and i will go on."
  fi
fi
}
#get_prod; download alle producten naar de raw data folder
get_prod() {
  echo "$dt [bb.api] CONTENT DOWNLOAD : starting downloading raw products data"
  curl -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en 2>/dev/null > $raw_datadir/$raw_prod
  echo "$dt [bb.api] CONTENT DOWNLOAD : finished downloading raw products data"
}
#get_prod_img; download alle afbeelding informatie over de producten naar de raw data folder
get_prod_img() {
  echo "$dt [bb.api] CONTENT DOWNLOAD : starting downloading raw images data"
  curl -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/productsimages.json?isoCode=en 2>/dev/null > $raw_datadir/$raw_img
  echo "$dt [bb.api] CONTENT DOWNLOAD : finished downloading raw images data"
}
#check_dir; valideer en creer folder structuur
check_dir () {
if [ ! -d "$dat_folder" ]; then
  echo "$dt [bb.api] DIRECTORY CHECK : data dir is NOT available, so i'm creating whole file structure"
  mkdir $dat_folder
  mkdir $raw_datadir
  mkdir $json_datadir
  echo "$dt [bb.api] DIRECTORY CHECK : file structure is in place, done!"
else
  if [ ! -d "$raw_datadir" ]; then
    echo "$dt [bb.api] DIRECTORY CHECK : "$raw_datadir" dir is NOT in place and will be created"
    mkdir $raw_datadir
  fi
  if [ ! -d "$json_datadir" ]; then
    echo "$dt [bb.api] DIRECTORY CHECK : "$json_datadir" dir is NOT in place and will be created"
    mkdir $json_datadir
  fi
echo "$dt [bb.api] DIRECTORY CHECK : file structure is in place, done!"
fi
}
#check_content; Controleren of er data beschikbaar is om mee aan de gang te gaan. Zo niet, download ik het eerst even.
check_content () {
if [ -f $raw_datadir/$raw_prod ]; then
  echo "$dt [bb.api] CONTENT CHECK : "$raw_prod" is available, so not downloading new content"
  read -n1 -p "$dt [bb.api] Or do you want me to download new "$raw_prod" content? [y/*]" input_1
else
  if [ ! $input_1 == y ]; then
 dummy
  else
 get_prod
  fi
fi
if [ -f $raw_datadir/$raw_img ]; then
  echo "$dt [bb.api] CONTENT CHECK : "$raw_img" is available, so not downloading new content"
  read -n1 -p "$dt [bb.api] Or do you want me to download new "$raw_img" content? [y/*]" input_2
else
  if [ ! $input_2 == y ]; then
      dummy
  else
      get_prod_img
  fi
fi
}
#go_rince; Rincing raw data to human readable files
go_rinse () {
if [ $(ls $raw_prodls 2>/dev/null | wc -l) == 1 ]; then
    echo "$dt [bb.api] DATA RINSING : found raw product data and rinsing it now for human readability"
    cat $raw_prodls | jq > $json_datadir/$json_prod
fi
if [ $(ls $raw_imagls 2>/dev/null | wc -l) == 1 ]; then
    echo "$dt [bb.api] DATA RINSING : found raw images data and rinsing it now for human readability"
    cat $raw_imagls | jq > $json_datadir/$json_img
  else
    echo "$dt [bb.api] DATA RINSING  : no raw data to rinse"
fi
}

clean_start
check_auth
check_dir
check_content
go_rinse
tree
