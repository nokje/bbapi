<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.bigbuy.eu/rest/catalog/products.json?isoCode=en');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Authorization: Bearer NTg3ZDQ1NTZkNjQ4M2RiMDk2MGY0ODNkMzhmYzM0ZDNlZDdmNTBhN2Y2YjIzNGM5MjEzOGViMzg1Nzc1MjhlZA',
  'Content-type: application/json',
));
$response = curl_exec($ch);
curl_close($ch);


  echo "hij doet het";
#    echo $response;

//DATABASE connection
$servername = "127.0.0.1:32781";
$username = "bbapi";
$password = "password";
$dbname = "bbapi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE products (
obj_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
manufacturer VARCHAR(15),
id VARCHAR(10),
sku VARCHAR(30),
ean13 VARCHAR(20),
weight VARCHAR(5),
height VARCHAR(5),
width VARCHAR(5),
depth VARCHAR(5),
dateUpd VARCHAR(20),
category VARCHAR(5),
categories VARCHAR(5),
dateUpdDescription VARCHAR(5),
dateUpdImages VARCHAR(5),
dateUpdStock VARCHAR(20),
wholesalePrice VARCHAR(5),
retailPrice VARCHAR(5),
dateAdd VARCHAR(20),
video VARCHAR(5),
active VARCHAR(5),
images VARCHAR(5),
attributes VARCHAR(5),
tags VARCHAR(5),
taxRate VARCHAR(5),
taxId VARCHAR(5),
dateUpdProperties VARCHAR(20),
dateUpdCategories VARCHAR(20),
inShopsPrice VARCHAR(5),
reg_date TIMESTAMP,
)";

if ($conn->query($sql) === TRUE) {
   echo "Table MyGuests created successfully";
} else {
   echo "Error creating table: " . $conn->error;
   echo "" ;
}

$conn->close();


?>
