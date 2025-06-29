<?php
$conn = new mysqli("localhost", "root", "", "booking_app_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$schedules = $conn->query("SELECT id, item_name, origin_location, destination_location, departure_time, price FROM schedules WHERE status='active' ORDER BY departure_time ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Tiket Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
        }
        .container-custom {
            max-width: 1100px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.92);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .form-title {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 40px;
        }
        .form-label {
            font-weight: 600;
            color: #222;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
        }
        .btn-book {
            background-color: #0d6efd;
            color: white;
            border-radius: 12px;
            padding: 14px 0;
            font-size: 18px;
            font-weight: 600;
        }
        .btn-book:hover {
            background-color: #0a58ca;
        }
        .bi {
            margin-right: 8px;
        }
    </style>
</head>
<body>
<div class="container container-custom">
    <div class="form-title"><i class="bi bi-ticket-perforated"></i> Form Pemesanan Tiket Kapal</div>
    <form action="booking.php" method="POST">
        <div class="row g-4">
            <div class="col-md-12">
                <label class="form-label">Pilih Jadwal</label>
                <select name="schedule_id" class="form-select" required>
                    <option value="">-- Pilih Jadwal --</option>
                    <?php while($row = $schedules->fetch_assoc()): ?>
                        <option value="<?= $row['id']; ?>">
                            <?= $row['item_name']; ?> | <?= $row['origin_location']; ?> → <?= $row['destination_location']; ?> | <?= date('d M Y H:i', strtotime($row['departure_time'])) ?> | Rp<?= number_format($row['price'], 0, ',', '.') ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Pemesanan</label>
                <input type="date" name="tanggal" class="form-control" min="<?= date('Y-m-d'); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jumlah Tiket</label>
                <input type="number" name="num_tickets" class="form-control" min="1" value="1" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-book w-100">
                    <i class="bi bi-send-check"></i> Pesan Tiket Sekarang
                </button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php $conn->close(); ?>
