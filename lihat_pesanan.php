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

// Query untuk mengambil data dari tabel pembelian
$sql = "SELECT id, nama, alamat, produk, jumlah, metode_pembayaran, catatan, tanggal_pembelian FROM pembelian";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            padding: 20px;
        }
        .back-button {
            margin-bottom: 15px;
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .action-button {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            margin-right: 5px;
        }
        .edit-button {
            background-color: #28a745;
        }
        .edit-button:hover {
            background-color: #218838;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.html" class="back-button">Kembali ke Halaman Utama</a>
        <h1>Daftar Pesanan</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Metode Pembayaran</th>
                    <th>Catatan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . htmlspecialchars($row['nama']) . "</td>
                                <td>" . htmlspecialchars($row['alamat']) . "</td>
                                <td>" . htmlspecialchars($row['produk']) . "</td>
                                <td>" . $row['jumlah'] . "</td>
                                <td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>
                                <td>" . htmlspecialchars($row['catatan']) . "</td>
                                <td>" . $row['tanggal_pembelian'] . "</td>
                                <td>
                                    <a href='edit.php?id=" . $row['id'] . "' class='action-button edit-button'>Edit</a>
                                    <a href='proses_delete.php?id=" . $row['id'] . "' class='action-button delete-button' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesanan ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align: center;'>Tidak ada data pesanan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Tutup koneksi
    $conn->close();
    ?>
</body>
</html>
