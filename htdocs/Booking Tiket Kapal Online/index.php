<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eTicketingKapal - Pencarian Jadwal Kapal</title>
    <!-- Link ke file CSS Anda. Pastikan style.css berada di folder yang sama. -->
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="navbar">
        <div class="logo">eTicketingKapal</div>
        <nav>
            <a href="#">🏠 Home</a>
            <a href="#">🎫 Tiket Penumpang</a>
            <a href="#">📦 Tiket Barang</a>
            <a href="#">🔍 Cek Tiket</a>
            <a href="#">❓ FAQ</a>
            <a href="#">⚓ Pelabuhan</a>
        </nav>
    </div>

    <div class="container">
        <div class="search-card">
            <h2>🚢 Pencarian Jadwal Kapal</h2>
            <p>Temukan jadwal pelayaran kapal antar pelabuhan di Aceh dan sekitarnya dengan mudah dan cepat.</p>

            <!-- 
                Bagian INPUT Formulir Pencarian
                
                Atribut 'action' pada form ini HARUS mengarah ke file PHP (atau endpoint backend lainnya) 
                yang akan memproses pencarian dan mengembalikan hasilnya.
                Contoh: action="search_schedule.php" jika Anda membuat file PHP terpisah.
                Contoh: action="http://localhost:6000/search" jika Anda menggunakan Node.js backend.
            -->
            <form action="search_schedule.php" method="POST"> 
                <div class="form-group">
                    <div>
                        <label for="origin_port">Pelabuhan Asal</label>
                        <select id="origin_port" name="origin_port">
                            <option value="">- PILIH ASAL -</option>
                            <!-- Opsi ini bisa diisi secara dinamis oleh JavaScript jika menggunakan API, 
                                 atau langsung di PHP jika halaman ini dihasilkan oleh PHP. -->
                            <option value="CLG">CLG - CALANG</option>
                            <option value="SNG">SNG - SINABANG</option>
                        </select>
                    </div>
                    <div>
                        <label for="destination_port">Pelabuhan Tujuan</label>
                        <select id="destination_port" name="destination_port">
                            <option value="">- PILIH TUJUAN -</option>
                            <option value="SNG">SNG - SINABANG</option>
                            <option value="CLG">CLG - CALANG</option>
                        </select>
                    </div>
                    <div>
                        <label for="departure_date">Tanggal Berangkat</label>
                        <input type="date" id="departure_date" name="departure_date" placeholder="hh/bb/tttt">
                    </div>
                    <div>
                        <label>&nbsp;</label> <!-- Label kosong untuk menjaga alignment -->
                        <button type="submit" class="search-button">
                            <span>Cari Pelayaran</span> <span style="font-size: 1.2em;">→</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="section-title">
            <span>&#x2637;</span> RUTE DAN JADWAL TERSEDIA
        </h3>

        <!-- 
            Bagian OUTPUT Tabel Hasil Pencarian
            
            Konten dalam <tbody> ini akan diisi secara dinamis oleh hasil pencarian 
            dari backend Anda (PHP atau Node.js).
            Data di bawah ini hanyalah contoh statis untuk menunjukkan struktur.
        -->
        <table class="results-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PELABUHAN ASAL</th>
                    <th>PELABUHAN TUJUAN</th>
                    <th colspan="3">PERKIRAAN BERANGKAT</th>
                    <th colspan="3">PERKIRAAN TIBA</th>
                    <th>KETERANGAN</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>HARI</th>
                    <th>TANGGAL</th>
                    <th>JAM</th>
                    <th>HARI</th>
                    <th>TANGGAL</th>
                    <th>JAM</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh baris data. Ini akan diganti dengan data aktual dari database. -->
                <tr>
                    <td>1</td>
                    <td>CLG - CALANG<br>KAB. ACEH JAYA, ACEH</td>
                    <td>SNG - SINABANG<br>KAB. SIMEULUE, ACEH</td>
                    <td>Selasa</td>
                    <td>27 Mei 2025</td>
                    <td>15:00</td>
                    <td>Rabu</td>
                    <td>28 Mei 2025</td>
                    <td>08:00</td>
                    <td><span class="status-button expired">Sudah Tidak Berlaku</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SNG - SINABANG<br>KAB. SIMEULUE, ACEH</td>
                    <td>CLG - CALANG<br>KAB. ACEH JAYA, ACEH</td>
                    <td>Kamis</td>
                    <td>26 Juni 2025</td>
                    <td>10:00</td>
                    <td>Jumat</td>
                    <td>27 Juni 2025</td>
                    <td>03:00</td>
                    <td><span class="status-button active" style="background-color: #007bff;">Aktif</span></td>
                </tr>
                <!-- Lebih banyak baris data akan ditambahkan di sini oleh skrip backend -->
            </tbody>
        </table>
    </div>
</body>
</html>
