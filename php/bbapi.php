<?php
//DATABASE connection
$servername = "127.0.0.1:32783";
$username = "bbapi";
$password = "password";
$dbname = "bbapi";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
   die("Connection failed: " . $conn->connect_error);
}

// curl gets product data
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA',
  'Content-type: application/json',
));
$response = curl_exec($ch);
curl_close($ch);

$test = json_decode($response);

// curl response inleren in een foreach
foreach($test as $value)
{



// sql to parse value
$sql = "
INSERT INTO products (manufacturer,id,sku,ean13,weight,height,width,depth,dateUpd,category,categories,dateUpdDescription,dateUpdImages,dateUpdStock,wholesalePrice,retailPrice,dateAdd,video,active,images,attributes,tags,taxRate,taxId,dateUpdProperties,dateUpdCategories,inShopsPrice) VALUES ('$value->manufacturer','$value->id','$value->sku','$value->ean13','$value->weight','$value->height','$value->width','$value->depth','$value->dateUpd','$value->category','$value->categories','$value->dateUpdDescription','$value->dateUpdImages','$value->dateUpdStock','$value->wholesalePrice','$value->retailPrice','$value->dateAdd','$value->video','$value->active','$value->images','$value->attributes','$value->tags','$value->taxRate','$value->taxId','$value->dateUpdProperties','$value->dateUpdCategories','$value->inShopsPrice')
";

//execute $sql quiry
  if ($conn->query($sql) === TRUE) {
    } else {
     echo "\n" . $conn->error;
    }
}
?>
