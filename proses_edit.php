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

// Periksa apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';

    // Validasi ID
    if (empty($id)) {
        echo "<script>
                alert('ID tidak ditemukan!');
                window.history.back();
              </script>";
        exit;
    }

    // Query untuk memperbarui data
    $sql = "UPDATE pembelian SET 
                nama = ?, 
                alamat = ?, 
                produk = ?, 
                jumlah = ?, 
                metode_pembayaran = ?, 
                catatan = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissi", $nama, $alamat, $produk, $jumlah, $metode_pembayaran, $catatan, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href='lihat_pesanan.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Akses tidak diizinkan!');
            window.location.href='lihat_pesanan.php';
          </script>";
    exit;
}
?>
