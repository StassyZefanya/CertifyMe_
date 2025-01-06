<?php
session_start();

// Include koneksi database
require_once 'db.php';

// if (!isset($pdo)) {
//     die('Koneksi ke database tidak berhasil. Pastikan file db.php benar.');
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Ambil data user berdasarkan username
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cek apakah user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            // Menyimpan data login dan role ke dalam session
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];  // Menyimpan role pengguna di session

            header('Location: dashboard.php'); // Redirect ke halaman dashboard
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    } else {
        $error = 'Harap isi semua bidang.';
    }
}
?>
