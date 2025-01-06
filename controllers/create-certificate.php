<?php
require 'vendor/autoload.php'; // Pastikan Dompdf sudah diinstal

use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil data dari form atau database
$template = 'path_to_certificate_template_image.jpg'; // Path ke template sertifikat
$recipient_name = $_POST['recipient_name'];           // Nama penerima sertifikat
$title = $_POST['title'];                             // Judul sertifikat
$position = $_POST['position'];                       // Posisi penerima sertifikat
$description = $_POST['description'];                 // Deskripsi sertifikat
$organizer_signature = $_POST['organizer_signature']; // Nama tanda tangan panitia
$chairman_signature = $_POST['chairman_signature'];   // Nama tanda tangan ketua

// Inisialisasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Jika ada file gambar remote
$dompdf = new Dompdf($options);

// Buat konten sertifikat dengan HTML + CSS
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .certificate {
            position: relative;
            width: 100%;
            height: 100%;
            background: url(' . $template . ') no-repeat center center;
            background-size: cover;
        }
        .content {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            color: #333;
        }
        .details {
            font-size: 18px;
            color: #555;
        }
        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding: 0 10%;
        }   
        .signatures div {
            text-align: center;
        }
    </style>
    <body>
    <div class="certificate">
    </head>
        <div class="content">
            <h1>' . htmlspecialchars($title) . '</h1>
            <p class="details">Diberikan kepada</p>
            <h2>' . htmlspecialchars($recipient_name) . '</h2>
            <p class="details">' . htmlspecialchars($position) . '</p>
            <p>' . nl2br(htmlspecialchars($description)) . '</p>
        </div>
        <div class="signatures">
            <div>
                <p>' . htmlspecialchars($organizer_signature) . '</p>
                <hr style="width: 200px;">
                <p>Panitia</p>
            </div>
            <div>
                <p>' . htmlspecialchars($chairman_signature) . '</p>
                <hr style="width: 200px;">
                <p>Ketua</p>
            </div>
        </div>
    </div>
</body>
</html>
';

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Atur ukuran kertas dan orientasi (landscape/portrait)
$dompdf->setPaper('A4', 'landscape');

// Render HTML menjadi PDF
$dompdf->render();

// Berikan nama file sertifikat
$filename = 'Sertifikat_' . preg_replace('/\s+/', '_', $recipient_name) . '.pdf';

// Kirim header untuk mengunduh file
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=$filename");

// Output file PDF ke browser
echo $dompdf->output();
exit;
?>
