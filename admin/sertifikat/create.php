<?php require_once '../../controllers/auth_admin.php'; // Memastikan hanya admin yang bisa mengakses halaman ini
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Tambah Sertifikat &mdash; CertifyMe</title>

    <!-- <?php include '../resources/style2.php'; ?> -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">


            <!-- Sidebar -->
            <?php include '../resources/sidebar2.php'; ?>

            <div class="main-content">
                <?php
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                ?>

                <!-- Menampilkan pesan sukses atau error -->
                <?php if ($status == 'success'): ?>
                    <div class="alert alert-success" role="alert">
                        Template sertifikat berhasil ditambahkan!
                    </div>
                <?php elseif ($status == 'error'): ?>
                    <div class="alert alert-danger" role="alert">
                        Terjadi kesalahan saat menambahkan template sertifikat.
                    </div>
                <?php endif; ?>

                <section class="section">
                    <div class="section-header">
                        <h1>Tambah Sertifikat</h1>
                    </div>

                    <a class="btn btn-primary" href="index.php">Kembali</a>

                    <div class="section-body">

                        <form action="create-exec.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Menambahkan Template Sertifikat</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sertifikat</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="file" name="file_path" id="image-upload" required />
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                </section>
            </div>

            <?php include '../resources/footer.php'; ?>

        </div>
    </div>

    <?php include '../resources/js2.php'; ?>

</body>


</html>