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

// sql to create table
$sql = "INSERT INTO
 products (manufacturer)
 VALUES ('test5')";

if ($conn->query($sql) === TRUE) {
    echo "Value processed successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
