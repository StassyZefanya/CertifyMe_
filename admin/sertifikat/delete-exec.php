<?php
include '../db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id']; // ID sertifikat yang ingin dihapus

        // Menggunakan prepared statement untuk mencegah SQL Injection
        $query = "DELETE FROM certificate_templates WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameter dan eksekusi query
            mysqli_stmt_bind_param($stmt, "i", $id); // "i" untuk integer
            if (mysqli_stmt_execute($stmt)) {
                // Redirect dengan status sukses
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
                exit();
            } else {
                // Redirect dengan status error
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error");
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            // Redirect dengan status error
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error");
            exit();
        }
    } else {
        // Redirect dengan status error jika ID tidak ditemukan
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=error");
        exit();
    }
} else {
    echo "Metode request tidak valid.";
}
?>