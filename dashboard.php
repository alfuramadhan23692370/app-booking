<?php
include('koneksi.php');


$tanggal_filter = $_GET['tanggal'] ?? '';

$where = '';
if ($tanggal_filter) {
    $where = "WHERE tanggal_berangkat = '$tanggal_filter'";
}

$query = "SELECT * FROM pemesanan $where ORDER BY tanggal_berangkat DESC, jam_berangkat DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Booking Kapal</title>
<style>
    /* Background Laut fullscreen */
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
        /* Ganti url ini dengan path gambar laut yang kamu punya */
        background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
        background-size: cover;
        position: relative;
        color: #fff;
    }
    /* Overlay gelap supaya teks terbaca */
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 50, 0.5);
        z-index: -1;
    }
    /* Container agar isi tidak langsung di pinggir layar */
    .container {
        max-width: 1100px;
        margin: auto;
        padding: 20px;
        background-color: rgba(0,0,0,0.4);
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.7);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #a0d8ef;
        text-shadow: 0 0 8px #000;
    }
    form {
        max-width: 400px;
        margin: 0 auto 30px auto;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    input[type="date"] {
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        outline: none;
    }
    button {
        padding: 9px 18px;
        background-color:rgb(0, 0, 0);
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #02669b;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        max-width: 100%;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 8px rgba(0,0,0,0.3);
        color: #333;
    }
    th, td {
        padding: 14px 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
        vertical-align: middle;
    }
    th {
        background-color: #0288d1;
        color: white;
        font-weight: 600;
    }
    tr:hover {
        background-color: #cce6ff;
    }
    .btn-cetak {
        background-color: #0288d1;
        padding: 6px 12px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
    }
    .btn-cetak:hover {
        background-color: #02669b;
    }
    @media (max-width: 700px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }
        tr {
            margin-bottom: 15px;
        }
        th {
            display: none;
        }
        td {
            padding-left: 50%;
            position: relative;
        }
        td::before {
            content: attr(data-label);
            position: absolute;
            left: 12px;
            font-weight: 600;
            color: #0288d1;
        }
    }
</style>
</head>
<body>
<div class="container">
    <h1>Dashboard Admin</h1>

    <form method="GET" action="">
        <input type="date" name="tanggal" value="<?= htmlspecialchars($tanggal_filter) ?>" />
        <button type="submit">Filter Tanggal</button>
        <button type="button" onclick="window.location='dashboard.php'">Reset</button>
    </form>
    <a href="logout.php" style="float:right; background:#d62828; color:white; padding:8px 12px; text-decoration:none; border-radius:4px;">Logout</a>
    <a href="hapus.php?id=<?php echo $row['id_pemesanan']; ?>" 
   onclick="return confirm('Yakin ingin menghapus data ini?')">
   Hapus
</a>



    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Penumpang</th>
                <th>Pelabuhan Asal</th>
                <th>Tujuan</th>
                <th>Berangkat</th>
                <th>No Bangku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td data-label="ID"><?= $row['id'] ?></td>
                    <td data-label="Nama"><?= htmlspecialchars($row['nama_penumpang']) ?></td>
                    <td data-label="Pelabuhan Asal"><?= htmlspecialchars($row['pelabuhan_asal']) ?></td>
                    <td data-label="Tujuan"><?= htmlspecialchars($row['tujuan']) ?></td>
                    <td data-label="Berangkat"><?= htmlspecialchars($row['tanggal_berangkat'] . ' ' . $row['jam_berangkat']) ?></td>
                    <td data-label="No Bangku"><?= htmlspecialchars($row['no_bangku']) ?></td>
                    <td data-label="Aksi">
                        <a class="btn-cetak" href="cetak.php?id=<?= $row['id'] ?>" target="_blank" rel="noopener">Cetak Tiket</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" style="text-align:center; padding:20px;">Tidak ada data pemesanan.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
