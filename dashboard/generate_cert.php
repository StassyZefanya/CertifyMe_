<?php
include '../controllers/db.php'; // Koneksi database
require '../fpdf/fpdf.php';

// Mulai sesi untuk mendapatkan user_id
session_start();

// Cek apakah user sudah login dan user_id tersedia di sesi
// if (!isset($_SESSION['user_id'])) {
//     die("User tidak terautentikasi. Silakan login terlebih dahulu.");
// }

$_SESSION['id'] = $user_id;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $template = 'template';
    $background_image = htmlspecialchars($_POST['background_image']); // Ambil background image dari form
    $title = htmlspecialchars($_POST['title']);
    $name = htmlspecialchars($_POST['name']);
    $position = htmlspecialchars($_POST['position']);
    $description = htmlspecialchars($_POST['description']);
    
    // Additional fields for signatures (if applicable)
    $nama_1 = htmlspecialchars($_POST['nama_1']);
    $jabatan_1 = htmlspecialchars($_POST['jabatan_1']);
    $nama_2 = htmlspecialchars($_POST['nama_2']);
    $jabatan_2 = htmlspecialchars($_POST['jabatan_2']);
    
    // Handling optional signature image upload (if applicable)
    $sign_1_image = null;
    $sign_2_image = null;

    if (isset($_FILES['sign_1_image']) && $_FILES['sign_1_image']['error'] == 0) {
        $sign_1_image = 'sign_1_' . uniqid() . '.png';
        move_uploaded_file($_FILES['sign_1_image']['tmp_name'], 'uploads/' . $sign_1_image);
    }

    if (isset($_FILES['sign_2_image']) && $_FILES['sign_2_image']['error'] == 0) {
        $sign_2_image = 'sign_2_' . uniqid() . '.png';
        move_uploaded_file($_FILES['sign_2_image']['tmp_name'], 'uploads/' . $sign_2_image);
    }

    $pdf = new FPDF('L', 'mm', 'A4'); // Orientasi Lanskap
    $pdf->AddPage();

    // Set font dan warna
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(0, 0, 0);

    // Menggunakan background template yang dipilih
    $pdf->Image('../' . $background_image, 0, 0, 297, 210);

    // Judul Sertifikat
    $pdf->SetXY(32, 52.8); // Posisi X = 32 mm, Y = 52.8 mm
    $pdf->SetFont('Arial', 'B', 50.3);
    $pdf->Cell(233.1, 21.1, strtoupper($title), 0, 1, 'C'); // Judul sertifikat

    // Nama penerima
    $pdf->SetFont('Times', 'I', 54.8); // Menggunakan Times italic
    $pdf->SetXY(32, 81.6);
    $pdf->SetTextColor(255, 165, 0); // Warna teks (Orange)
    $pdf->Cell(233.1, 23.2, $name, 0, 1, 'C');

    // Posisi penerima
    $pdf->SetFont('Arial', 'BI', 29.4);
    $pdf->SetXY(100.7, 119.1);
    $pdf->SetTextColor(0, 0, 0); // Warna teks kembali hitam
    $pdf->Cell(95.6, 12.2, $position, 0, 1, 'C');

    // Deskripsi
    $pdf->SetFont('Arial', '', 12.3);
    $pdf->SetXY(57.7, 135.5);
    $pdf->MultiCell(191.4, 11.2, $description, 0, 'C');

    // Tanda tangan
    $pdf->SetXY(40.1, 168.1);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(79.5, 5.9, $nama_1, 0, 1, 'C'); // Garis
    $pdf->SetXY(40.1, 175);
    $pdf->Cell(60, 10, "Panitia", 0, 1, 'C');

    $pdf->SetXY(177.3, 168.1);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(79.5, 5.9, $nama_2, 0, 1, 'C'); // Garis
    $pdf->SetXY(177.3, 175);
    $pdf->Cell(60, 10, "Ketua", 0, 1, 'C');

    // Simpan file PDF
    $file_name = "certificate_" . uniqid() . ".pdf";
    $file_path = "../generated/$file_name";
    $pdf->Output('F', $file_path);

    // Cek apakah file berhasil dibuat
    if (!file_exists($file_path)) {
        die("Error: File PDF gagal dibuat.");
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO certificates (user_id, template, title, name, position, description, nama_1, jabatan_1, nama_2, jabatan_2, sign_1_image, sign_2_image, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssssss", $user_id, $template, $title, $name, $position, $description, $nama_1, $jabatan_1, $nama_2, $jabatan_2, $sign_1_image, $sign_2_image, $file_path);
    $stmt->execute();
    $stmt->close();

    // Redirect untuk unduh PDF
    header("Location: download_cert.php?file=$file_name");

    exit;
}
?>
