<?php

$dbName = "db_inventory";
$host = "localhost";
$username = "root";
$pass = "";

$conn = mysqli_connect($host, $username, $pass, $dbName);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>