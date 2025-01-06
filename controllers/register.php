<?php
session_start(); // Mulai session untuk menyimpan pesan

// Koneksi ke database
require_once 'db.php';

$success_message = ''; // Variabel untuk pesan keberhasilan

// Proses data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Periksa apakah username sudah terdaftar
    $checkQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = "Username sudah terdaftar. Silakan gunakan username lain.";
    } else {
        // Insert data ke database
        $insertQuery = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $name, $username, $password);

        if ($stmt->execute()) {
            $_SESSION['register_success'] = "Registrasi berhasil! Silakan <a href='login.php'>masuk</a>.";
        } else {
            $_SESSION['register_error'] = "Terjadi kesalahan: " . $conn->error;
        }
    }

    $stmt->close();
}

$conn->close();

// Ambil pesan jika ada
if (isset($_SESSION['register_success'])) {
    $success_message = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
}

if (isset($_SESSION['register_error'])) {
    $error_message = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}
?>
