<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "skripsi_riyondha";

    $conn = mysqli_connect($host,$user,$password,$dbname);

    if (!$conn) {
        die("Error in database connection !");
    }
?>
