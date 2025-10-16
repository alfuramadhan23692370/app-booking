<?php
$host = "localhost";
$user = "root";        // ✅ benar
$pass = "";            // ✅ dikosongkan
$db   = "booking_app_db"; // atau sesuaikan dengan database kamu

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
