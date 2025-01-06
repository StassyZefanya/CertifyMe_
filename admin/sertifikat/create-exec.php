<?php
// Koneksi ke database
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data inputan form
    $name = $_POST['name'];
    
    // Mengambil file yang diupload
    $file_path = $_FILES['file_path']['name'];
    $file_tmp = $_FILES['file_path']['tmp_name'];
    $file_error = $_FILES['file_path']['error'];

    // Cek apakah ada error saat upload file
    if ($file_error === 0) {
        // Ekstrak ekstensi file
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

        // Generate nama file acak
        $random_name = uniqid('certificate_', true) . '.' . $file_extension;

        // Tentukan lokasi untuk menyimpan file yang diupload
        $upload_dir = '../templates/';
        $upload_file = $upload_dir . $random_name;

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($file_tmp, $upload_file)) {
            // Query untuk menyimpan data ke database dengan nama file acak
            $query = "INSERT INTO certificate_templates (name, file_path) VALUES ('$name', '$random_name')";

            // Eksekusi query
            if (mysqli_query($conn, $query)) {
                header("Location: create.php?status=success");
                exit();            
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
} else {
    echo "Metode request tidak valid.";
}
?>
