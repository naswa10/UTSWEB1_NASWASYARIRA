<?php
session_start();

// Cegah akses langsung tanpa login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ARRAY MULTI DIMENSI
$barang = [
    ["kode" => "B001", "nama" => "Mie Lidi Pedas", "harga" => 7000],
    ["kode" => "B002", "nama" => "Keripik Balado", "harga" => 8000],
    ["kode" => "B003", "nama" => "Es Kopi Susu", "harga" => 12000],
    ["kode" => "B004", "nama" => "Jus Mangga", "harga" => 10000],
    ["kode" => "B005", "nama" => "Roti Coklat", "harga" => 6000]
];

// Acak index barang
$index_terpilih = array_keys($barang);
shuffle($index_terpilih);

$barang_beli = [];
$grandtotal = 0;
$tanggal = date('d F Y');

// Loop pembelian
foreach ($index_terpilih as $i) {

    $jumlah = rand(1, 5);
    $total  = $barang[$i]["harga"] * $jumlah;

    $grandtotal += $total;

    $barang_beli[] = [
        "kode"   => $barang[$i]["kode"],
        "nama"   => $barang[$i]["nama"],
        "harga"  => $barang[$i]["harga"],
        "jumlah" => $jumlah,
        "total"  => $total
    ];
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
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        .judul h2 {
            margin: 0;
            font-size: 22px;
            color: #0066ff;
        }
        .user-info p {
            margin: 0;
            font-size: 14px;
        }
        a.logout {
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
            padding: 6px 16px;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f0f4ff;
        }
    </style>
</head>

<body>
    <div class="container">

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

        <h3 style="text-align:center; color:#0066ff;">Daftar Pembelian</h3>
        <p style="text-align:center;">Tanggal Transaksi: <b><?= $tanggal; ?></b></p>

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
                <td><?= $b["kode"]; ?></td>
                <td><?= $b["nama"]; ?></td>
                <td>Rp <?= number_format($b["harga"], 0, ',', '.'); ?></td>
                <td><?= $b["jumlah"]; ?></td>
                <td>Rp <?= number_format($b["total"], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>

            <tfoot>
                <tr>
                    <td colspan="4" align="right"><b>Total Belanja</b></td>
                    <td><b>Rp <?= number_format($grandtotal, 0, ',', '.'); ?></b></td>
                </tr>
            </tfoot>
        </table>

    </div>
</body>
</html>
