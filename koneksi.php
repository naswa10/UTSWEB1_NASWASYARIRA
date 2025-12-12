<?php
$host = "localhost";  // Alamat server database (biasanya localhost)
$username = "root";   // Username untuk login ke database
$password = "";       // Password unutk login (biassnya kosong untuk localhost)
$dbname = "db_penjualann";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>