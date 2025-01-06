<?php
session_start();

// Include koneksi database
require_once __DIR__ . 'db.php';

if (!isset($pdo)) {
    die('Koneksi ke database tidak berhasil. Pastikan file db.php benar.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    } else {
        $error = 'Harap isi semua bidang.';
    }
}
?>
