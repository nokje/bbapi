<?php
  require ('config/db.php');

  //Create query
  $query = 'SELECT * FROM products;';

  // Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  #var_dump($products);

  // Free Result
  mysqli_free_result($result);

  // Close connection
  mysqli_close($conn);

  //echo $id
  foreach ($products as $product) {
    //Get product //
    $prod_id = ($product['id']);
    // Get API url with product ID
    $api_url = "https://api.sandbox.bigbuy.eu/rest/catalog/$prod_id/test";
  die();
  }
