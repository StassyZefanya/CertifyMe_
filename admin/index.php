<?php
require_once '../controllers/auth_admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; CertifyMe</title>

  <?php include 'resources/style.php'; ?>

</head>

<body>
  <div id="app">
    <div class="main-wrapper ">
      <!-- Sidebar -->
      <?php include 'resources/sidebar.php'; ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Selamat Datang, Admin! ^_^</h1>
          </div>
        </section>
      </div>

      <?php include 'resources/footer.php'; ?>

    </div>
  </div>

  <?php include 'resources/js.php'; ?>
</body>

</html>