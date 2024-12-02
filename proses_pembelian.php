<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "drshopdb";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : null;

// Query untuk menyimpan data
$sql = "INSERT INTO pembelian (nama, alamat, produk, jumlah, metode_pembayaran, catatan)
        VALUES ('$nama', '$alamat', '$produk', $jumlah, '$metode_pembayaran', '$catatan')";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    echo "Pesanan berhasil disimpan!";
    echo "<br><a href='index.html'>Kembali ke halaman utama</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
