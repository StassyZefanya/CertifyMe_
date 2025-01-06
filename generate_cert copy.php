<?php
include 'db.php'; // Koneksi database
require 'fpdf/fpdf.php'; // Memuat pustaka FPDF

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $template = $_POST['template'];
    $title = htmlspecialchars($_POST['title']);
    $name = htmlspecialchars($_POST['name']);
    $position = htmlspecialchars($_POST['position']);
    $description = htmlspecialchars($_POST['description']);
    $sign_panitia = htmlspecialchars($_POST['sign_panitia']);
    $sign_ketua = htmlspecialchars($_POST['sign_ketua']);

    $pdf = new FPDF('L', 'mm', 'A4'); // Orientasi Lanskap
    $pdf->AddPage();

    // Set font dan warna
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Image('templates/bgf.png', 0, 0, 297, 210); // Lebar: 297 mm, Tinggi: 210 mm

    // Judul sertifikat
    // $pdf->Cell(0, 15, txt: strtoupper($title), 0, 1, 'C');

    // Judul "SERTIFIKAT PENGHARGAAN"
    // $pdf->SetXY(x: 32, 31.7); // Posisi X = 32 mm, Y = 31.7 mm
    // $pdf->SetFont('Arial', 'B', 50.3);
    // $pdf->Cell(233.1, 21.1, 'Sertifikat', 0, 1, align: 'C'); // C = rata tengah

    // $pdf->SetXY(32, 52.8); // Posisi X = 32 mm, Y = 31.7 mm
    // $pdf->SetFont('Arial',  'B', 27.4);
    // $pdf->Cell(233.1, 21.1, 'Penghargaan', 0, 1, align: 'C'); // C = rata tengah

    // Spasi
    // $pdf->Ln(10);

    // $pdf->SetFont('Arial', '', 14);
    // $pdf->SetXY(32, 52.8);
    // $pdf->Cell(0, 10, "Dengan bangga diberikan kepada:", 0, 1, 'C');

    // Nama penerima
    // $pdf->SetFont(family: 'Arial', 'B', 20);
    // $pdf->Cell(0, 10, $name, 0, 1, 'C');
    
    // Nama penerima "Ela Pramudya"
    $pdf->SetFont('Times', 'I', 54.8); // Menggunakan Times italic
    $pdf->SetXY(32, 81.6);
    $pdf->SetTextColor(255, 165, 0); // Warna teks (Orange)
    $pdf->Cell(233.1, 23.2, $name, 0, 1, 'C');


    // Posisi penerima
    // $pdf->SetFont('Arial', '', 16);
    // $pdf->Cell(0, 10, "As $position", 0, 1, 'C');

    // Teks "Sebagai PESERTA"
    // $pdf->SetFont('Arial', '', 54.8);
    // $pdf->SetXY(32, 108.2);
    // $pdf->SetTextColor(0, 0, 0); // Warna teks kembali hitam
    // $pdf->Cell(0, 10, "Sebagai :", 0, 1, 'C');

    // Teks "Sebagai PESERTA"
    $pdf->SetFont('Arial', 'BI', 29.4);
    $pdf->SetXY(100.7, 119.1);
    $pdf->SetTextColor(0, 0, 0); // Warna teks kembali hitam
    $pdf->Cell(95.6, 12.2, $position, 0, 1, 'C');


    // // Deskripsi
    // $pdf->Ln(10);
    // $pdf->SetFont('Arial', '', 14);
    // $pdf->MultiCell(0, 10, $description, 0, 'C');

    // Teks deskripsi (contoh placeholder)
    $pdf->SetFont('Arial', '', 12.3);
    $pdf->SetXY(57.7, 135.5);
    $pdf->MultiCell(191.4, 11.2, $description, 0, 'C');

    // Garis tanda tangan
    // Tanda tangan kiri
    $pdf->SetXY(40.1, 168.1);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(79.5, 5.9, $nama_1, 0, 1, 'C'); // Garis

    $pdf->SetXY(40.1, 175);
    $pdf->Cell(60, 10, $jabatan_1, 0, 1, 'C');

    // Tanda tangan kanan
    $pdf->SetXY(177.3, 168.1);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(79.5, 5.9, $nama_2, 0, 1, 'C'); // Garis

    $pdf->SetXY(177.3, 175);
    $pdf->Cell(60, 10, $jabatan_2, 0, 1, 'C');


    // Tanda tangan
    $pdf->Ln(20);
    $pdf->Cell(90, 10, $sign_1_image, 0, 0, 'C');
    $pdf->Cell(90, 10, $sign_2_image, 0, 1, 'C');

    // Simpan file PDF
    $file_name = "certificate_" . uniqid() . ".pdf";
    $file_path = "generated/$file_name";
    $pdf->Output('F', $file_path);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO certificates (template, title, name, position, description, sign_panitia, sign_ketua, file_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $template, $title, $name, $position, $description, $sign_panitia, $sign_ketua, $file_path);
    $stmt->execute();
    $stmt->close();

    // Redirect untuk unduh PDF
    header("Location: download_cert.php?file=$file_name");
    exit;
}
?>
