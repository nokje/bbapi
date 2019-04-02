<?php
  require ('config/db.php');

  // sql queries
  $query_drop = "DROP TABLE prod_info";
  $query_build = "CREATE TABLE prod_info (
  obj_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  id VARCHAR(10),
  name VARCHAR(50),
  description VARCHAR(100),
  url VARCHAR(50),
  isoCode VARCHAR(10),
  dateUpdDescription VARCHAR(30),
  sku VARCHAR(30)
  )";

  if ($conn->query($query_drop) === TRUE) {
    echo 'Table prod_info droppped successfully
    ';
  } else {
    echo "Error dropping table: " . $conn->error;
  }
  if ($conn->query($query_build) === TRUE) {
    echo 'Table prod_info created successfully
    ';
  } else {
    echo "Error creating table: " . $conn->error;
  }

$conn->close();
