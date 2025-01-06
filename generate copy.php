<?php
// Koneksi ke database
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Certificate</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .stepper-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .template-preview {
            width: 300px;  
            height: 200px;
            object-fit: contain; /* Maintain aspect ratio */
        }
        .template-option {
            display: flex;
            align-items: center;
        }
        .template-option img {
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="stepper-container bg-white p-4 shadow rounded">
            <h2 class="text-center mb-4">Certificate Generator</h2>
            <form action="generate_cert.php" method="POST" id="certificate-form">
                <!-- Stepper Navigation -->
                <div class="stepper mb-4">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-template-tab" data-bs-toggle="tab" data-bs-target="#nav-template" type="button" role="tab" aria-controls="nav-template" aria-selected="true">1. Template</button>
                            <button class="nav-link" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="false">2. Details</button>
                            <button class="nav-link" id="nav-signatures-tab" data-bs-toggle="tab" data-bs-target="#nav-signatures" type="button" role="tab" aria-controls="nav-signatures" aria-selected="false">3. Signatures</button>
                        </div>
                    </nav>
                </div>

                <!-- Stepper Content -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- Step 1: Template -->
                    <div class="tab-pane fade show active" id="nav-template" role="tabpanel" aria-labelledby="nav-template-tab">
                        <div class="mb-3">
                            <label for="template" class="form-label">Choose Template:</label>
                            <select class="form-select" name="template" id="template" required>
                                <option value="" disabled selected>Select a template</option>
                                <?php foreach ($templates as $template): ?>
                                    <option value="<?php echo $template['id']; ?>" data-image="<?php echo '../admin/templates/' . $template['file_path']; ?>">
                                        <?php echo $template['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="template-preview" class="mb-3">
                            <!-- Preview Gambar Template -->
                            <img id="preview-img" src="" alt="Template Preview" class="template-preview" style="display:none;">
                        </div>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>

                    <!-- Step 2: Details -->
                    <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                        <div class="mb-3">
                            <label for="title" class="form-label">Certificate Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Recipient Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                            <button type="button" class="btn btn-primary next-tab">Next</button>
                        </div>
                    </div>

                    <!-- Step 3: Signatures -->
                    <div class="tab-pane fade" id="nav-signatures" role="tabpanel" aria-labelledby="nav-signatures-tab">
                        <div class="mb-3">
                            <label for="sign_panitia" class="form-label">Organizer's Name:</label>
                            <input type="text" class="form-control" id="sign_panitia" name="sign_panitia" required>
                        </div>
                        <div class="mb-3">
                            <label for="sign_ketua" class="form-label">Chairperson's Name:</label>
                            <input type="text" class="form-control" id="sign_ketua" name="sign_ketua" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                            <button type="submit" class="btn btn-success">Generate Certificate</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Stepper Navigation Logic
        document.querySelectorAll('.next-tab').forEach(button => {
            button.addEventListener('click', () => {
                const activeTab = document.querySelector('.nav-tabs .active');
                const nextTab = activeTab.parentElement.nextElementSibling?.querySelector('button');
                if (nextTab) nextTab.click();
            });
        });

        document.querySelectorAll('.prev-tab').forEach(button => {
            button.addEventListener('click', () => {
                const activeTab = document.querySelector('.nav-tabs .active');
                const prevTab = activeTab.parentElement.previousElementSibling?.querySelector('button');
                if (prevTab) prevTab.click();
            });
        });

        // Update preview image when template is selected
        document.getElementById('template').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            const previewImg = document.getElementById('preview-img');
            
            if (imageUrl) {
                previewImg.src = imageUrl;
                previewImg.style.display = 'block';
            }
        });
    </script>
</body>
</html>