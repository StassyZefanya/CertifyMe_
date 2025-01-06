<?php
$host = 'localhost';
$database = 'certify_db';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $database); 

if ($conn->connect_error) { 

 die("Koneksi gagal: " . $conn->connect_error); 

} 

?>
