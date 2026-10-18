<?php
require "koneksi.php";

$id = $_GET["id"];

// Ambil data barang berdasarkan ID
$querySelect = "SELECT * FROM barang WHERE id_barang = $id";
$resultSelect = mysqli_query($conn, $querySelect);
$data = mysqli_fetch_assoc($resultSelect);

if (isset($_POST["update"])) {
    $nama_barang = $_POST["nama_barang"];
    $harga       = $_POST["harga"];
    $stok        = $_POST["stok"];

    $queryUpdate = "UPDATE barang SET 
                        nama_barang = '$nama_barang',
                        harga = $harga,
                        stok = $stok 
                    WHERE id_barang = $id";

    mysqli_query($conn, $queryUpdate);

    header("Location: barang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>

<h1>Edit Barang</h1>

<form method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>"><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="<?= $data['harga']; ?>"><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" value="<?= $data['stok']; ?>"><br><br>

    <button type="submit" name="update">Update</button>
    <a href="barang.php">Batal</a>
</form>

</body>
</html>