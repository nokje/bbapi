<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA'
));
$response = curl_exec($ch);
curl_close($ch);



    echo $response;
?>
