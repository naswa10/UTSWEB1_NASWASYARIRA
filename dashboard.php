<?php
session_start();

// Cegah akses langsung tanpa login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$kode_barang = ["B001", "B002", "B003", "B004", "B005"];
$nama_barang = ["Mie Lidi Pedas", "Keripik Balado", "Es Kopi Susu", "Jus Mangga", "Roti Coklat"];
$harga_barang = [7000, 8000, 12000, 10000, 6000];

$index_terpilih = array_keys($kode_barang);
shuffle($index_terpilih); 

$barang_beli = [];
$jumlah = [];
$total = [];
$total_belanja = 0;

foreach ($index_terpilih as $idx) {
    $jumlah = rand(1, 5); 
    $total = $harga_barang[$idx] * $jumlah;

    $barang_beli[] = [
        'kode' => $kode_barang[$idx],
        'nama' => $nama_barang[$idx],
        'harga' => $harga_barang[$idx],
        'jumlah' => $jumlah,
        'total' => $total
    ];

    $total_belanja += $total;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan - POLGAN MART</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #6fa3ef, #87cefa, #d4e7fe);
            min-height: 100vh;
            padding: 0;
        }
        .container {
            background: white;
            max-width: 900px;
            margin: 60px auto;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 30px 40px;
        }

        /* ====== HEADER FLEX ====== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        .judul {
            text-align: left;
            color: #0066ff;
        }
        .judul h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }
        .judul p {
            margin: 2px 0 0 0;
            font-size: 14px;
            color: #555;
        }
        .user-info {
            text-align: right;
        }
        .user-info p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }
        a.logout {
            display: inline-block;
            margin-top: 6px;
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
            color: white;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        a.logout:hover {
            transform: scale(1.05);
        }

        /* ====== TABEL PRODUK ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f0f4ff;
            color: #333;
        }

        h3 {
            text-align: center;
            color: #0066ff;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Header kiri-kanan -->
        <div class="header">
            <div class="judul">
                <h2>-- POLGAN MART --</h2>
                <p>Sistem Penjualan Sederhana</p>
            </div>

            <div class="user-info">
                <p>Selamat datang, <b><?= htmlspecialchars($_SESSION['username']); ?></b></p>
                <a href="logout.php" class="logout">Logout</a>
            </div>
        </div>

        <hr>

        <!-- Tabel produk -->
        <h3>Daftar Pembelian</h3>
        <table>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            <?php foreach ($barang_beli as $b): ?>
                <tr>
                    <td><?= $b['kode']; ?></td>
                    <td><?= $b['nama']; ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                    <td><?= $b['jumlah']; ?></td>
                    <td>Rp <?= number_format($b['total'], 0, ',', '.'); ?></td>
                 </tr>
            <?php endforeach; ?>
            <tfoot>
                <tr> 
                    <td colspan="4" align="right">Total Belanja</td>
                <td>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
