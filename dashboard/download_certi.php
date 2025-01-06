<?php
if (isset($_GET['file'])) {
    $file_path = urldecode($_GET['file']);

    // Path lengkap file
    $full_path = $file_path;

    // Cek apakah file ada
    if (file_exists($full_path)) {
        // Atur header untuk mendownload file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($full_path) . '"');
        header('Content-Length: ' . filesize($full_path));
        header('Pragma: public');

        // Bersihkan output buffer
        ob_clean();
        flush();

        // Kirim file ke browser
        readfile($full_path);
        exit();
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "File tidak disediakan.";
}
?>
