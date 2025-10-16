<?php
// db_connect.php - File untuk koneksi ke database

// --- KONFIGURASI KONEKSI DATABASE ANDA ---
// Ganti nilai-nilai ini dengan kredensial dari hosting Anda
$db_host = "localhost"; // Umumnya 'localhost'. Jika tidak berhasil, cek dokumentasi hosting Anda.
$db_user = "admin"; // Contoh: 'bookinguser' atau 'usernamehosting_bookinguser'
$db_pass = "admin123"; // Password kuat yang Anda buat untuk user DB
$db_name = "booking_app"; // Nama database lengkap yang Anda buat di cPanel (misal: 'usernamehosting_booking_db')
// --- AKHIR KONFIGURASI ---

// Buat koneksi ke database MySQL
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    // Jika koneksi gagal, hentikan eksekusi skrip dan tampilkan pesan error
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Anda bisa menghapus baris di bawah ini setelah memastikan koneksi berhasil
// echo "Koneksi database berhasil!"; 
?>