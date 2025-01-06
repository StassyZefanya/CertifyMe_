<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'ADMIN') {
    header(header: "Location: /login.php");
    exit();
}

// Jika role adalah admin, user dapat melanjutkan ke halaman admin
?>
