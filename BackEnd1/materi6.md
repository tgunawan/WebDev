#  Relasi Tabel, JOIN, ORDER BY, dan Aggregate dalam PHP & MySQL
## akan buat laporan_barang.php dimana gabungan tabel dan sort
## 1. Rangkuman Konsep Utama

- **Relasi Antar Tabel & Foreign Key**: Menghubungkan data antar tabel dalam database menggunakan kolom referensi. Kolom `id_kategori` pada tabel `barang` bertindak sebagai Foreign Key yang merujuk ke Primary Key `id_kategori` pada tabel `kategori`.
- **Jenis-Jenis JOIN**:
  - **INNER JOIN**: Mengambil data yang memiliki Pasangan/kecocokan pada kedua tabel.
  - **LEFT JOIN**: Mengambil seluruh data dari tabel sebelah kiri dan data yang cocok dari tabel sebelah kanan (menghasilkan `NULL` jika tidak ada pasangan).
  - **RIGHT JOIN**: Mengambil seluruh data dari tabel sebelah kanan dan data yang cocok dari tabel sebelah kiri.
  - **CROSS JOIN**: Menghasilkan kombinasi silang (Cartesian product) antara setiap baris di tabel pertama dengan tabel kedua.
- **ORDER BY dengan JOIN**: Mengurutkan hasil penggabungan tabel berdasarkan kolom tertentu (misalnya mengurutkan berdasarkan nama kategori, harga barang termahal/termurah, atau stok) secara ascending (`ASC`) maupun descending (`DESC`).
- **Kombinasi GROUP BY & Aggregate Functions**: Mengelompokkan data berdasarkan kolom tertentu (seperti `id_kategori`) dan menghitung statistik (`COUNT()`, `SUM()`, `AVG()`, `MAX()`, `MIN()`) sebelum diurutkan.

---

## 2. Struktur Database (Studi Kasus Kasir)

### jika sudah ada tabel 
```sql
ALTER TABLE barang
ADD CONSTRAINT fk_barang_kategori
FOREIGN KEY (id_kategori)
REFERENCES kategori(id_kategori);
```
tapi pastikan sudah ada kolom id_kategori pada tabel barang
```sql
ALTER TABLE barang
ADD id_kategori INT;
```

### Schema SQL jika belum ada
```sql
-- Tabel Kategori (Parent Table)
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

-- Tabel Barang (Child Table)
CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- Insert Sample Data
INSERT INTO kategori (nama_kategori) VALUES 
('Makanan'), 
('Minuman'), 
('Alat Tulis'), 
('Elektronik');

INSERT INTO barang (nama_barang, harga, stok, id_kategori) VALUES 
('Indomie', 3500, 20, 1),
('Teh Botol', 5000, 15, 2),
('Pensil', 3000, 30, 3),
('Roti', 7000, 10, 1);

````

-----

## 3\. Contoh Query SQL Utama

### A. INNER JOIN dengan ORDER BY

Mengambil data barang beserta nama kategorinya dan diurutkan berdasarkan harga termahal (`DESC`):

``` sql
SELECT 
    b.id_barang,
    b.nama_barang,
    b.harga,
    b.stok,
    k.nama_kategori
FROM barang AS b
INNER JOIN kategori AS k ON b.id_kategori = k.id_kategori
ORDER BY b.harga DESC;

```

### B. LEFT JOIN dengan GROUP BY & ORDER BY

Menampilkan semua kategori (termasuk yang belum memiliki barang), menghitung jumlah barang per kategori, dan mengurutkannya dari jumlah barang terbanyak (`DESC`):

``` sql
SELECT 
    k.nama_kategori,
    COUNT(b.id_barang) AS jumlah_barang,
    IFNULL(SUM(b.stok), 0) AS total_stok
FROM kategori AS k
LEFT JOIN barang AS b ON k.id_kategori = b.id_kategori
GROUP BY k.id_kategori, k.nama_kategori
ORDER BY jumlah_barang DESC, k.nama_kategori ASC;

```

-----

## 4\. Implementation Code PHP (`laporan_barang.php`)

``` php
<?php
// 1. Koneksi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kasir";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

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

```

-----

## 5\. Penjelasan Komponen Kode

1.  **Aturan On Clause (`ON b.id_kategori = k.id_kategori`)**:
      - Menghubungkan baris data dari tabel `barang` dengan `kategori` ketika nilai `id_kategori` pada kedua tabel sama.
2.  **Penggunaan Alias (`AS b`, `AS k`)**:
      - Menghindari ambiguitas penulisan kolom jika kedua tabel memiliki nama kolom yang identik (misalnya `id_kategori`).
3.  **Pengurutan Dinamis (`ORDER BY $orderBy`)**:
      - Mengambil nilai pilihan dropdown dari URL (`$_GET['sort']`) dan menginjeksikan kriteria pengurutan ke dalam klausa SQL `ORDER BY`.
4.  **Pencegahan Ambiguitas Kolom**:
      - Penulisan `nama_tabel.nama_kolom` (seperti `b.harga` atau `k.nama_kategori`) memastikan MySQL mengambil data dari tabel yang tepat.


