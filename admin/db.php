<?php
// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "certify_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
