<?php
include 'db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
    $file_path = $_POST['file_path'];

    // Query untuk memperbarui data sertifikat berdasarkan ID
    $query = "UPDATE certificates 
              SET template='$template', title='$title', name='$name', position='$position', description='$description', 
                  nama_1='$nama_1', jabatan_1='$jabatan_1', nama_2='$nama_2', jabatan_2='$jabatan_2', 
                  sign_1_image='$sign_1_image', sign_2_image='$sign_2_image', file_path='$file_path' 
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "Sertifikat berhasil diperbarui!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
