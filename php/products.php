<?php
  require ('config/db.php');

  //devine vars
  $api_products = "https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en";

  // curl gets product data
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api_products);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA',
    'Content-type: application/json',
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  $curl_products = json_decode($response);

  // curl response inleren in een foreach
  foreach($curl_products as $curl_product)
  {
    // SQL querie
    $query = "INSERT INTO products (
    manufacturer,
    id,
    sku,
    ean13,
    weight,
    height,
    width,
    depth,
    dateUpd,
    category,
    categories,
    dateUpdDescription,
    dateUpdImages,
    dateUpdStock,
    wholesalePrice,
    retailPrice,
    dateAdd,
    video,
    active,
    images,
    attributes,
    tags,
    taxRate,
    taxId,
    dateUpdProperties,
    dateUpdCategories,
    inShopsPrice)
      VALUES (
        '$curl_product->manufacturer',
        '$curl_product->id',
        '$curl_product->sku',
        '$curl_product->ean13',
        '$curl_product->weight',
        '$curl_product->height',
        '$curl_product->width',
        '$curl_product->depth',
        '$curl_product->dateUpd',
        '$curl_product->category',
        '$curl_product->categories',
        '$curl_product->dateUpdDescription',
        '$curl_product->dateUpdImages',
        '$curl_product->dateUpdStock',
        '$curl_product->wholesalePrice',
        '$curl_product->retailPrice',
        '$curl_product->dateAdd',
        '$curl_product->video',
        '$curl_product->active',
        '$curl_product->images',
        '$curl_product->attributes',
        '$curl_product->tags',
        '$curl_product->taxRate',
        '$curl_product->taxId',
        '$curl_product->dateUpdProperties',
        '$curl_product->dateUpdCategories',
        '$curl_product->inShopsPrice'
      )";
    // Execute $sql query
      if ($conn->query($query) === TRUE) {
        } else {
          echo '
          ' . $conn->error;
        }
  }
