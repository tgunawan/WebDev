# Meet 7: PHP Function, Dynamic Chart (CanvasJS), dan Data Filtering

## 1\. Rangkuman Konsep Utama

  - **PHP Function**: Blok kode reusable yang dibuat untuk menjalankan tugas spesifik dan dapat dipanggil kapan saja. Mengisolasi logika bisnis dan query database (seperti laporan/rekap data) agar kode lebih rapi, modular, dan mudah dikelola.
  - **Dynamic Chart**: Grafik visual yang datanya diambil secara *real-time* dari database MySQL melalui PHP, diubah menjadi format JSON (`json_encode()`), lalu dibaca oleh library JavaScript seperti **CanvasJS**.
  - **Alur Data Dynamic Chart**:
    $$\\text{Database (MySQL)} \\xrightarrow{\\text{PHP Query / Function}} \\text{PHP Array} \\xrightarrow{\\text{json\_encode()}} \\text{JSON} \\xrightarrow{\\text{JavaScript}} \\text{CanvasJS Chart}$$
  - **Filtering & ORDER BY**: Fitur penyaringan data (misal berdasarkan Kategori) yang dikombinasikan dengan klausa `ORDER BY` pada query SQL untuk menyusun visualisasi grafik secara urut dan dinamis.

-----

## 2\. Struktur Database & Helper Functions (`functions.php`)

### Database Schema

``` sql
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

```

### Function File (`functions.php`)

``` php
<?php
// 1. Function Koneksi Database
function getKoneksi() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "db_kasir";
    
    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    return $conn;
}

// 2. Function Mengambil List Kategori untuk Dropdown Filter
function getKategori($conn) {
    $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
    return mysqli_query($conn, $query);
}

// 3. Function Rekap Data Chart dengan Filtering & ORDER BY
function getChartDataDataPoints($conn, $filter_kategori = '', $sort_by = 'jumlah_desc') {
    // Base Query: Menggabungkan tabel kategori dan barang
    $query = "SELECT 
                k.nama_kategori,
                COUNT(b.id_barang) AS jumlah_barang,
                IFNULL(SUM(b.stok), 0) AS total_stok
              FROM kategori AS k
              LEFT JOIN barang AS b ON k.id_kategori = b.id_kategori";

    // Filtering (Klausa WHERE)
    if (!empty($filter_kategori)) {
        $filter_kategori = mysqli_real_escape_string($conn, $filter_kategori);
        $query .= " WHERE k.id_kategori = '$filter_kategori'";
    }

    // Grouping berdasarkan Kategori
    $query .= " GROUP BY k.id_kategori, k.nama_kategori";

    // Dynamic ORDER BY
    switch ($sort_by) {
        case 'jumlah_asc':
            $query .= " ORDER BY jumlah_barang ASC";
            break;
        case 'stok_desc':
            $query .= " ORDER BY total_stok DESC";
            break;
        case 'nama_asc':
            $query .= " ORDER BY k.nama_kategori ASC";
            break;
        case 'jumlah_desc':
        default:
            $query .= " ORDER BY jumlah_barang DESC";
            break;
    }

    $result = mysqli_query($conn, $query);
    $dataPoints = [];

    // Formatting hasil query ke format dataPoints CanvasJS
    while ($row = mysqli_fetch_assoc($result)) {
        $dataPoints[] = [
            "label" => $row["nama_kategori"],
            "y"     => (int) $row["jumlah_barang"] // Type-casting (int) untuk CanvasJS
        ];
    }

    return $dataPoints;
}
?>

```

-----

## 3\. Implementation Code (`dynamic_chart.php`)

``` php
<?php
require_once "functions.php";

$conn = getKoneksi();

// Menangkap parameter filter & sorting dari URL ($_GET)
$filter_kategori = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '';
$sort_by         = isset($_GET['sort']) ? $_GET['sort'] : 'jumlah_desc';

// Mengambil data melalui PHP Function
$dataPoints   = getChartDataDataPoints($conn, $filter_kategori, $sort_by);
$listKategori = getKategori($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Chart - CanvasJS with Filtering & ORDER BY</title>
    <!-- Library CanvasJS -->
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .filter-container {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group { display: inline-block; margin-right: 15px; }
        label { font-weight: bold; margin-right: 5px; }
        select, button { padding: 6px 12px; border-radius: 4px; border: 1px solid #ccc; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        #chartContainer { height: 380px; width: 100%; }
    </style>
</head>
<body>

    <h2>Dashboard Dynamic Chart (CanvasJS)</h2>

    <!-- Form Filtering & Sorting -->
    <div class="filter-container">
        <form method="GET" action="">
            <div class="form-group">
                <label for="id_kategori">Filter Kategori:</label>
                <select name="id_kategori" id="id_kategori">
                    <option value="">-- Semua Kategori --</option>
                    <?php while ($kat = mysqli_fetch_assoc($listKategori)): ?>
                        <option value="<?= $kat['id_kategori']; ?>" <?= $filter_kategori == $kat['id_kategori'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($kat['nama_kategori']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sort">Urutkan Grafik (ORDER BY):</label>
                <select name="sort" id="sort">
                    <option value="jumlah_desc" <?= $sort_by == 'jumlah_desc' ? 'selected' : ''; ?>>Jumlah Barang Terbanyak</option>
                    <option value="jumlah_asc" <?= $sort_by == 'jumlah_asc' ? 'selected' : ''; ?>>Jumlah Barang Tersedikit</option>
                    <option value="stok_desc" <?= $sort_by == 'stok_desc' ? 'selected' : ''; ?>>Total Stok Terbanyak</option>
                    <option value="nama_asc" <?= $sort_by == 'nama_asc' ? 'selected' : ''; ?>>Nama Kategori (A-Z)</option>
                </select>
            </div>

            <button type="submit">Terapkan Filter</button>
            <a href="dynamic_chart.php" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Reset</a>
        </form>
    </div>

    <!-- Elemen Container Grafik -->
    <div id="chartContainer"></div>

    <script>
        window.onload = function () {
            // Mengubah array PHP menjadi data JSON untuk JavaScript
            var chartDataPoints = <?= json_encode($dataPoints); ?>;

            // Inisialisasi CanvasJS Chart
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Statistik Jumlah Barang per Kategori"
                },
                axisY: {
                    title: "Jumlah Barang",
                    includeZero: true
                },
                axisX: {
                    title: "Kategori"
                },
                data: [{
                    type: "column", // Tipe Chart: column, bar, line, pie, doughnut
                    indexLabel: "{y}",
                    dataPoints: chartDataPoints
                }]
            });

            // Render grafik ke div#chartContainer
            chart.render();
        }
    </script>

</body>
</html>

```

-----

## 4\. Penjelasan Komponen & Alur Kerja

1.  **Encapsulation Menggunakan PHP Function (`functions.php`)**:
    
      - Fungsi `getChartDataDataPoints()` mengisolasi query SQL dan transformasi data agar terpisah dari tampilan HTML.
      - Parameter `$filter_kategori` dan `$sort_by` dipasangkan ke dalam query untuk fleksibilitas laporan.

2.  **Kombinasi SQL: JOIN + GROUP BY + WHERE + ORDER BY**:
    
      - `LEFT JOIN` menjaga agar kategori yang tidak/belum memiliki barang tetap tampil pada laporan.
      - `WHERE` menyaring kategori tertentu sesuai pilihan input user.
      - `ORDER BY` mengatur urutan baris grafik (misal dari terbanyak ke tersedikit) sebelum diproses PHP.

3.  **Penggunaan Type Casting `(int)` pada `y`**:
    
      - Hasil query `mysqli_fetch_assoc()` menghasilkan nilai dalam format String (contoh: `"5"`).
      - Penulisan `(int) $row["jumlah_barang"]` mengonversi nilai tersebut menjadi tipe Integer (`5`) yang wajib dipenuhi oleh CanvasJS agar tinggi grafik terukur dengan tepat.

4.  **Konversi PHP ke JavaScript (`json_encode`)**:
    
      - Fungsi `json_encode($dataPoints)` mengubah array PHP menjadi array JSON yang valid:
        ``` json
        [
          {"label": "Makanan", "y": 5},
          {"label": "Minuman", "y": 8}
        ]
        
        ```
      - Variabel JSON ini dibaca oleh CanvasJS pada `dataPoints: chartDataPoints` untuk membangun grafik.
