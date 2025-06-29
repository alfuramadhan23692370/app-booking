<?php
$conn = new mysqli("localhost", "root", "", "booking_app_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = $conn->query("
    SELECT b.*, s.item_name, s.item_type, s.origin_location, s.destination_location, s.departure_time 
    FROM bookings b 
    JOIN schedules s ON b.schedule_id = s.id 
    WHERE b.id = $id
");

if ($result->num_rows === 0) {
    die("❌ Data tidak ditemukan.");
}

$data = $result->fetch_assoc();

// Nomor bangku (acak antara 1–200, bisa disesuaikan dengan kebutuhan)
$no_bangku = rand(1, 200);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5faff; font-family: 'Segoe UI', sans-serif; padding: 30px; }
        .ticket-box {
            background: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .ticket-box h2 {
            color: #0d6efd;
        }
        .ticket-info {
            margin-bottom: 15px;
        }
        .label { font-weight: bold; color: #444; }
        .value { font-size: 1.1em; }
        .print-btn {
            margin-top: 30px;
            text-align: center;
        }
        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="ticket-box">
        <h2 class="text-center">🎫 Tiket Pemesanan</h2>
        <hr>
        <div class="ticket-info">
            <div class="label">Nama Pemesan:</div>
            <div class="value"><?= htmlspecialchars($data['nama_pemesan']) ?></div>
        </div>
        <div class="ticket-info">
            <div class="label">Rute:</div>
            <div class="value"><?= $data['origin_location'] ?> → <?= $data['destination_location'] ?></div>
        </div>
        <div class="ticket-info">
            <div class="label">Tanggal Berangkat:</div>
            <div class="value"><?= date('d M Y, H:i', strtotime($data['departure_time'])) ?></div>
        </div>
        <div class="ticket-info">
            <div class="label">Jumlah Tiket:</div>
            <div class="value"><?= $data['num_tickets'] ?> orang</div>
        </div>
        <div class="ticket-info">
            <div class="label">Total Bayar:</div>
            <div class="value text-success">Rp<?= number_format($data['total_price'], 0, ',', '.') ?></div>
        </div>
        <div class="ticket-info">
            <div class="label">No. Bangku:</div>
            <div class="value text-primary fw-bold">A<?= $no_bangku ?></div>
        </div>
        <hr>
        <div class="print-btn text-center">
            <button onclick="window.print()" class="btn btn-success">🖨️ Cetak Tiket</button>
            <a href="admin/index.php" class="btn btn-secondary">🔙 Kembali</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
