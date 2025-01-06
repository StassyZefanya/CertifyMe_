<?php
session_start();
session_unset(); // Menghapus semua data session
session_destroy(); // Menghancurkan session
header("Location: ../index.php");
exit();
