<?php
  require ('config/db.php');

  /*

    Dit gaat niet werken, je moet andersom kijken. Wat je nu doet is de DB records laden, loopen en per stuk informatie opvragen. Dit kan echter niet bij deze specifieke API
    omdat ze er een limiet op hebben gezet van 1 request per 5 seconden. Dus in onderstaande code moet je dan een sleep() zetten om niet over die limit heen te vliegen. Resultaat
    is dat je script dagen duurt (het zijn 200000+ producten).

    Wat je beter kunt doen:
    1 CURL request naar /rest/catalog/productsinformation waaromee je alle product information in 1x in json terug krijgt. Hierna loop je door ieder product uit deze JSON heen
    en doe je een SELECT query op het EAN nummer. Als het EAN nummer bekend is staat hij in je DB en pak je de overige JSON om je record te updaten.

  */


  //Create query
  $query_get = 'SELECT * FROM products;';
  // Get Result
  $result = mysqli_query($conn, $query_get);
  //Fetch Data
  $db_products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  #var_dump($products);
  // Free Result
  mysqli_free_result($result);
  //echo $id
  foreach ($db_products as $db_product) {
    //Get product //
    $db_prod_id = ($db_product['id']);
    // Get API url with product ID
    $api_product_info = "https://api.sandbox.bigbuy.eu/rest/catalog/productinformation/$db_prod_id.json?isoCode=en";
    // cURL options
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_product_info);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA',
      'Content-type: application/json',
    ));
    //execute cURL
    $response = curl_exec($ch);
    curl_close($ch);
    //process raw curl output to json_decode
    $product_info = json_decode($response);
    //create database put query
    $stmt = $conn->prepare("INSERT INTO prod_info (id, name, description, url, isoCode, dateUpdDescription, sku) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id, $name, $description, $url, $isoCode, $dateUpdDescription, $sku);
    $id = $product_info->id;
    $name = $product_info->name;
    $description = $product_info->description;
    $url = $product_info->url;
    $isoCode = $product_info->isoCode;
    $dateUpdDescription = $product_info->dateUpdDescription;
    $sku = $product_info->sku;
    //put data to DATABASE
    if ($stmt->execute() === TRUE) {
      } else {
      echo 'mysqli error: ' . $conn->error;
      }
  }
  // Close connection
  mysqli_close($conn);
