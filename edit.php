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

// Periksa apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $sql = "SELECT * FROM pembelian WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        echo "<script>
                alert('Data dengan ID tersebut tidak ditemukan!');
                window.location.href='daftar_pesanan.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href='daftar_pesanan.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <style>
        .form-pembelian {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea, select, input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="proses_edit.php" method="post" class="form-pembelian">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Pengiriman:</label>
            <textarea id="alamat" name="alamat" class="form-control" placeholder="Masukkan alamat lengkap pengiriman" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="produk">Pilih Produk:</label>
            <select id="produk" name="produk" class="form-control" required>
                <option value="" disabled>Pilih produk</option>
                <option value="pensil" <?php echo ($data['produk'] == 'pensil') ? 'selected' : ''; ?>>Pensil</option>
                <option value="pulpen" <?php echo ($data['produk'] == 'pulpen') ? 'selected' : ''; ?>>Pulpen</option>
                <option value="buku" <?php echo ($data['produk'] == 'buku') ? 'selected' : ''; ?>>Buku</option>
                <option value="penggaris" <?php echo ($data['produk'] == 'penggaris') ? 'selected' : ''; ?>>Penggaris</option>
                <option value="penghapus" <?php echo ($data['produk'] == 'penghapus') ? 'selected' : ''; ?>>Penghapus</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Masukkan jumlah produk" value="<?php echo $data['jumlah']; ?>" min="1" required>
        </div>

        <div class="form-group">
            <label for="metode-pembayaran">Metode Pembayaran:</label>
            <select id="metode-pembayaran" name="metode_pembayaran" class="form-control" required>
                <option value="" disabled>Pilih metode pembayaran</option>
                <option value="transfer" <?php echo ($data['metode_pembayaran'] == 'transfer') ? 'selected' : ''; ?>>Transfer Bank</option>
                <option value="cod" <?php echo ($data['metode_pembayaran'] == 'cod') ? 'selected' : ''; ?>>Cash on Delivery (COD)</option>
                <option value="ewallet" <?php echo ($data['metode_pembayaran'] == 'ewallet') ? 'selected' : ''; ?>>E-Wallet</option>
            </select>
        </div>

        <div class="form-group">
            <label for="catatan">Catatan Tambahan (Opsional):</label>
            <textarea id="catatan" name="catatan" class="form-control" placeholder="Catatan untuk penjual"><?php echo htmlspecialchars($data['catatan']); ?></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn">Simpan Perubahan</button>
        </div>
    </form>
</body>
</html>
