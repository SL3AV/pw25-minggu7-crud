<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "nim128";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
?>