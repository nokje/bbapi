<?php
$db_host        = '127.0.0.1:32781';
$db_user        = 'bbapi';
$db_pass        = 'password';
$db_database    = 'bbapi';
#$db_port        = '32773';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

// Check connection
if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
?>
