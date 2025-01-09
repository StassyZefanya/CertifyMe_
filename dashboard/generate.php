<?php
session_start(); // Mulai sesi

include '../controllers/db.php';

// Cek apakah user sudah login, jika belum, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="/dashboard/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/dashboard/assets/img/favicon.png"> -->
    <title>
        Dashboard &mdash; CertifyMe
    </title>

    <?php include './resources/style.php'; ?>

    <style>
        .template-preview {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
        }

        .vertical-stepper {
            position: relative;
        }

        .vertical-stepper ul {
            padding: 0;
            list-style-type: none;
        }

        .vertical-stepper ul li {
            padding: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .vertical-stepper ul li span {
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            margin-right: 10px;
        }

        .vertical-stepper ul li.active span {
            background-color: #28a745;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }
    </style>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- Sidebar -->
    <?php include './resources/sidebar.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php include './resources/navbar.php'; ?>

        <div class="container-fluid py-4">

            <form action="generate_cert.php" method="POST" id="certificate-form">
                <!-- Vertical Stepper Navigation -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="vertical-stepper">
                            <ul class="list-group">
                                <li class="list-group-item active" id="step-template">
                                    <span>1</span> Memilih Template
                                </li>
                                <li class="list-group-item" id="step-details">
                                    <span>2</span> Detail Penerima
                                </li>
                                <li class="list-group-item" id="step-signatures">
                                    <span>3</span> Penanggung Jawab
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Stepper Content -->
                        <div id="step-content">
                            <!-- Step 1: Template -->
                            <div class="step-content active" id="content-template">
                                <div class="mb-3">
                                    <label for="template" class="form-label">Pilih Template:</label>
                                    <select class="form-select" name="background_image" id="background_image" required>
                                        <option value="" disabled selected>Pilih dibawah in</option>
                                        <?php foreach ($templates as $template): ?>
                                            <option
                                                value="admin/templates/<?php echo $template['file_path']; ?>"
                                                data-image="../admin/templates/<?php echo $template['file_path']; ?>">
                                                <?php echo $template['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="template-preview" class="mb-3">
                                    <img id="preview-img" src="" alt="Template Preview" class="template-preview" style="display: none; max-width: 100%; height: auto;">
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 2: Details -->
                            <div class="step-content" id="content-details">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Sertifikat:</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Penerima:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Posisi:</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi:</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>

                            <!-- Step 3: Signatures -->
                            <div class="step-content" id="content-signatures">
                                <div class="mb-3">
                                    <label for="nama_1" class="form-label">Nama ke- 1:</label>
                                    <input type="text" class="form-control" id="nama_1" name="nama_1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_2" class="form-label">Nama ke- 2:</label>
                                    <input type="text" class="form-control" id="nama_2" name="nama_2" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan_1" class="form-label">Jabatan ke- 1:</label>
                                    <input type="text" class="form-control" id="jabatan_1" name="jabatan_1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan_2" class="form-label">Jabatan ke- 2:</label>
                                    <input type="text" class="form-control" id="jabatan_2" name="jabatan_2" required>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                    <button type="submit" class="btn btn-success">Generate Certificate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                const backgroundImageSelect = document.getElementById('background_image');
                const previewImage = document.getElementById('preview-img');

                backgroundImageSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const imagePath = selectedOption.getAttribute('data-image');

                    if (imagePath) {
                        previewImage.src = imagePath;
                        previewImage.style.display = 'block'; // Tampilkan gambar
                    } else {
                        previewImage.style.display = 'none'; // Sembunyikan gambar jika tidak ada
                    }
                });

                function validateCurrentStep() {
                    const activeStep = document.querySelector('.step-content.active');
                    const inputs = activeStep.querySelectorAll('input, select, textarea');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            isValid = false;
                            input.classList.add('is-invalid'); // Tambahkan kelas untuk menandai input tidak valid
                        } else {
                            input.classList.remove('is-invalid'); // Hapus kelas jika valid
                        }
                    });

                    return isValid;
                }

                document.querySelectorAll('.vertical-stepper ul li').forEach((step, index) => {
                    step.addEventListener('click', () => {
                        document.querySelectorAll('.step-content').forEach(content => content.classList.remove('active'));
                        document.querySelectorAll('.vertical-stepper ul li').forEach(item => item.classList.remove('active'));
                        step.classList.add('active');
                        document.getElementById(`content-${step.id.split('-')[1]}`).classList.add('active');
                    });
                });

                const nextButtons = document.querySelectorAll('.next-step');
                nextButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        if (validateCurrentStep()) {
                            const currentStep = document.querySelector('.step-content.active');
                            const nextStep = currentStep.nextElementSibling;
                            if (nextStep) {
                                currentStep.classList.remove('active');
                                nextStep.classList.add('active');
                                const activeNavItem = document.querySelector('.vertical-stepper ul li.active');
                                if (activeNavItem.nextElementSibling) {
                                    activeNavItem.nextElementSibling.classList.add('active');
                                }
                            }
                        } else {
                            alert('Harap isi semua field yang diperlukan sebelum melanjutkan.');
                        }
                    });
                });

                const prevButtons = document.querySelectorAll('.prev-step');
                prevButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const currentStep = document.querySelector('.step-content.active');
                        const prevStep = currentStep.previousElementSibling;
                        if (prevStep) {
                            currentStep.classList.remove('active');
                            prevStep.classList.add('active');
                            const activeNavItem = document.querySelector('.vertical-stepper ul li.active');
                            if (activeNavItem.previousElementSibling) {
                                activeNavItem.previousElementSibling.classList.add('active');
                            }
                        }
                    });
                });

                const form = document.getElementById('certificate-form');
                form.addEventListener('submit', event => {
                    if (!validateCurrentStep()) {
                        event.preventDefault(); // Hentikan pengiriman form jika step terakhir tidak valid
                        alert('Harap isi semua field yang diperlukan.');
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    const steps = document.querySelectorAll('.vertical-stepper .list-group-item');
                    const stepContents = document.querySelectorAll('.step-content');
                    const nextButtons = document.querySelectorAll('.next-step');
                    const prevButtons = document.querySelectorAll('.prev-step');

                    let currentStepIndex = 0;

                    // Fungsi untuk memperbarui langkah aktif
                    function updateStep(index) {
                        // Hapus kelas 'active' dari semua langkah dan konten
                        steps.forEach((step) => step.classList.remove('active'));
                        stepContents.forEach((content) => content.classList.remove('active'));

                        // Tambahkan kelas 'active' ke langkah dan konten saat ini
                        steps[index].classList.add('active');
                        stepContents[index].classList.add('active');
                    }

                    // Fungsi untuk validasi formulir di langkah saat ini
                    function validateCurrentStep() {
                        const currentContent = stepContents[currentStepIndex];
                        const inputs = currentContent.querySelectorAll('input, select, textarea');

                        for (const input of inputs) {
                            if (!input.checkValidity()) {
                                alert(`Harap isi semua field yang diperlukan di langkah ${currentStepIndex + 1}`);
                                input.focus();
                                return false;
                            }
                        }
                        return true;
                    }

                    // Event listener untuk tombol Next
                    nextButtons.forEach((button) => {
                        button.addEventListener('click', () => {
                            if (validateCurrentStep()) {
                                if (currentStepIndex < steps.length - 1) {
                                    currentStepIndex++;
                                    updateStep(currentStepIndex);
                                }
                            }
                        });
                    });

                    // Event listener untuk tombol Previous
                    prevButtons.forEach((button) => {
                        button.addEventListener('click', () => {
                            if (currentStepIndex > 0) {
                                currentStepIndex--;
                                updateStep(currentStepIndex);
                            }
                        });
                    });

                    // Set langkah awal ke aktif
                    updateStep(currentStepIndex);
                });
            </script>
        </div>
    </main>
    <?php include './resources/scripts.php'; ?>
</body>

</html>