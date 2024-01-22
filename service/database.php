<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "reservasi";


$db = mysqli_connect($hostname,$username,$password,$database_name);
if ($db->connect_error) {
    echo "Error connecting to database";
    die("Database corrupted");
};
?>