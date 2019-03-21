get_prod() {
  curl -s -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en
}

get_prod | jq -rc '.[] | .id'
