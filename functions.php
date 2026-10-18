<?php
// 1. Function Koneksi Database
function getKoneksi() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "kasir";
    
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