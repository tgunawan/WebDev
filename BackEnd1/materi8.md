
# Meet 8: Deployment & Setting Server (InfinityFree Hosting)

## 1. Rangkuman Konsep Utama

- **Localhost vs Hosting**:
  - **Localhost**: Berjalan di komputer/laptop lokal menggunakan stack web server seperti Laragon atau XAMPP. Hanya bisa diakses dari jaringan lokal (`http://localhost/...`).
  - **Hosting / Server**: Berjalan di server internet publik (contoh: InfinityFree). Memungkinkan website dan database PHP + MySQL dapat diakses dari mana saja melalui domain/subdomain (`https://namaproject.rf.gd`).
- **Struktur Folder Server (`htdocs`)**:
  - Folder `htdocs` adalah root directory untuk menyimpan seluruh file website di server InfinityFree.
  - File utama (seperti `index.php`) harus ditempatkan langsung di bawah folder `htdocs` agar website dapat diakses secara langsung melalui `https://domainanda.com/`.
- **Migrasi Database (Export & Import SQL)**:
  - Mengubah database MySQL lokal menjadi file script `.sql` via **phpMyAdmin Export**, lalu meng-import script tersebut ke **phpMyAdmin Server** yang disediakan hosting.
- **Penyesuaian Konfigurasi Koneksi (`koneksi.php`)**:
  - Konfigurasi $host, $username, $password, dan $database pada server hosting **berbeda** dengan localhost (misal: host server tidak lagi `localhost`, melainkan host MySQL server yang diberikan oleh provider hosting seperti `sqlXXX.infinityfree.com`).

---

## 2. Alur Deployment Website (Step-by-Step)



PROJECT LOCAL (Laragon)
↓

1.  Testing di Localhost (Pastikan CRUD, JOIN & Chart Berjalan)
    ↓
2.  Export Database (.sql) dari phpMyAdmin Local
    ↓
3.  Buat Hosting Account & Database di Control Panel InfinityFree
    ↓
4.  Import File .sql ke phpMyAdmin Server
    ↓
5.  Upload File Project ke Folder /htdocs (via File Manager / FileZilla)
    ↓
6.  Update File koneksi.php dengan Kredensial Database Server
    ↓
7.  Pengujian Website & Dynamic Features di Domain Server



---

## 3. Contoh Code & Konfigurasi

### A. Contoh File `koneksi.php` (Versi Multi-Environment / Local vs Server)

Untuk memudahkan pengujian tanpa perlu mengubah kode secara manual setiap kali mengunggah file, kita dapat menggunakan pengecekan environment otomatis berdasarkan IP / Host Name:

```php
<?php
// Deteksi Environment (Apakah berjalan di Localhost atau Server)
$is_localhost = ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1');

if ($is_localhost) {
    // ----------------------------------------------------
    // KREDENSIAL DATABASE LOCALHOST (Laragon / XAMPP)
    // ----------------------------------------------------
    $host     = "localhost";
    $username = "root";
    $password = "";
    $database = "db_kasir";
} else {
    // ----------------------------------------------------
    // KREDENSIAL DATABASE SERVER (InfinityFree Hosting)
    // *Ganti dengan data dari cPanel InfinityFree Anda
    // ----------------------------------------------------
    $host     = "sql300.infinityfree.com"; // Contoh Host Database Server
    $username = "if0_38123456";          // Contoh DB Username Server
    $password = "PasswordHostingAnda";   // Contoh DB Password Server
    $database = "if0_38123456_db_kasir"; // Contoh Nama DB Server
}

// Menjalankan Koneksi Database
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>

````

-----

### B. Contoh Script Export SQL (`db_kasir.sql`)

``` sql
-- Struktur Tabel Kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal Kategori
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Alat Tulis');

-- Struktur Tabel Barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` VARCHAR(100) NOT NULL,
  `harga` INT(11) NOT NULL,
  `stok` INT(11) NOT NULL,
  `id_kategori` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `fk_kategori` (`id_kategori`),
  CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal Barang
INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `id_kategori`) VALUES
(1, 'Indomie Goreng', 3500, 50, 1),
(2, 'Teh Botol Sosro', 5000, 30, 2),
(3, 'Pensil 2B', 3000, 40, 3);

```

-----

## 4\. Penjelasan Komponen & Troubleshooting Error Server

### 1\. Metode Upload File

  - **File Manager**: Praktis dan cepat digunakan untuk upload file tunggal atau file terkompresi. Cocok untuk pengujian awal.
  - **FTP Client (FileZilla)**: Direkomendasikan untuk project dengan banyak file dan struktur subfolder yang kompleks (`assets/css`, `assets/js`, `assets/images`).

  - **Windows Eksplorer**: Minimalis Windows OS tanpa install apapun. 
    - ftp://username@ftp.namadomain.com contoh ftp://if0_43262871@ftpupload.net
    - masukkan password ftp, masukkan file di folder htdocs
    - atau "add Network Location" di this pc
    

### 2\. Panduan Troubleshooting Error Umum saat Deployment

| Jenis Error                                                           | Kemungkinan Penyebab                                                                                                          | Solusi                                                                                                                            |
| :-------------------------------------------------------------------- | :---------------------------------------------------------------------------------------------------------------------------- | :-------------------------------------------------------------------------------------------------------------------------------- |
| **Website Tidak Muncul / 404 Not Found**                              | File tidak berada di folder `htdocs` atau nama file utama bukan `index.php`.                                                  | Pastikan file project diunggah langsung ke dalam folder `/htdocs` dan file utama bernama `index.php`.                             |
| **Database Connection Error (`Access denied` / `Connection failed`)** | Kredensial MySQL server (Host, Username, Password, DB Name) pada `koneksi.php` salah atau masih menggunakan data `localhost`. | Periksa kembali detail MySQL Databases pada Control Panel InfinityFree dan perbarui variabel di `koneksi.php`.                    |
| **Table '...' doesn't exist**                                         | Database server belum di-import atau nama tabel menggunakan huruf besar/kecil yang tidak sesuai.                              | Buka phpMyAdmin server, pastikan file `.sql` sudah di-import. Perhatikan bahwa server Linux *case-sensitive* terhadap nama tabel. |
| **CSS, JS, atau Gambar Tidak Muncul**                                 | Path relatif file assets salah, atau huruf besar/kecil pada penamaan file/folder tidak cocok.                                 | Periksa tag `<link>` dan `<script>`. Pastikan penulisan nama folder (`assets/css/style.css`) konsisten dengan yang ada di server. |

-----

## 5\. Ringkasan Pengujian Pasca-Deployment

Setelah proses upload selesai, lakukan verifikasi fitur secara penuh di domain server:

1.  **Halaman Utama**: Memastikan `index.php` terbuka tanpa error koneksi.
2.  **Pengujian CRUD**: Mencoba menambah, mengubah, dan menghapus data barang/kategori.
3.  **Pengujian Relasi & JOIN**: Memastikan data kategori dan barang terhubung dengan benar di tabel laporan.
4.  **Pengujian Dynamic Chart**: Menambah data barang baru dan memastikan grafik (CanvasJS) berubah secara dinamis berdasarkan data terbaru dari database server.

