<?php
include 'db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $template = $_POST['template'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $description = $_POST['description'];
    $nama_1 = $_POST['nama_1'];
    $jabatan_1 = $_POST['jabatan_1'];
    $nama_2 = $_POST['nama_2'];
    $jabatan_2 = $_POST['jabatan_2'];
    $sign_1_image = $_POST['sign_1_image'];
    $sign_2_image = $_POST['sign_2_image'];
    $file_path = $_POST['file_path']; // Lokasi file PDF yang dihasilkan

    // Query untuk menyimpan data sertifikat
    $query = "INSERT INTO certificates (template, title, name, position, description, nama_1, jabatan_1, nama_2, jabatan_2, sign_1_image, sign_2_image, file_path) 
              VALUES ('$template', '$title', '$name', '$position', '$description', '$nama_1', '$jabatan_1', '$nama_2', '$jabatan_2', '$sign_1_image', '$sign_2_image', '$file_path')";

    if (mysqli_query($conn, $query)) {
        echo "Sertifikat berhasil disimpan!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
