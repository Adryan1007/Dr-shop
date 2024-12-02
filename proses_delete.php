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

// Periksa apakah ID dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM pembelian WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='daftar_pesanan.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . $conn->error . "');
                window.location.href='daftar_pesanan.php';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('ID tidak ditemukan.');
            window.location.href='daftar_pesanan.php';
          </script>";
}

$conn->close();
?>
