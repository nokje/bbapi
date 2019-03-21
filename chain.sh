get_prod_id () {
  curl -s -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en
}
get_prod_info () {
    curl -s -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/productsinformation.json?isoCode=en
}
live_idlist () {
  get_prod_id | jq -rc '.[0,1,2,3,4,5,6,7,8,9,10] | .id'
}
get_id_info () {
    curl -s -H "Content-type: application/json" -H "Accept: application/json" -H "Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA" https://api.sandbox.bigbuy.eu/rest/catalog/productinformation/$id.json?isoCode=en
}
live_idlist | while read -r id; do get_id_info >> object_info.json ; done
