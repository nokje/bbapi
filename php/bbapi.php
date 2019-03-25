<?php
// Get cURL resource
$curl = curl_init();
$options = array(
    CURLOPT_RETURNTRANSFER => 0,
    CURLOPT_URL => 'https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en',
    CURLOPT_HTTPHEADER => 'test: asf',
)

// Set some options - we are passing in a useragent too here
curl_setopt (resource $curl, int $options);

// Send the request & save response to $resp
$resp = curl_exec($curl);

// Close request to clear up some resources
curl_close($curl);
