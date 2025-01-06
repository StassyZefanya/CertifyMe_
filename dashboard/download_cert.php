<?php
if (isset($_GET['file'])) {
    $file_path = '../generated/' . basename($_GET['file']);

    // Debug jika file tidak ditemukan
    if (!file_exists($file_path)) {
        die("Error: File tidak ditemukan pada path $file_path.");
    }

    // Download file
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
} else {
    echo "Error: Tidak ada file yang diminta untuk diunduh.";
}
?>