#!/bin/sh

#documentatie van de API is te vinden bij http://api.bigbuy.eu/doc

#VARs
$authkey = cat ./apikey
$apicat = https://api.sandbox.bigbuy.eu/rest/catalog/categories.json

curl -v --header "WWW-Authenticate: NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/categories.json
#curl -v --header "auth: $authkey" $apicat
#echo ($authkey)
