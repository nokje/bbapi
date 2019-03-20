#!/bin/sh

#documentatie van de API is te vinden bij http://api.bigbuy.eu/doc

#VARs
key=NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA


#"\"/Applications/Sublime Text 2.app/Contents/SharedSupport/bin/subl\""
getcat() {
  curl -H "Authorization: Bearer $key" https://api.sandbox.bigbuy.eu/rest/catalog/categories.json?isoCode=en > output.raw
}

getcat
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

#curl $
