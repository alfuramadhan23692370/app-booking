<?php
// File: admin/index.php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "booking_app_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM bookings ORDER BY booking_date DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Tiket Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #dbeafe, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 60px;
        }
        .table th {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }
        .header-box {
            background: #0d6efd;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-cetak {
            font-size: 0.85em;
        }
        .logout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header-box">
            <h3>🛳 Dashboard Admin - Data Pemesanan Tiket</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['no_hp']) ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td class="text-center"><?= $row['num_tickets'] ?></td>
                            <td>Rp <?= number_format($row['total_price'], 0, ',', '.') ?></td>
                            <td class="text-uppercase text-center">
                                <span class="badge bg-<?= $row['status'] === 'confirmed' ? 'success' : ($row['status'] === 'cancelled' ? 'danger' : 'secondary') ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="cetak.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm btn-cetak" target="_blank">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center logout">
            <a href="logout.php" class="btn btn-outline-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
