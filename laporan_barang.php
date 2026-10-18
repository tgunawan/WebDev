<?php
// 1. Koneksi Database
require "koneksi.php";

// 2. Menentukan Kriteria Sorting Dinamis via URL ($_GET)
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'harga_desc';

switch ($sort) {
    case 'harga_asc':
        $orderBy = "b.harga ASC";
        break;
    case 'nama_asc':
        $orderBy = "b.nama_barang ASC";
        break;
    case 'kategori_asc':
        $orderBy = "k.nama_kategori ASC";
        break;
    case 'harga_desc':
    default:
        $orderBy = "b.harga DESC";
        break;
}

// 3. Query INNER JOIN + Dynamic ORDER BY
$query = "SELECT 
            b.id_barang,
            b.nama_barang,
            b.harga,
            b.stok,
            k.nama_kategori
          FROM barang AS b
          INNER JOIN kategori AS k ON b.id_kategori = k.id_kategori
          ORDER BY $orderBy";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang (JOIN & ORDER BY)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .filter-box { margin-bottom: 15px; }
    </style>
</head>
<body>

    <h2>Laporan Data Barang & Kategori</h2>

    <!-- Form Sort Dropdown -->
    <div class="filter-box">
        <form method="GET" action="">
            <label for="sort">Urutkan Berdasarkan: </label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="harga_desc" <?= $sort == 'harga_desc' ? 'selected' : '' ?>>Harga Termahal</option>
                <option value="harga_asc" <?= $sort == 'harga_asc' ? 'selected' : '' ?>>Harga Termurah</option>
                <option value="nama_asc" <?= $sort == 'nama_asc' ? 'selected' : '' ?>>Nama Barang (A-Z)</option>
                <option value="kategori_asc" <?= $sort == 'kategori_asc' ? 'selected' : '' ?>>Nama Kategori (A-Z)</option>
            </select>
        </form>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Data tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>