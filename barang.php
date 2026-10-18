<!-- baca dan sort data -->
<?php
require "koneksi.php";

// Default sorting
$orderBy = "nama_barang ASC";

if (isset($_GET["sort"])) {
    if ($_GET["sort"] == "harga_asc") {
        $orderBy = "harga ASC";
    } elseif ($_GET["sort"] == "harga_desc") {
        $orderBy = "harga DESC";
    } elseif ($_GET["sort"] == "stok_desc") {
        $orderBy = "stok DESC";
    } elseif ($_GET["sort"] == "nama_asc") {
        $orderBy = "nama_barang ASC";
    }
}

$query = "SELECT * FROM barang ORDER BY $orderBy";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>

<h1>Data Barang</h1>

<a href="tambah_barang.php">Tambah Barang Baru</a>
<br><br>

<form method="GET">
    <label>Urutkan Berdasarkan: </label>
    <select name="sort" onchange="this.form.submit()">
        <option value="nama_asc" <?php if(isset($_GET['sort']) && $_GET['sort']=='nama_asc') echo 'selected'; ?>>Nama (A - Z)</option>
        <option value="harga_asc" <?php if(isset($_GET['sort']) && $_GET['sort']=='harga_asc') echo 'selected'; ?>>Harga Termurah</option>
        <option value="harga_desc" <?php if(isset($_GET['sort']) && $_GET['sort']=='harga_desc') echo 'selected'; ?>>Harga Termahal</option>
        <option value="stok_desc" <?php if(isset($_GET['sort']) && $_GET['sort']=='stok_desc') echo 'selected'; ?>>Stok Terbanyak</option>
    </select>
</form>

<br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $data["id_barang"]; ?></td>
        <td><?= $data["nama_barang"]; ?></td>
        <td>Rp <?= number_format($data["harga"], 0, ',', '.'); ?></td>
        <td><?= $data["stok"]; ?></td>
        <td>
            <a href="edit_barang.php?id=<?= $data["id_barang"]; ?>">Edit</a> | 
            <a href="hapus_barang.php?id=<?= $data["id_barang"]; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>