<?php
// Mulai sesi dan masukkan file koneksi database
include 'db.php';

// Ambil data template sertifikat dari database
$query = "SELECT * FROM certificate_templates";
$result = mysqli_query($conn, $query);

$templates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $templates[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CertifyMe</title>

  <!--fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!--feather icons-->
  <script src="https://unpkg.com/feather-icons"></script>

  <!--stylecss-->
  <link rel="stylesheet" href="assets/css/style.css" />

  <style>
    /* Ensure the navbar has space between logo and the toggle button */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Style the hamburger button */
    #hamburger-menu {
      background: none;
      /* Remove default background */
      border: none;
      /* Remove default border */
      padding: 0.5rem;
      /* Add some padding */
      color: #333;
      /* Dark color for the icon */
      font-size: 1.5rem;
      /* Increase the size of the icon */
      transition: color 0.3s ease-in-out;
      /* Smooth color change */
      margin-left: auto;
      /* Push the button to the right */
      text-align: right;
      /* Align the text/icon to the right */
    }

    /* Change color of the hamburger icon on hover */
    #hamburger-menu:hover {
      color: #007bff;
      /* Change color on hover (Bootstrap primary color) */
    }

    #hamburger-menu i {
      width: 24px;
      /* Make sure the icon has some space */
      height: 24px;
      /* Set consistent size */
    }

    /* Ensure the navbar-collapse (menu) aligns to the left */
    .navbar-collapse {
      display: flex;
      justify-content: flex-end;
      /* Align navbar links to the right */
    }
  </style>
</head>

<body>

  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="#" class="navbar-logo navbar-brand">Certify<span>Me</span></a>
    <!-- Hamburger icon for mobile, aligned to the right -->
    <button id="hamburger-menu" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i data-feather="menu"></i> <!-- This will use the feather icons' menu icon -->
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav ms-auto">
        <a href="#home" class="nav-link">Home</a>
        <a href="#about" class="nav-link">Tentang Kami</a>
        <a href="#menu" class="nav-link">Menu</a>
        <a href="#contact" class="nav-link">Kontak</a>
        <a href="login.php" class="btn btn-primary login-button">Login</a>
      </div>
    </div>
  </nav>
  <!--nav end-->



  <!--Hero Section start-->
  <section class="hero" id="home">
    <main class="content">
      <h1>CREATE YOUR <span>CERTIFICATE</span></h1>
      <p>Selamat Datang di Website CertifyMe!</p>
      <p>Kami Menyediakan Template Sertifikat yang Siap Digunakan.</p>
    </main>
  </section>
  <!--Hero Section end-->

  <!--about section start-->
  <section id="about" class="about">
    <h2><span>ABOUT</span> US</h2>

    <div class="row">
      <div class="about-img">
        <img src="assets/img/crtf.jpg" alt="Tentang Kami" />
      </div>
      <div class="content">
        <h3>kenapa harus pakai template kami?</h3>
        <p>
          Kami menyediakan design template sertifikat event yang bisa kalian
          gunakan langsung. Kalian bisa langung menggunakan, mengubah, dan
          mendownload template yang kami sediakan. jangan takun kehabisan ide
          template, karena kami mempunyai template yang beragam.
        </p>
      </div>
    </div>
    <!--MENU SECTION START-->
  </section>
  <!--about section end-->

  <section id="menu" class="menu">
    <h2><span>DESIGN</span> TEMPLATE</h2>
    <p>Pilih Template yang Kamu Suka!</p>

    <div class="row">
      <?php foreach ($templates as $template): ?>
        <div class="menu-card">
          <img
            src="admin/templates/<?php echo htmlspecialchars($template['file_path']); ?>"
            alt="Template <?php echo htmlspecialchars($template['name']); ?>"
            class="menu-card-img" />
          <h3 class="menu-card-title">- <?php echo htmlspecialchars($template['name']); ?> -</h3>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <!--MENU SECTION END-->

  <!--CONTACT SECTION START-->
  <section id="contact" class="contact">
    <h2><span>CONTACT</span> US</h2>
    <p>Silahkan Hubungi Kami Untuk Mencetak Design Kamu!</p>

    <div class="row">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5042485767394!2d107.29312759999995!3d-6.328644699999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6977fb6f4bf2df%3A0x3f36bb06350dc901!2sTechnomart%20Galuh%20Mas!5e0!3m2!1sid!2sid!4v1730190698642!5m2!1sid!2sid"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="map"></iframe>

      <form action="">
        <div class="input-group">
          <i data-feather="user"></i>
          <input type="text" placeholder="Nama" />
        </div>
        <div class="input-group">
          <i data-feather="mail"></i>
          <input type="text" placeholder="Email" />
        </div>
        <div class="input-group">
          <i data-feather="phone"></i>
          <input type="text" placeholder="No Handphone" />
        </div>
        <button type="submit" class="btn">Kirim Pesan</button>
      </form>
    </div>
  </section>
  <!--CONTACT SECTION END-->

  <!--FOOTER-->
  <footer>
    <div class="socials">
      <a href="#">
        <i data-feather="instagram"></i>
      </a>
      <!-- <a href="#">
        <i data-feather="facebook"></i>
      </a> -->
    </div>

    <div class="links">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#contact">Kontak</a>
    </div>

    <div class="credit">
      <p>Created by <a href="">Stassy Zefanya</a>. | &copy; 2024.</p>
    </div>
  </footer>
  <!--FOOTER END-->

  <!--feather icons-->
  <script>
    feather.replace(); // This will render the feather icons after the page loads.
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!--JS-->
  <script src="assets/js/script.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</body>

</html>