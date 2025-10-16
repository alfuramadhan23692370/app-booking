<?php
// Konfigurasi database
$host = "localhost";
$user = "root";   // default XAMPP
$pass = "";       // default XAMPP password kosong
$db   = "booking_app";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama   = $_POST['nama'] ?? '';
    $email  = $_POST['email'] ?? '';
    $asal   = $_POST['asal'] ?? '';
    $tujuan = $_POST['tujuan'] ?? '';
    $tanggal= $_POST['tanggal'] ?? '';
    $jumlah = $_POST['jumlah_tiket'] ?? '';

    // Validasi input
    if (!empty($nama) && !empty($email) && !empty($asal) && !empty($tujuan) && !empty($tanggal) && !empty($jumlah)) {
        // Query untuk insert data
        $stmt = $conn->prepare("INSERT INTO bookings (nama, email, asal, tujuan, tanggal, jumlah_tiket) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nama, $email, $asal, $tujuan, $tanggal, $jumlah);

        if ($stmt->execute()) {
            echo "<h2>✅ Booking berhasil!</h2>";
            echo "<p>Terima kasih, <b>$nama</b>. Data booking Anda telah tersimpan.</p>";
            echo "<a href='form_booking.php'>Kembali ke Form</a> | ";
            echo "<a href='list_booking.php'>Lihat Data Booking</a>";
        } else {
            echo "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>⚠️ Harap isi semua data sebelum submit!</p>";
        echo "<a href='form_booking.php'>Kembali ke Form</a>";
    }
}

$conn->close();
?>
