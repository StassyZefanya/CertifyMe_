<?php
session_start(); // Mulai session untuk menyimpan pesan

// Koneksi ke database
require_once 'controllers/db.php';

$success_message = ''; // Variabel untuk pesan keberhasilan

// Proses data form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $username = htmlspecialchars($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

  // Periksa apakah username sudah terdaftar
  $checkQuery = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($checkQuery);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['register_error'] = "Username sudah terdaftar. Silakan gunakan username lain.";
  } else {
    // Insert data ke database
    $insertQuery = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $name, $username, $password);

    if ($stmt->execute()) {
      $_SESSION['register_success'] = "Registrasi berhasil! Silakan <a href='login.php'>masuk</a>.";
    } else {
      $_SESSION['register_error'] = "Terjadi kesalahan: " . $conn->error;
    }
  }

  $stmt->close();
}

$conn->close();

// Ambil pesan jika ada
if (isset($_SESSION['register_success'])) {
  $success_message = $_SESSION['register_success'];
  unset($_SESSION['register_success']);
}

if (isset($_SESSION['register_error'])) {
  $error_message = $_SESSION['register_error'];
  unset($_SESSION['register_error']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="dashboard/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="dashboard/assets/img/favicon.png">
  <title>
    Register &mdash; CertifyMe
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
  <!-- CSS Files -->
  <link id="pagestyle" href="dashboard/assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('dashboard/assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Selamat datang!</h1>
              <p class="text-lead text-white">Untuk menggunakan website silahkan daftar secara GRATIS, terlebih dahulu.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center">
                <h5>Daftar Akun</h5>
                <!-- Pesan Berhasil -->
                <?php if (!empty($success_message)): ?>
                  <div class="alert alert-success text-center">
                    <?= $success_message; ?>
                  </div>
                <?php endif; ?>

                <!-- Pesan Gagal -->
                <?php if (!empty($error_message)): ?>
                  <div class="alert alert-danger text-center">
                    <?= $error_message; ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <form role="form text-left" method="POST">
                  <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username-addon" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Sudah Punya Akun? <a href="login.php" class="text-dark font-weight-bolder">Masuk</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="dashboard/assets/js/core/popper.min.js"></script>
  <script src="dashboard/assets/js/core/bootstrap.min.js"></script>
  <script src="dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="dashboard/assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>