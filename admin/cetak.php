<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tiket tidak ditemukan.";
    exit;
}

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Data tiket tidak ditemukan.";
    exit;
}

$tiket = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Tiket Kapal - <?= $tiket['nama_penumpang'] ?></title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #eef2f3;
            margin: 0;
            padding: 40px;
        }

        .eticket {
            max-width: 750px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .eticket-header {
            background-color: #023e8a;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .eticket-header h2 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 1px;
        }

        .eticket-body {
            padding: 30px 40px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #555;
            width: 160px;
        }

        .value {
            color: #000;
            flex: 1;
        }

        .qr-code {
            text-align: center;
            margin-top: 30px;
        }

        .qr-code img {
            width: 130px;
        }

        .footer {
            background: #f1f1f1;
            text-align: center;
            padding: 12px;
            font-size: 13px;
            color: #333;
        }

        .print-btn {
            text-align: center;
            margin-top: 25px;
        }

        .print-btn button {
            padding: 10px 18px;
            background-color: #0077b6;
            color: white;
            border: none;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="eticket">
    <div class="eticket-header">
        <h2>E-TIKET PENUMPANG KAPAL</h2>
        <small><?= strtoupper($tiket['pelabuhan_asal']) ?> → <?= strtoupper($tiket['tujuan']) ?></small>
    </div>

    <div class="eticket-body">
        <div class="row">
            <div class="label">ID Tiket</div>
            <div class="value"><?= $tiket['id'] ?></div>
        </div>
        <div class="row">
            <div class="label">Nama</div>
            <div class="value"><?= htmlspecialchars($tiket['nama_penumpang']) ?></div>
        </div>
        <div class="row">
            <div class="label"> Alamat</div>
            <div class="value"><?= htmlspecialchars($tiket['alamat']) ?></div>
        </div>
        <div class="row">
            <div class="label">No Bangku</div>
            <div class="value"><?= $tiket['no_bangku'] ?></div>
        </div>
        <div class="row">
            <div class="label">Keberangkatan</div>
            <div class="value"><?= $tiket['tanggal_berangkat'] ?> <?= $tiket['jam_berangkat'] ?></div>
        </div>
        <div class="row">
            <div class="label">Tiba</div>
            <div class="value"><?= $tiket['tanggal_tiba'] ?> <?= $tiket['jam_tiba'] ?></div>
        </div>

        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=TIKET<?= $tiket['id'] ?>" alt="QR Code">
            <p style="margin-top: 5px;">Scan saat Membayar</p>
        </div>

        <div class="print-btn">
            <button onclick="window.print()">Cetak E-Tiket</button>
        </div>
    </div>

    <div class="footer">
        Silakan tunjukkan e-tiket ini saat check-in di pelabuhan. Tiket hanya berlaku sesuai jadwal tertera.
    </div>
</div>

</body>
</html>
