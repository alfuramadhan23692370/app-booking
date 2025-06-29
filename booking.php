<?php
$conn = new mysqli("localhost", "root", "", "booking_app_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $schedule_id    = $_POST['schedule_id'];
    $nama_pemesan   = $_POST['nama_pemesan'];
    $email          = $_POST['email'];
    $no_hp          = $_POST['no_hp'];
    $tanggal        = $_POST['tanggal'];
    $num_tickets    = $_POST['num_tickets'];

    // Ambil data jadwal
    $stmt_price = $conn->prepare("SELECT item_name, origin_location, destination_location, departure_time, price FROM schedules WHERE id = ?");
    $stmt_price->bind_param("i", $schedule_id);
    $stmt_price->execute();
    $stmt_price->bind_result($item_name, $origin, $destination, $departure, $ticket_price);
    $stmt_price->fetch();
    $stmt_price->close();

    // Hitung total harga
    $total_price = $ticket_price * $num_tickets;

    // Simpan booking
    $stmt = $conn->prepare("INSERT INTO bookings 
        (schedule_id, nama_pemesan, email, no_hp, tanggal, num_tickets, total_price) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssii", $schedule_id, $nama_pemesan, $email, $no_hp, $tanggal, $num_tickets, $total_price);

    if ($stmt->execute()) {
        echo '
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Booking Berhasil</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    background: linear-gradient(to right, #f0f8ff, #ffffff);
                    font-family: "Segoe UI", sans-serif;
                }
                .ticket-box {
                    max-width: 700px;
                    margin: 50px auto;
                    background: #ffffff;
                    padding: 30px;
                    border-radius: 16px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                    animation: fadeIn 0.6s ease;
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(30px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .ticket-header {
                    font-size: 24px;
                    font-weight: bold;
                    color: #198754;
                }
                .ticket-detail {
                    font-size: 16px;
                    margin-top: 20px;
                }
                .ticket-detail span {
                    font-weight: bold;
                }
                .btn-custom {
                    margin-top: 25px;
                }
            </style>
        </head>
        <body>
            <div class="ticket-box text-center">
                <div class="ticket-header">🎉 Pemesanan Tiket Berhasil!</div>
                <p class="mt-2">Terima kasih, <strong>' . htmlspecialchars($nama_pemesan) . '</strong>.</p>

                <div class="ticket-detail text-start mt-4">
                    <p><span>Jadwal:</span> ' . $item_name . ' (' . $origin . ' → ' . $destination . ')</p>
                    <p><span>Keberangkatan:</span> ' . date('d M Y H:i', strtotime($departure)) . '</p>
                    <p><span>Jumlah Tiket:</span> ' . $num_tickets . '</p>
                    <p><span>Total Harga:</span> Rp ' . number_format($total_price, 0, ',', '.') . '</p>
                    <p><span>Email:</span> ' . htmlspecialchars($email) . '</p>
                    <p><span>Nomor HP:</span> ' . htmlspecialchars($no_hp) . '</p>
                    <p><span>Tanggal Pemesanan:</span> ' . date('d M Y', strtotime($tanggal)) . '</p>
                </div>

                <a href="form_booking.html" class="btn btn-primary btn-custom">🔁 Pesan Lagi</a>
            </div>
        </body>
        </html>';
    } else {
        echo "<div class='alert alert-danger text-center mt-5'>❌ Gagal menyimpan pemesanan: " . $stmt->error . "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='text-center mt-5'>Form belum dikirim.</div>";
}

$conn->close();
?>
