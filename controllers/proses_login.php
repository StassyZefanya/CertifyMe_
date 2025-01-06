<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Simpan role user
            $_SESSION['user_id'] = $user['user_id']; // Simpan role user

            // Redirect berdasarkan role
            if ($user['role'] === 'ADMIN') {
                header("Location: /admin/index.php");
            } else {
                header("Location: /dashboard/index.php");
            }
            exit();
        } else {
            $_SESSION['login_error'] = "Password salah.";
        }
    } else {
        $_SESSION['login_error'] = "Username tidak ditemukan.";
    }

    header("Location: login.php"); // Redirect kembali ke halaman login jika gagal
    exit();
}
?>
