<?php
session_start();
include '../controllers/db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil informasi user yang sedang login
$username = $_SESSION['username'];
$userQuery = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Ambil data sertifikat berdasarkan user_id
$certificatesQuery = "SELECT * FROM certificates WHERE user_id = ?";
$stmt = $conn->prepare($certificatesQuery);
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$certificatesResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Histori Sertifikat</title>
    <?php include './resources/style.php'; ?>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php include './resources/sidebar.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?php include './resources/navbar.php'; ?>

        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Histori Sertifikat</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul Sertifikat</th>
                                    <th>Nama Penerima</th>
                                    <th>Posisi</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($certificatesResult->num_rows > 0): ?>
                                    <?php $no = 1; ?>
                                    <?php while ($row = $certificatesResult->fetch_assoc()): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['position']); ?></td>
                                            <td><?php echo date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>

                                            <td>
                                                <a href="download_certi.php?file=<?php echo ($row['file_path']); ?>" class="btn btn-primary btn-sm">
                                                    Download
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada sertifikat yang dibuat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include './resources/scripts.php'; ?>
</body>

</html>
