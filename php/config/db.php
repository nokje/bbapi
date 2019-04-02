<?php
//DATABASE connection
$server = "127.0.0.1:32783";
$user = "bbapi";
$password = "password";
$db_name = "bbapi";

$conn = mysqli_connect("$server", "$user", "$password", "$db_name");

/* check connection */
if (mysqli_connect_errno()) {
    echo 'MySQLi connection failed ' . mysqli_connect_errno();
    exit();
}
