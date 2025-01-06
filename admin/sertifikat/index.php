<?php require_once '../auth_admin.php'; // Memastikan hanya admin yang bisa mengakses halaman ini
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Template Sertifikat &mdash; CertifyMe</title>

    <!-- <?php include '../resources/style2.php'; ?> -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <?php
            $status = isset($_GET['status']) ? $_GET['status'] : '';
            ?>

            <!-- Modal untuk sukses atau gagal -->
            <?php if ($status == 'success'): ?>
                <script>
                    // Menampilkan modal sukses
                    window.onload = function() {
                        alert('Data berhasil dihapus!');
                    };
                </script>
            <?php elseif ($status == 'error'): ?>
                <script>
                    // Menampilkan modal error
                    window.onload = function() {
                        alert('Terjadi kesalahan saat menghapus data.');
                    };
                </script>
            <?php endif; ?>

            <!-- Sidebar -->
            <?php include '../resources/sidebar2.php'; ?>

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Template Sertifikat</h1>
                    </div>

                    <a class="btn btn-success" href="create.php">Tambah Template</a>

                    <div class="section-body">

                        <h2 class="section-title">Data Template</h2>
                        <p class="section-lead">
                            Berikut adalah template yang tersedia saat ini.
                        </p>

                        <?php
                        include '../db.php'; // Koneksi database

                        // Query untuk mengambil data template sertifikat
                        $query = "SELECT * FROM certificate_templates";
                        $result = mysqli_query($conn, $query);
                        ?>

                        <div class="row">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4>' . htmlspecialchars($row['name']) . '</h4>
                                            <div class="card-header-action">
                                                <form action="/admin/sertifikat/delete-exec.php" method="POST">
                                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <img src="../templates/' . htmlspecialchars($row['file_path']) . '" alt="Card Image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>';
                                }
                            } else {
                                echo '
                            <div class="col-12">
                                <div class="alert alert-warning" role="alert">
                                    Belum ada template sertifikat.
                                </div>
                            </div>';
                            }
                            ?>
                        </div>



                    </div>
                </section>
            </div>

            <?php include '../resources/footer.php'; ?>

        </div>
    </div>

    <?php include '../resources/js2.php'; ?>

</body>


</html>