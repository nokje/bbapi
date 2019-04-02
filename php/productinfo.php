<?php
  require ('config/db.php');

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
