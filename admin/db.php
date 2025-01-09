<?php
// Koneksi database
$host = "localhost";
$user = "dikiraha";
$pass = "842002Mddn!";
$dbname = "certifyme";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
