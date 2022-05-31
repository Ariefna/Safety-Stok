<?php
$host = "localhost";
$user = "root";
$password = "arief";
$dbname = "skripsi_riyondha";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Error in database connection !");
}
