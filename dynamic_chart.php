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