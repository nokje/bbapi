<?php
//DATABASE connection
$server = "127.0.0.1:32783";
$user = "bbapi";
$password = "password";
$db_name = "bbapi";

$mysqli = new mysqli_connect("$server", "$user", "$password", "$db_name");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

// get object id to fill foreach statements
// $q = Query
$q = $mysqli->query("SELECT `id` FROM `products`");

$// $f = Fetch
$f = $result->fetch_array();

// Dit zou een Multi Dimentional Array moeten zijn dus hier moet je een Foreach achter plakken
var_dump ($f);
#echo "test url /tasd/fasf/{$id}.json";
#printf ("%s (%s)\n", $row[0], $row[1]);
die();

// curl statement
// Multidimentional Array, $f = fetchen
foreach ($f as $key => $product) {
  // check output dit zou een single product moeten zijn
  // $product->id; of $product["id"] uit mijn hoofd
  var_dump($product);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.bigbuy.eu/rest/catalog/productinformation/{$product->id}.json?isoCode=en&_format=json");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA',
      'Content-type: application/json',
    )
  );
  curl_exec($ch);
  curl_close($ch);
}



#$json = json_decode($raw);
// curl response inleren in een foreach
#var_dump ($json);
#foreach($json as $column)
#{
  #$create_clumn = CREATE TABLE $table (
#  if ($column === TRUE) {
#  var_dump ($column);

#  die();
  #var_dump ($column->dateUpdDescription);
#  }
#}
// sql to parse value
#$sql = "INSERT INTO products (manufacturer,id,sku,ean13,weight,height,width,depth,dateUpd,category,categories,dateUpdDescription,dateUpdImages,dateUpdStock,wholesalePrice,retailPrice,dateAdd,video,active,images,attributes,tags,taxRate,taxId,dateUpdProperties,dateUpdCategories,inShopsPrice) VALUES ('$value->manufacturer','$value->id','$value->sku','$value->ean13','$value->weight','$value->height','$value->width','$value->depth','$value->dateUpd','$value->category','$value->categories','$value->dateUpdDescription','$value->dateUpdImages','$value->dateUpdStock','$value->wholesalePrice','$value->retailPrice','$value->dateAdd','$value->video','$value->active','$value->images','$value->attributes','$value->tags','$value->taxRate','$value->taxId','$value->dateUpdProperties','$value->dateUpdCategories','$value->inShopsPrice')
#";

//execute $sql quiry
#  if ($conn->query($sql) === TRUE) {
#    } else {
#     echo "\n" . $conn->error;
#    }
#}
?>