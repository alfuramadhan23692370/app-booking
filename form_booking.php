<?php
include 'koneksi.php';

function generateBangku($conn) {
    $result = mysqli_query($conn, "SELECT MAX(CAST(no_bangku AS UNSIGNED)) as max FROM pemesanan");
    $row = mysqli_fetch_assoc($result);
    $next = $row['max'] ? $row['max'] + 1 : 1;
    return $next;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_penumpang'];
    $alamat = $_POST['alamat'];
    $asal = $_POST['pelabuhan_asal'];
    $tujuan = $_POST['tujuan'];
    $tgl_berangkat = $_POST['tanggal_berangkat'];
    $jam_berangkat = $_POST['jam_berangkat'];
    $tgl_tiba = $_POST['tanggal_tiba'];
    $jam_tiba = $_POST['jam_tiba'];

    $no_bangku = generateBangku($conn); // ← Otomatis

    $insert = mysqli_query($conn, "INSERT INTO pemesanan 
        (nama_penumpang, no_bangku, alamat, pelabuhan_asal, tujuan, tanggal_berangkat, jam_berangkat, tanggal_tiba, jam_tiba)
        VALUES ('$nama', '$no_bangku', '$alamat', '$asal', '$tujuan', '$tgl_berangkat', '$jam_berangkat', '$tgl_tiba', '$jam_tiba')
    ");

    if ($insert) {
        $id = mysqli_insert_id($conn);
        header("Location: admin/cetak.php?id=$id");
        exit;
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Tiket Kapal</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pemesanan Tiket Kapal</h2>
    <form method="POST">
        <label>Nama Penumpang:</label>
        <input type="text" name="nama_penumpang" required>

        <label>Alamat:</label>
        <textarea name="alamat" rows="3" required></textarea>

        <label>Pelabuhan Asal:</label>
        <input type="text" name="pelabuhan_asal" required>

        <label>Tujuan:</label>
        <input type="text" name="tujuan" required>

        <label>Tanggal Berangkat:</label>
        <input type="date" name="tanggal_berangkat" required>

        <label>Jam Berangkat:</label>
        <input type="time" name="jam_berangkat" required>

        <label>Tanggal Tiba:</label>
        <input type="date" name="tanggal_tiba" required>

        <label>Jam Tiba:</label>
        <input type="time" name="jam_tiba" required>

        <button type="submit">Simpan & Cetak Tiket</button>
    </form>
</div>

</body>
</html>
