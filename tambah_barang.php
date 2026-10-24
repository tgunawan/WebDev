<?php
require "koneksi.php";

if (isset($_POST["simpan"])) {
    $nama_barang = $_POST["nama_barang"];
    $harga       = $_POST["harga"];
    $stok        = $_POST["stok"];

    // Validasi input
    if ($nama_barang == "" || $harga == "" || $stok == "") {
        $pesan = "Semua field wajib diisi!";
    } else {
        $query = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', $harga, $stok)";
        mysqli_query($conn, $query);

        header("Location: barang.php"); //mengarahkan ke halaman tertentu
        exit; 

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>
<body>

<h1>Tambah Barang</h1>

<?php if (isset($pesan)) { echo "<p style='color:red;'>$pesan</p>"; } ?>

<form method="POST">
    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang"><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga"><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok"><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="barang.php">Batal</a>
</form>

</body>
</html>