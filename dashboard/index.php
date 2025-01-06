<?php
session_start(); // Mulai sesi

// Cek apakah user sudah login, jika belum, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="/dashboard/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/dashboard/assets/img/favicon.png"> -->
    <title>
        Dashboard &mdash; CertifyMe
    </title>

    <?php include 'resources/style.php'; ?>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- Sidebar -->
    <?php include 'resources/sidebar.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php include 'resources/navbar.php'; ?>

        <div class="container-fluid py-4">
            <div class="row mt-4">
                <h3>
                    Selamat Datang, <?php echo $_SESSION['username']; ?> ^_^ !!!
                </h3>
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <p class="mb-1 pt-2 text-bold">Buat sertifikat anda sekarang, bersama</p>
                                        <h5 class="font-weight-bolder">CertifyMe</h5>
                                        <p class="mb-5">Dengan berbagai tema anda bisa menyesuaikan dengan selera anda.</p>
                                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="/dashboard/generate.php">
                                            Buat Sekarang
                                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                                    <div class="bg-primary border-radius-lg h-100">
                                        <img src="assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                        <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                            <img class="w-100 position-relative z-index-2 pt-4" src="assets/img/illustrations/rocket-white.png" alt="rocket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card h-100 p-3">
                        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('assets/img/ivancik.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                                <h5 class="text-white font-weight-bolder mb-4 pt-2">Sudah pernah membuat sertifikat?</h5>
                                <!-- <p class="text-white">Lihat disini.</p> -->
                                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="history.php">
                                    Lihat disini
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include 'resources/scripts.php'; ?>

</body>

</html>