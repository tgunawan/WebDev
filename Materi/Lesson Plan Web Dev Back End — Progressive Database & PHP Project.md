# Lesson Plan Lengkap: Web Development Back End

### Database Design • PHP • MySQL • Reporting Dashboard — Progressive Project

---

## Tentang Lesson Plan Ini

Lesson plan ini melanjutkan **Lesson Plan Front End** yang sudah dibuat sebelumnya, berdasarkan silabus **"Database Design → PHP → Publish"** yang terdiri dari dua part:

- **Part 1** — Database Design, Database, PHP (11 pertemuan)
- **Part 2** — Join Table, Summary Data, Publish (8 pertemuan)

Total **19 pertemuan**, ditutup dengan Final Exam di setiap part.

**Studi kasus proyek: "Sistem Manajemen Pesan Pengunjung & Dashboard Admin"**

Proyek ini **menyambung langsung** dari portfolio front end yang sudah dibuat sebelumnya. Ingat, di front end sudah ada **form kontak** di section `#kontak` — nah, di back end ini kita akan membuat supaya pesan yang dikirim lewat form itu **benar-benar tersimpan ke database**, lalu kita bangun **halaman admin** untuk melihat, mengurutkan, memfilter, mengubah status, dan menghapus pesan tersebut — lengkap dengan **dashboard grafik** ringkasan data.

Kenapa studi kasus ini dipilih? Karena setiap topik di silabus (Activity Diagram, Class Diagram, CRUD, Join, Group By, Dynamic Chart) bisa dipetakan langsung ke kebutuhan nyata: mengelola pesan masuk dari pengunjung portfolio.

**Konsep tambahan yang saya masukkan** (tidak ada di tabel asli, tapi wajib ada agar aplikasi aman & lengkap secara alur belajar):

- **`$_POST` / `$_GET` superglobals** — dasar PHP menerima data dari form HTML, prasyarat sebelum "Input Data to MySQL Database".
- **Prepared Statement (MySQLi)** — pengganti query string biasa untuk mencegah **SQL Injection**. Ini krusial secara keamanan dan wajib diajarkan bersamaan dengan INSERT/UPDATE/DELETE, bukan sekadar query string manual.
- **`htmlspecialchars()`** — mencegah **XSS** saat menampilkan kembali data yang berasal dari input pengguna.
- **Error handling dasar (`try/catch` & pengecekan koneksi)** — supaya aplikasi tidak "blank putih" saat database gagal terhubung.
- **Foreign Key & relasi antar tabel** — pelengkap alami dari Class Diagram, sekaligus prasyarat wajib sebelum materi Join.
- **Chart.js** sebagai library chart — pelengkap teknis dari "Create Dynamic Column Chart" (PHP menyiapkan data, Chart.js yang menggambar).

---

## Studi Kasus & Struktur Database

**Kebutuhan sistem** (akan divisualisasikan di pertemuan 1 & 2 dengan Activity Diagram & Class Diagram):

1. Pengunjung mengisi form kontak di website portfolio (front end) → data tersimpan otomatis ke database.
2. Admin login ke halaman `/admin` untuk melihat semua pesan masuk.
3. Admin bisa mengurutkan pesan (terbaru/terlama), memfilter berdasarkan kategori & status, mengubah status (`baru` → `dibaca`), dan menghapus pesan.
4. Admin melihat dashboard ringkasan: total pesan per kategori, ditampilkan sebagai grafik batang (column chart) yang bisa difilter.

**Struktur Tabel (akan dibuat detail di Pertemuan 3):**

```
tabel: kategori
+----+------------------+
| id | nama_kategori    |
+----+------------------+
| 1  | Landing Page     |
| 2  | E-Commerce       |
| 3  | Dashboard        |
+----+------------------+

tabel: pesan
+----+----------+------------------+---------------+--------+-------------+---------------------+
| id | nama     | email            | kategori_id   | pesan  | status      | tanggal_kirim       |
+----+----------+------------------+---------------+--------+-------------+---------------------+
| 1  | Budi     | budi@mail.com    | 1 (FK)        | ...    | baru        | 2026-09-20 10:15:00 |
+----+----------+------------------+---------------+--------+-------------+---------------------+
```

`kategori_id` pada tabel `pesan` adalah **Foreign Key** yang merujuk ke `id` pada tabel `kategori` — inilah relasi yang nanti dipakai untuk materi **Join**.

---

## Gambaran Proyek Progresif

| Fase | Pertemuan | Yang ditambahkan ke proyek |
| --- | --- | --- |
| Desain | 1 | Activity Diagram alur sistem pesan pengunjung |
| Desain | 2 | Class Diagram: struktur tabel `pesan` & `kategori` |
| Database | 3 | Install Laragon + phpMyAdmin, buat database & tabel |
| PHP Dasar | 4 | Struktur file PHP, variabel, operator |
| PHP Dasar | 5 | Branching: validasi status pesan (if/switch) |
| PHP Dasar | 6 | Koneksi PHP ↔ MySQL, form kontak **benar-benar menyimpan data** (INSERT) |
| PHP Dasar | 7 | Loop dasar (while, for, nested) sebagai fondasi menampilkan banyak data |
| PHP Dasar | 8 | Array + SELECT * FROM → halaman admin menampilkan **semua pesan** dari database |
| PHP Dasar | 9 | ORDER BY → pesan bisa diurutkan terbaru/terlama |
| PHP Dasar | 10 | DELETE & UPDATE → admin bisa hapus pesan & ubah status baru/dibaca |
| PHP Dasar | 11 | **Final Exam Part 1**: CRUD admin pesan lengkap |
| Review | 12 | Review front end + back end secara menyeluruh |
| Lanjutan | 13 | JOIN → tabel pesan digabung dengan kategori (tampilkan nama kategori, bukan cuma id) |
| Lanjutan | 14 | GROUP BY → hitung jumlah pesan per kategori |
| Lanjutan | 15 | Dynamic Column Chart → dashboard grafik jumlah pesan per kategori |
| Lanjutan | 16 | Filtering Data → dashboard bisa difilter berdasarkan kategori/status |
| Publish | 17 | Setup server/hosting untuk PHP + MySQL |
| Publish | 18 | System Testing sebelum go-live |
| Publish | 19 | **Final Exam Part 2**: sistem lengkap online, front end + back end terhubung |

---

# PART 1 — DATABASE DESIGN & PHP

## Pertemuan 1 — Activity Diagram

### Tujuan Belajar

1. Mampu memvisualisasikan setiap kegiatan yang terjadi pada sistem.
2. Mampu menentukan hasil akhir dari setiap kegiatan sistem.

### Materi

**Component of Basic Model**

Activity Diagram adalah diagram UML yang menggambarkan **alur kerja/proses** dalam sistem — mirip flowchart, tapi dengan notasi standar:

| Simbol | Arti |
| --- | --- |
| ● (bulat hitam) | Start / titik mulai |
| ⬤ dalam lingkaran (bullseye) | End / titik akhir |
| ▭ (persegi ujung bulat) | Activity / aktivitas |
| ◇ (belah ketupat) | Decision / percabangan kondisi |
| ▬ (garis tebal horizontal) | Fork/Join — proses paralel |
| → | Alur/arah proses |

**Advanced Model Components**

- **Swimlane** — membagi diagram menjadi beberapa "jalur" berdasarkan aktor (misal: jalur "Pengunjung" dan jalur "Sistem").
- **Guard condition** — label pada tanda panah setelah decision, contoh `[valid]` atau `[tidak valid]`.

**Rules to Create Activity Diagram**

1. Selalu mulai dari 1 titik start dan boleh berakhir di lebih dari 1 titik end.
2. Setiap decision (◇) wajib punya minimal 2 output dengan guard condition yang jelas.
3. Gunakan swimlane jika melibatkan lebih dari 1 aktor (pengunjung vs sistem/admin).
4. Urutan proses harus logis — tidak boleh ada aktivitas yang "menggantung" tanpa alur masuk/keluar.

### 🎯 Studi Kasus: Activity Diagram "Pengunjung Mengirim Pesan"

```
flowchart TD
    Start((Start)) --> A[Pengunjung membuka website portfolio]
    A --> B[Pengunjung mengisi form kontak]
    B --> C{Semua field terisi & email valid?}
    C -- Tidak --> D[Tampilkan pesan error]
    D --> B
    C -- Ya --> E[Sistem simpan data ke database]
    E --> F[Tampilkan notifikasi 'Pesan terkirim']
    F --> End((End))
```

### Challenge 1 — New Case Study

Peserta membuat Activity Diagram untuk alur **Admin mengelola pesan** (login admin → lihat daftar pesan → pilih pesan → ubah status/hapus → sistem update database → tampilan diperbarui).

### Challenge 2 — Create UI Design

Peserta membuat **wireframe/sketsa tampilan** (boleh pakai Figma, Excalidraw, atau kertas) untuk halaman admin yang nanti akan diisi data sungguhan dari database: tabel daftar pesan, tombol filter, tombol urutkan, tombol hapus/ubah status.

**Target:** peserta bisa memvisualisasikan alur sistem sebelum menulis kode apa pun — kebiasaan penting sebelum membangun sistem sungguhan.

---

## Pertemuan 2 — Class Diagram

### Tujuan Belajar

1. Memvisualisasikan atribut dan akses yang dimiliki setiap bagian/aktor pada sistem.
2. Memahami pentingnya hubungan dalam alur sistem (relasi antar tabel).

### Materi

**Component of Basic Model**

Class Diagram menggambarkan **struktur data** (bukan alur proses seperti Activity Diagram). Setiap "class" nantinya akan menjadi 1 tabel di database.

```
+------------------+
|      Pesan       |   <- Nama Class/Tabel
+------------------+
| - id: int         |   <- Atribut (attribute)
| - nama: string     |
| - email: string     |
| - kategori_id: int   |
| - pesan: text          |
| - status: string        |
| - tanggal_kirim: datetime|
+------------------+
| + simpan()        |   <- Method/perilaku (operation)
| + hapus()          |
+------------------+
```

**Advanced Model Components — Relasi antar Class**

- **Association (garis biasa `——`)** — dua class saling terhubung.
- **One-to-Many (`1` — `*`)** — 1 kategori bisa dipakai banyak pesan.

**Rules to Create Class**

1. Nama class ditulis singular & PascalCase secara konsep (`Pesan`, bukan `pesan-pesan` atau `Pesans`) — walau nama tabel di database biasanya ditulis lowercase.
2. Atribut wajib punya tipe data.
3. Tanda `-` (private) untuk atribut yang hanya diakses lewat method, `+` (public) untuk yang bisa diakses bebas.

**Unique Value (Primary Key)**

Setiap tabel **wajib punya Primary Key** — kolom unik yang tidak boleh sama antar baris, biasanya `id` dengan `AUTO_INCREMENT`. Primary Key inilah yang dipakai tabel lain untuk membuat relasi (Foreign Key).

### 🎯 Studi Kasus: Class Diagram "Pesan" & "Kategori"

```
classDiagram
    class Kategori {
        -id : int (PK)
        -nama_kategori : string
    }
    class Pesan {
        -id : int (PK)
        -nama : string
        -email : string
        -kategori_id : int (FK)
        -pesan : text
        -status : string
        -tanggal_kirim : datetime
        +simpan()
        +ubahStatus()
        +hapus()
    }
    Kategori "1" -- "many" Pesan : memiliki
```

Penjelasan relasi: **1 kategori bisa dimiliki oleh banyak pesan** (One-to-Many) — misalnya kategori "Landing Page" bisa muncul di banyak baris pesan yang berbeda.

### Challenge 2 — New Case Study

Peserta membuat Class Diagram untuk kasus lain, misalnya "Sistem Perpustakaan" (`Buku` dan `Peminjam`) atau "Sistem Toko" (`Produk` dan `Kategori Produk`) — untuk melatih pemahaman relasi One-to-Many di konteks berbeda.

> **Catatan pengajar:** di pertemuan berikutnya (Intro to Database), Class Diagram di atas akan langsung diimplementasikan menjadi tabel `kategori` dan `pesan` yang sungguhan di MySQL — jadi pastikan peserta benar-benar memahami diagram ini sebelum lanjut.

**Target:** peserta memahami pentingnya merancang struktur data & relasi SEBELUM membuat tabel database, serta paham konsep Primary Key.

---

## Pertemuan 3 — Intro to Database

### Tujuan Belajar

1. Memahami implementasi sesuai dengan rancangan Class Diagram.
2. Membuat database, table, serta atribut yang dibutuhkan sesuai perancangan.

### Materi

**Install Local Server (Laragon)**

1. Download Laragon dari [laragon.org](https://laragon.org/) → pilih versi **Full** (sudah termasuk PHP, MySQL, Apache).
2. Install seperti biasa, lalu buka aplikasi Laragon.
3. Klik tombol **Start All** — ini akan menjalankan Apache (web server) dan MySQL (database server) sekaligus.
4. Buka browser, akses `http://localhost` — jika muncul halaman Laragon, instalasi berhasil.

**Download phpMyAdmin di Laragon (optional)**

phpMyAdmin biasanya sudah termasuk dalam Laragon Full. Untuk mengaksesnya:

1. Klik kanan ikon Laragon di tray → **www** → akan membuka folder `C:\laragon\www` (tempat semua project PHP diletakkan).
2. Akses `http://localhost/phpmyadmin` di browser untuk membuka phpMyAdmin — antarmuka visual untuk mengelola database tanpa menulis SQL manual.

**Create Database and Table**

Lewat phpMyAdmin:

1. Klik **New** di sidebar kiri → beri nama database: `portfolio_db` → **Create**.
2. Pilih database `portfolio_db` → tab **SQL** → jalankan query berikut untuk membuat tabel sesuai Class Diagram pertemuan 2:

```
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL
);

CREATE TABLE pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    kategori_id INT,
    pesan TEXT NOT NULL,
    status ENUM('baru', 'dibaca') DEFAULT 'baru',
    tanggal_kirim DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id)
);

-- Data awal kategori
INSERT INTO kategori (nama_kategori) VALUES
('Landing Page'), ('E-Commerce'), ('Dashboard');
```

Penjelasan tiap bagian:

- `AUTO_INCREMENT PRIMARY KEY` — id otomatis bertambah & unik (implementasi dari "Unique Value" pertemuan 2).
- `NOT NULL` — kolom wajib diisi, tidak boleh kosong.
- `ENUM('baru','dibaca')` — kolom hanya boleh berisi salah satu dari 2 nilai ini.
- `DEFAULT CURRENT_TIMESTAMP` — otomatis terisi waktu saat data dimasukkan.
- `FOREIGN KEY (kategori_id) REFERENCES kategori(id)` — inilah relasi One-to-Many dari Class Diagram diimplementasikan secara nyata.

### 🎯 Proyek Pertemuan 3: `portfolio_db` siap dipakai

**Target:** peserta punya local server aktif (Laragon), database `portfolio_db` dengan 2 tabel (`kategori`, `pesan`) yang sudah terisi data kategori awal, dan bisa membukanya lewat phpMyAdmin.

---

## Pertemuan 4 — Intro to PHP

### Tujuan Belajar

1. Memahami struktur dan perintah dasar PHP.
2. Mengenal berbagai macam operator dalam bahasa pemrograman.

### Materi

**PHP Structure**

File PHP disimpan dengan ekstensi `.php`, diletakkan di dalam folder project Laragon, misal: `C:\laragon\www\portfolio-backend\index.php`.

```
<?php
// Kode PHP selalu diawali <?php dan diakhiri ?>
echo "Halo dari PHP!";
?>
```

```
<!DOCTYPE html>
<html>
<body>
    <h1>Website Saya</h1>
    <?php
        // PHP bisa disisipkan di tengah HTML
        echo "<p>Halaman ini dirender oleh PHP.</p>";
    ?>
</body>
</html>
```

Akses lewat browser: `http://localhost/portfolio-backend/index.php`.

**Basic Instruction PHP**

```
<?php
$nama = "Budi";          // variabel PHP diawali tanda $
echo "Halo, " . $nama;   // titik (.) untuk menggabungkan string (concatenation)
echo "<br>";
echo "Halo, $nama";      // di dalam double quote, variabel otomatis terbaca
?>
```

**Basic Operator**

```
<?php
// Arithmetic operator
$total = 10 + 5;   // + - * / % **(pangkat)

// Assignment operator
$angka = 10;
$angka += 5;   // sama dengan: $angka = $angka + 5;  -> 15

// Comparison operator
var_dump(10 == "10");   // true  (nilai sama)
var_dump(10 === "10");  // false (tipe data beda: int vs string)
var_dump(10 != 5);      // true
?>
```

**Optional — Increment/Decrement, Logical, String, Array, Conditional Assignment**

```
<?php
// Increment / Decrement
$hitung = 5;
$hitung++;  // 6
$hitung--;  // kembali ke 5

// Logical operator
$umurCukup = (17 >= 17) && true;  // AND
$bolehAkses = false || true;       // OR

// String operator
$namaLengkap = "Budi" . " " . "Santoso";

// Array
$kategoriList = ["Landing Page", "E-Commerce", "Dashboard"];
echo $kategoriList[0]; // "Landing Page"

// Conditional Assignment (ternary & null coalescing)
$status = isset($_GET['status']) ? $_GET['status'] : 'baru';
$status2 = $_GET['status'] ?? 'baru'; // null coalescing, lebih ringkas
?>
```

### Konsep Tambahan Wajib: `$_POST` & `$_GET` Superglobals

Sebelum masuk ke koneksi database, peserta **wajib** paham cara PHP menerima data dari form HTML:

```
<!-- form.html -->
<form action="proses.php" method="POST">
    <input type="text" name="nama">
    <button type="submit">Kirim</button>
</form>
```

```
<?php
// proses.php
$nama = $_POST['nama'];   // ambil data dari form method="POST"
echo "Nama yang dikirim: " . $nama;

// $_GET dipakai untuk data dari URL, contoh: proses.php?id=3
$id = $_GET['id'];
?>
```

### 🎯 Proyek Pertemuan 4: `koneksi.php` (persiapan) & latihan operator

```
<?php
// latihan.php — sekadar latihan operator, belum terhubung ke database
$namaProject = ["Landing Page", "E-Commerce", "Dashboard"];
$totalProject = count($namaProject);

echo "Total kategori project: " . $totalProject . "<br>";
echo "Kategori pertama: " . $namaProject[0];
?>
```

**Target:** peserta paham struktur dasar file PHP, variabel, operator, dan cara PHP menerima data dari form (`$_POST`/`$_GET`) — fondasi wajib sebelum pertemuan Connection.

---

## Pertemuan 5 — Branching (PHP)

### Tujuan Belajar

1. Mampu memanfaatkan penggunaan operator.
2. Mampu implementasi penggunaan konsep "conditional - IF".

### Materi

**Review Materi**: peserta review variabel, operator, dan `$_POST`/`$_GET` dari pertemuan sebelumnya.

**If Statement**

```
<?php
$status = "baru";

if ($status === "baru") {
    echo "Pesan ini belum dibaca.";
} else {
    echo "Pesan ini sudah dibaca.";
}
?>
```

**Switch Statement**

```
<?php
$kategoriId = 2;

switch ($kategoriId) {
    case 1:
        echo "Landing Page";
        break;
    case 2:
        echo "E-Commerce";
        break;
    case 3:
        echo "Dashboard";
        break;
    default:
        echo "Kategori tidak diketahui";
}
?>
```

**Nested If**

```
<?php
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';

if (!empty($nama)) {
    if (strpos($email, '@') !== false) {
        echo "Data valid, siap disimpan.";
    } else {
        echo "Format email tidak valid.";
    }
} else {
    echo "Nama wajib diisi.";
}
?>
```

### 🎯 Proyek Pertemuan 5: fungsi validasi & label status pesan

```
<?php
// validasi.php
function validasiPesan($nama, $email, $pesan) {
    if (empty($nama) || empty($email) || empty($pesan)) {
        return "⚠️ Semua field wajib diisi!";
    }
    if (strpos($email, '@') === false) {
        return "⚠️ Format email tidak valid.";
    }
    return "✅ Data valid.";
}

function labelStatus($status) {
    switch ($status) {
        case "baru":
            return "🔵 Baru";
        case "dibaca":
            return "✅ Sudah Dibaca";
        default:
            return "❓ Tidak diketahui";
    }
}

// contoh pemakaian
echo validasiPesan("Budi", "budi@mail.com", "Halo, saya tertarik project Anda.");
echo "<br>";
echo labelStatus("baru");
?>
```

**Target:** peserta paham `if/else`, `switch`, dan nested if di PHP, serta menyiapkan fungsi validasi yang akan langsung dipakai di pertemuan Connection.

---

## Pertemuan 6 — Connection (PHP ↔ MySQL)

### Tujuan Belajar

1. Memahami atribut dasar yang dimiliki server.
2. Memahami cara membuat koneksi antara website dengan database.
3. Memahami penggunaan kombinasi perintah SQL dengan PHP untuk input data.

### Materi

**Database Connection Using PHP (MySQLi Object-Oriented)**

```
<?php
// koneksi.php
$host = "localhost";
$user = "root";       // default Laragon
$password = "";       // default Laragon (kosong)
$database = "portfolio_db";

$koneksi = new mysqli($host, $user, $password, $database);

// Error handling dasar — WAJIB, agar tidak "blank putih" saat gagal konek
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
```

> **Kenapa dicek errornya?** Kalau database belum di-Start di Laragon, atau nama database salah ketik, developer harus tahu PERSIS di mana masalahnya — bukan sekadar layar putih kosong.

**Input Data to MySQL Database (SQL Query | SQL Part 1: INSERT INTO)**

⚠️ **Konsep tambahan penting: Prepared Statement (mencegah SQL Injection)**

Menulis query dengan menggabungkan langsung `$_POST` ke dalam string SQL **sangat berbahaya** (rentan SQL Injection). Selalu gunakan **prepared statement**:

```
<?php
// proses_kirim_pesan.php
require 'koneksi.php';
require 'validasi.php';

$nama = htmlspecialchars($_POST['nama'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$kategoriId = $_POST['kategori_id'] ?? '';
$pesanIsi = htmlspecialchars($_POST['pesan'] ?? '');

$hasilValidasi = validasiPesan($nama, $email, $pesanIsi);

if ($hasilValidasi === "✅ Data valid.") {
    // Prepared statement — placeholder "?" diisi lewat bind_param, BUKAN digabung manual ke string
    $stmt = $koneksi->prepare(
        "INSERT INTO pesan (nama, email, kategori_id, pesan) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssis", $nama, $email, $kategoriId, $pesanIsi);
    // "ssis" = string, string, integer, string -> urutan & tipe HARUS sesuai urutan "?"

    if ($stmt->execute()) {
        echo "✅ Pesan berhasil dikirim. Terima kasih, $nama!";
    } else {
        echo "❌ Gagal menyimpan pesan: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo $hasilValidasi;
}

$koneksi->close();
?>
```

**Menghubungkan ke form kontak front end**

Ubah form kontak dari front end (`index.html`) supaya benar-benar mengirim data ke PHP:

```
<form id="formKontak" action="proses_kirim_pesan.php" method="POST">
    <input type="text" name="nama" id="inputNama" placeholder="Nama Lengkap" required>
    <input type="email" name="email" id="inputEmail" placeholder="Email" required>
    <select name="kategori_id">
        <option value="1">Landing Page</option>
        <option value="2">E-Commerce</option>
        <option value="3">Dashboard</option>
    </select>
    <textarea name="pesan" id="inputPesan" placeholder="Pesan Anda" required></textarea>
    <button type="submit" class="btn-primary">Kirim Pesan</button>
</form>
```

> Karena sekarang form dikirim ke server (`action="proses_kirim_pesan.php"`), file HTML front end juga perlu diganti ekstensinya menjadi `.php` (misal `index.php`) supaya bisa berjalan di server yang sama, atau ditempatkan pada folder project PHP yang sama di Laragon.

### 🎯 Proyek Pertemuan 6: form kontak tersambung ke database sungguhan

Setelah pertemuan ini, mengisi form kontak di website portfolio benar-benar menyimpan data ke tabel `pesan` di `portfolio_db` — bisa dicek lewat phpMyAdmin.

**Target:** peserta paham cara PHP terhubung ke MySQL, dan **kenapa prepared statement wajib dipakai**, bukan sekadar query string biasa.

---

## Pertemuan 7 — Loop x Array x SQL (Bagian 1: Konsep Looping)

### Tujuan Belajar

1. Mampu memanfaatkan penggunaan konsep pemrograman Loop.
2. Mampu implementasi penggunaan konsep "conditional - Loop".

### Materi

**Intro to Looping Concept**: sama seperti di JavaScript, loop di PHP dipakai untuk mengulang sebuah proses tanpa menulis kode berkali-kali — sangat penting karena nantinya dipakai untuk menampilkan **banyak baris data dari database sekaligus**.

**While & Do-While Statement**

```
<?php
// While — cek kondisi DULU, baru jalankan
$i = 1;
while ($i <= 5) {
    echo "Perulangan ke-$i <br>";
    $i++;
}

// Do-While — jalankan DULU minimal 1x, baru cek kondisi
$j = 1;
do {
    echo "Perulangan ke-$j <br>";
    $j++;
} while ($j <= 5);
?>
```

**For Statement**

```
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "Perulangan ke-$i <br>";
}
?>
```

**Nested Loop**

```
<?php
for ($baris = 1; $baris <= 3; $baris++) {
    for ($kolom = 1; $kolom <= 3; $kolom++) {
        echo "[$baris,$kolom] ";
    }
    echo "<br>";
}
?>
```

### 🎯 Proyek Pertemuan 7: latihan loop sebagai pemanasan sebelum menampilkan data database

```
<?php
// latihan_loop.php
$kategoriDummy = ["Landing Page", "E-Commerce", "Dashboard"];

for ($i = 0; $i < count($kategoriDummy); $i++) {
    echo "<li>" . $kategoriDummy[$i] . "</li>";
}
?>
```

**Target:** peserta lancar memakai `while`, `do-while`, `for`, dan nested loop — siap dipakai untuk menampilkan data asli dari database di pertemuan berikutnya.

---

## Pertemuan 8 — Loop x Array x SQL (Bagian 2: Basic Array + SELECT * FROM)

### Tujuan Belajar

1. Memahami penggunaan kombinasi perintah SQL dengan array PHP untuk pengambilan data.
2. Membuat tampilan halaman website untuk menampilkan data dari database.

### Materi

**Basic Array (PHP)**

```
<?php
$kategori = ["Landing Page", "E-Commerce", "Dashboard"]; // indexed array
$pesanSatuBaris = [
    "nama" => "Budi",
    "email" => "budi@mail.com",
    "pesan" => "Halo!"
]; // associative array — mirip object di JS

echo $pesanSatuBaris["nama"]; // "Budi"
?>
```

**SQL Part 2 — SELECT * FROM**

```
SELECT * FROM pesan;
```

**Menggabungkan SELECT + Array + Loop untuk menampilkan data**

```
<?php
require 'koneksi.php';

$query = "SELECT * FROM pesan";
$hasil = $koneksi->query($query);
// $hasil berisi banyak baris data, mirip array of array/object
?>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th><th>Email</th><th>Pesan</th><th>Status</th><th>Tanggal</th>
    </tr>
    <?php while ($baris = $hasil->fetch_assoc()) : ?>
        <tr>
            <td><?= htmlspecialchars($baris['nama']) ?></td>
            <td><?= htmlspecialchars($baris['email']) ?></td>
            <td><?= htmlspecialchars($baris['pesan']) ?></td>
            <td><?= htmlspecialchars($baris['status']) ?></td>
            <td><?= $baris['tanggal_kirim'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
```

Penjelasan:

- `fetch_assoc()` — mengambil 1 baris data dari hasil query, dalam bentuk associative array (`$baris['nama']`, dst).
- `while (...)` — loop ini otomatis berhenti saat data sudah habis dibaca.
- `<?=...?>` — singkatan dari `<?php echo...;?>`, memudahkan menyisipkan PHP di tengah HTML.
- `htmlspecialchars()` — **wajib** dipakai saat menampilkan data yang berasal dari input pengguna, untuk mencegah XSS (kalau ada yang mengisi pesan berisi tag `<script>`, tag itu akan ditampilkan sebagai teks biasa, bukan dieksekusi).

### Challenge 3 — Create New UI Design for View Data

Peserta merancang & membangun halaman `admin.php` yang menampilkan tabel pesan di atas dengan tampilan yang lebih rapi (bisa pakai Bootstrap dari materi front end).

### 🎯 Proyek Pertemuan 8: `admin.php` — halaman admin menampilkan semua pesan

```
<?php
// admin.php
require 'koneksi.php';
$hasil = $koneksi->query("SELECT * FROM pesan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin — Daftar Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1>Daftar Pesan Masuk</h1>
    <table class="table table-striped">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Pesan</th><th>Status</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            <?php while ($baris = $hasil->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($baris['nama']) ?></td>
                <td><?= htmlspecialchars($baris['email']) ?></td>
                <td><?= htmlspecialchars($baris['pesan']) ?></td>
                <td><?= htmlspecialchars($baris['status']) ?></td>
                <td><?= $baris['tanggal_kirim'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
```

**Target:** admin bisa membuka `admin.php` dan melihat semua pesan yang sudah dikirim lewat form kontak — data asli dari database, bukan lagi data dummy.

---

## Pertemuan 9 — Loop x Array x SQL (Bagian 3: ORDER BY)

### Tujuan Belajar

1. Memahami penggunaan kombinasi perintah SQL dengan berpikir kritis mengolah data.

### Materi

**SQL Part 3 — ORDER BY**

```
SELECT * FROM pesan ORDER BY tanggal_kirim DESC; -- terbaru dulu
SELECT * FROM pesan ORDER BY tanggal_kirim ASC;  -- terlama dulu
SELECT * FROM pesan ORDER BY nama ASC;           -- urut abjad nama
```

### Challenge 4 — Show Data Using Concept "Order By"

Tambahkan dropdown pengurutan di `admin.php`, gunakan `$_GET` untuk menentukan urutan:

```
<?php
require 'koneksi.php';

$urutan = $_GET['urutan'] ?? 'terbaru';
$orderBy = ($urutan === 'terlama') ? 'ASC' : 'DESC';

$query = "SELECT * FROM pesan ORDER BY tanggal_kirim $orderBy";
$hasil = $koneksi->query($query);
?>

<form method="GET" class="mb-3">
    <select name="urutan" onchange="this.form.submit()">
        <option value="terbaru" <?= $urutan === 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
        <option value="terlama" <?= $urutan === 'terlama' ? 'selected' : '' ?>>Terlama</option>
    </select>
</form>
```

> **Catatan keamanan:** karena `$orderBy` di sini hanya berisi `'ASC'` atau `'DESC'` (ditentukan lewat if/else, bukan langsung dari `$_GET`), ini aman dari SQL Injection. **Jangan pernah** menyisipkan `$_GET`/`$_POST` mentah langsung ke bagian `ORDER BY` sebuah query.

### 🎯 Proyek Pertemuan 9: `admin.php` bisa diurutkan

**Target:** admin bisa mengurutkan daftar pesan dari terbaru/terlama lewat dropdown, tanpa reload manual (form auto-submit via `onchange`).

---

## Pertemuan 10 — Loop x Array x SQL (Bagian 4: DELETE & UPDATE)

### Tujuan Belajar

1. Memahami konsep hapus dan memperbarui data tanpa akses langsung ke database.

### Materi

**SQL Part 4 — DELETE Data**

```
DELETE FROM pesan WHERE id = 5;
```

**SQL Part 5 — UPDATE Data**

```
UPDATE pesan SET status = 'dibaca' WHERE id = 5;
```

**Implementasi PHP — hapus_pesan.php**

```
<?php
require 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $koneksi->prepare("DELETE FROM pesan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin.php"); // redirect kembali ke halaman admin setelah hapus
exit;
?>
```

**Implementasi PHP — ubah_status.php**

```
<?php
require 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $koneksi->prepare("UPDATE pesan SET status = 'dibaca' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin.php");
exit;
?>
```

### Challenge 5 — Delete and Update Data

Tambahkan tombol Aksi di setiap baris tabel `admin.php`:

```
<td>
    <a href="ubah_status.php?id=<?= $baris['id'] ?>" class="btn btn-sm btn-success">Tandai Dibaca</a>
    <a href="hapus_pesan.php?id=<?= $baris['id'] ?>"
       class="btn btn-sm btn-danger"
       onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</a>
</td>
```

> `confirm()` di JavaScript memunculkan dialog konfirmasi sebelum link dijalankan — mencegah admin tidak sengaja menghapus data.

### 🎯 Proyek Pertemuan 10: `admin.php` lengkap dengan aksi ubah status & hapus

**Target:** admin bisa mengubah status pesan menjadi "dibaca" dan menghapus pesan langsung dari tabel — tanpa perlu buka phpMyAdmin secara manual.

---

## Pertemuan 11 — Final Exam Part 1: Free Project

### Tujuan Belajar

Menghasilkan prototipe sistem yang dapat dijadikan sebagai fondasi sistem CRUD sederhana.

### Aktivitas

1. Review seluruh materi Part 1 (Activity/Class Diagram → Database → PHP dasar → Branching → Connection → Loop/Array/SQL).
2. **Challenge**: peserta menyempurnakan sistem manajemen pesan pribadi masing-masing secara mandiri.

### Checklist Final Exam Part 1

- [ ] Activity Diagram & Class Diagram sudah dibuat sebelum coding
- [ ] Database `portfolio_db` dengan tabel `pesan` & `kategori` (relasi Foreign Key)
- [ ] Form kontak front end benar-benar menyimpan data ke database (prepared statement)
- [ ] Halaman `admin.php` menampilkan seluruh data pesan (SELECT + loop)
- [ ] Bisa diurutkan (ORDER BY)
- [ ] Bisa ubah status & hapus data (UPDATE & DELETE, dengan prepared statement)
- [ ] Semua output data memakai `htmlspecialchars()` (aman dari XSS)

### 📄 Kode Kumulatif — Akhir Part 1

`koneksi.php`:

```
<?php
$koneksi = new mysqli("localhost", "root", "", "portfolio_db");
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
```

`proses_kirim_pesan.php`:

```
<?php
require 'koneksi.php';

function validasiPesan($nama, $email, $pesan) {
    if (empty($nama) || empty($email) || empty($pesan)) {
        return "⚠️ Semua field wajib diisi!";
    }
    if (strpos($email, '@') === false) {
        return "⚠️ Format email tidak valid.";
    }
    return "OK";
}

$nama = htmlspecialchars($_POST['nama'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$kategoriId = $_POST['kategori_id'] ?? '';
$pesanIsi = htmlspecialchars($_POST['pesan'] ?? '');

$hasilValidasi = validasiPesan($nama, $email, $pesanIsi);

if ($hasilValidasi === "OK") {
    $stmt = $koneksi->prepare("INSERT INTO pesan (nama, email, kategori_id, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nama, $email, $kategoriId, $pesanIsi);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?status=sukses");
} else {
    header("Location: index.php?status=gagal&pesan=" . urlencode($hasilValidasi));
}
$koneksi->close();
exit;
?>
```

`admin.php`:

```
<?php
require 'koneksi.php';

$urutan = $_GET['urutan'] ?? 'terbaru';
$orderBy = ($urutan === 'terlama') ? 'ASC' : 'DESC';

$hasil = $koneksi->query("SELECT * FROM pesan ORDER BY tanggal_kirim $orderBy");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin — Daftar Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1>Daftar Pesan Masuk</h1>

    <form method="GET" class="mb-3">
        <select name="urutan" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            <option value="terbaru" <?= $urutan === 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
            <option value="terlama" <?= $urutan === 'terlama' ? 'selected' : '' ?>>Terlama</option>
        </select>
    </form>

    <table class="table table-striped">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Pesan</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php while ($baris = $hasil->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($baris['nama']) ?></td>
                <td><?= htmlspecialchars($baris['email']) ?></td>
                <td><?= htmlspecialchars($baris['pesan']) ?></td>
                <td><?= htmlspecialchars($baris['status']) ?></td>
                <td><?= $baris['tanggal_kirim'] ?></td>
                <td>
                    <a href="ubah_status.php?id=<?= $baris['id'] ?>" class="btn btn-sm btn-success">Tandai Dibaca</a>
                    <a href="hapus_pesan.php?id=<?= $baris['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
```

`hapus_pesan.php` & `ubah_status.php`: sama seperti kode pertemuan 10 di atas.

---

# PART 2 — JOIN, SUMMARY DATA & PUBLISH

## Pertemuan 12 — Back to Part 1: Review Web Dev (Front End & Back End)

### Tujuan Belajar

1. Menguasai konsep dasar dari web dev (front end dan back end).
2. Mampu implementasi dalam studi kasus lain.

### Aktivitas

1. **Review Front End**: HTML semantic, CSS Flexbox/Grid, JavaScript (DOM, loop, array, function, event handler).
2. **Review Back End**: struktur PHP, koneksi database, prepared statement, CRUD (Create/Read/Update/Delete).
3. Peserta yang masih lemah di salah satu bagian diberi latihan tambahan sesuai kebutuhan (misal: latihan tambahan query SELECT+WHERE, atau latihan tambahan DOM manipulation).

### 🎯 Latihan Review: tambahkan 1 fitur kecil secara mandiri

Sebagai uji pemahaman menyeluruh, peserta diminta menambahkan fitur **"Cari pesan berdasarkan nama"** secara mandiri (menggabungkan `$_GET`, `LIKE` di SQL, dan form HTML) — sebelum lanjut ke materi Join di pertemuan berikutnya.

```
<?php
$kataKunci = $_GET['cari'] ?? '';
$stmt = $koneksi->prepare("SELECT * FROM pesan WHERE nama LIKE ? ORDER BY tanggal_kirim DESC");
$likeParam = "%" . $kataKunci . "%";
$stmt->bind_param("s", $likeParam);
$stmt->execute();
$hasil = $stmt->get_result();
?>
```

**Target:** peserta mampu menghubungkan kembali seluruh materi front end + back end dalam 1 studi kasus yang sama, siap melangkah ke materi lanjutan (Join & Summary Data).

---

## Pertemuan 13 — Join Table: Join

### Tujuan Belajar

1. Menjelaskan fungsi serta pemanfaatan join tabel.
2. Menampilkan data dengan memanfaatkan berbagai versi join.

### Materi

Sampai pertemuan 12, tabel `admin.php` menampilkan `kategori_id` (angka `1`, `2`, `3`) — bukan nama kategorinya. Untuk menampilkan **nama kategori**, kita perlu **JOIN** tabel `pesan` dengan tabel `kategori`.

**Inner Join** — hanya menampilkan baris yang punya pasangan cocok di kedua tabel

```
SELECT pesan.id, pesan.nama, pesan.pesan, kategori.nama_kategori
FROM pesan
INNER JOIN kategori ON pesan.kategori_id = kategori.id;
```

**Left Join** — semua baris tabel kiri (`pesan`) tetap tampil walau `kategori_id`-nya kosong/tidak cocok

```
SELECT pesan.id, pesan.nama, kategori.nama_kategori
FROM pesan
LEFT JOIN kategori ON pesan.kategori_id = kategori.id;
```

**Right Join** — semua baris tabel kanan (`kategori`) tetap tampil, walau belum ada pesan yang memakainya

```
SELECT kategori.nama_kategori, pesan.nama
FROM pesan
RIGHT JOIN kategori ON pesan.kategori_id = kategori.id;
```

**Cross Join** — mengombinasikan SETIAP baris tabel A dengan SETIAP baris tabel B (jarang dipakai untuk laporan, lebih untuk kombinasi/permutasi data)

```
SELECT pesan.nama, kategori.nama_kategori
FROM pesan
CROSS JOIN kategori;
-- Jika pesan ada 5 baris dan kategori ada 3 baris, hasilnya 5 x 3 = 15 baris kombinasi
```

| Jenis Join | Kapan dipakai |
| --- | --- |
| INNER JOIN | Hanya butuh data yang punya pasangan lengkap di kedua tabel (paling umum) |
| LEFT JOIN | Butuh semua data utama tetap tampil walau relasinya kosong |
| RIGHT JOIN | Butuh semua data tabel kedua tetap tampil (jarang, biasanya diganti LEFT JOIN dengan tabel dibalik urutannya) |
| CROSS JOIN | Butuh semua kombinasi yang mungkin antar 2 tabel |

### 🎯 Proyek Pertemuan 13: `admin.php` menampilkan nama kategori (bukan angka)

```
<?php
require 'koneksi.php';

$hasil = $koneksi->query("
    SELECT pesan.*, kategori.nama_kategori
    FROM pesan
    INNER JOIN kategori ON pesan.kategori_id = kategori.id
    ORDER BY pesan.tanggal_kirim DESC
");
?>
<td><?= htmlspecialchars($baris['nama_kategori']) ?></td>
```

**Target:** peserta paham perbedaan ke-4 jenis join dan bisa menggunakan `INNER JOIN` untuk menampilkan nama kategori yang mudah dibaca, bukan sekadar angka `kategori_id`.

---

## Pertemuan 14 — Join Table: Group

### Tujuan Belajar

1. Mampu berpikir kritis terhadap pengolahan data yang disatukan.

### Materi

**GROUP BY** — mengelompokkan baris data yang punya nilai sama pada 1 kolom, lalu diringkas dengan fungsi agregat (`COUNT`, `SUM`, `AVG`, dst).

```
SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
FROM pesan
INNER JOIN kategori ON pesan.kategori_id = kategori.id
GROUP BY kategori.nama_kategori;
```

Hasil contoh:

```
+----------------+---------------+
| nama_kategori  | jumlah_pesan  |
+----------------+---------------+
| Landing Page   | 4             |
| E-Commerce     | 7             |
| Dashboard      | 2             |
+----------------+---------------+
```

**Implementasi PHP**

```
<?php
require 'koneksi.php';

$query = "
    SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
    FROM kategori
    LEFT JOIN pesan ON pesan.kategori_id = kategori.id
    GROUP BY kategori.nama_kategori
";
// LEFT JOIN dari kategori dipakai di sini supaya kategori yang BELUM punya pesan
// tetap muncul dengan jumlah_pesan = 0, bukan hilang dari hasil.
$hasil = $koneksi->query($query);

while ($baris = $hasil->fetch_assoc()) {
    echo $baris['nama_kategori'] . ": " . $baris['jumlah_pesan'] . " pesan<br>";
}
?>
```

### 🎯 Proyek Pertemuan 14: query ringkasan jumlah pesan per kategori

**Target:** peserta paham `GROUP BY` untuk meringkas data, dan paham kenapa kombinasi `LEFT JOIN` (bukan `INNER JOIN`) lebih tepat dipakai di sini — data ini akan langsung dipakai untuk membuat grafik di pertemuan berikutnya.

---

## Pertemuan 15 — Summary Data: Dynamic Column Chart

### Tujuan Belajar

1. Menjelaskan secara singkat tentang function, array, dan dynamic column chart beserta fungsinya pada program.
2. Melakukan implementasi dengan menghasilkan grafik berdasarkan data yang dimiliki.

### Materi

**PHP Function** — membungkus query GROUP BY dari pertemuan 14 menjadi function reusable

```
<?php
function ambilRingkasanKategori($koneksi) {
    $query = "
        SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
        FROM kategori
        LEFT JOIN pesan ON pesan.kategori_id = kategori.id
        GROUP BY kategori.nama_kategori
    ";
    $hasil = $koneksi->query($query);

    $data = [];
    while ($baris = $hasil->fetch_assoc()) {
        $data[] = $baris;
    }
    return $data;
}
?>
```

**PHP Array** — mengubah hasil query menjadi 2 array terpisah (label & jumlah), format yang dibutuhkan Chart.js

```
<?php
$ringkasan = ambilRingkasanKategori($koneksi);

$labelKategori = [];
$jumlahPesan = [];

foreach ($ringkasan as $item) {
    $labelKategori[] = $item['nama_kategori'];
    $jumlahPesan[] = $item['jumlah_pesan'];
}
?>
```

**Create Dynamic Column Chart** (dengan Chart.js)

PHP menyiapkan data lewat `json_encode()`, lalu JavaScript (Chart.js) yang menggambarnya:

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</head>
<body class="container py-4">
    <h1>Dashboard — Jumlah Pesan per Kategori</h1>
    <canvas id="chartKategori" style="max-width: 600px;"></canvas>

    <script>
        const labelKategori = <?= json_encode($labelKategori) ?>;
        const jumlahPesan = <?= json_encode($jumlahPesan) ?>;

        new Chart(document.getElementById('chartKategori'), {
            type: 'bar', // column chart
            data: {
                labels: labelKategori,
                datasets: [{
                    label: 'Jumlah Pesan',
                    data: jumlahPesan,
                    backgroundColor: '#1c3d5a'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
</body>
</html>
```

Penjelasan: `json_encode($labelKategori)` mengubah array PHP `["Landing Page","E-Commerce","Dashboard"]` menjadi string JSON yang valid dibaca JavaScript — inilah **jembatan** antara PHP (back end) dan Chart.js (front end).

### 🎯 Proyek Pertemuan 15: `dashboard.php` dengan grafik dinamis

**Target:** admin bisa melihat grafik batang jumlah pesan per kategori yang datanya **langsung dari database**, otomatis berubah setiap ada pesan baru masuk.

---

## Pertemuan 16 — Summary Data: Filtering Data

### Tujuan Belajar

1. Melakukan latihan dengan menerapkan kombinasi konsep pada materi sebelumnya.

### Materi

**Review Dynamic Column Chart**: peserta review cara kerja `json_encode` + Chart.js dari pertemuan 15.

### Challenge 2 — Show Data Based on Value (button select + dynamic chart)

Menggabungkan **Branching** (pertemuan 5), **Join+Group By** (pertemuan 13-14), dan **Chart.js** (pertemuan 15) menjadi 1 fitur: filter dashboard berdasarkan **status pesan** (`semua` / `baru` / `dibaca`).

```
<?php
require 'koneksi.php';

$statusFilter = $_GET['status'] ?? 'semua';

function ambilRingkasanKategori($koneksi, $statusFilter) {
    $query = "
        SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
        FROM kategori
        LEFT JOIN pesan ON pesan.kategori_id = kategori.id
    ";

    if ($statusFilter !== 'semua') {
        $query .= " AND pesan.status = ?";
    }
    $query .= " GROUP BY kategori.nama_kategori";

    // Karena query berubah struktur (ada WHERE opsional), gunakan prepared statement kondisional
    if ($statusFilter !== 'semua') {
        $stmt = $koneksi->prepare(str_replace(
            "LEFT JOIN pesan ON pesan.kategori_id = kategori.id AND",
            "LEFT JOIN pesan ON pesan.kategori_id = kategori.id WHERE",
            $query
        ));
        $stmt->bind_param("s", $statusFilter);
        $stmt->execute();
        $hasil = $stmt->get_result();
    } else {
        $hasil = $koneksi->query(str_replace(" AND pesan.status = ?", "", $query));
    }

    $data = [];
    while ($baris = $hasil->fetch_assoc()) {
        $data[] = $baris;
    }
    return $data;
}

$ringkasan = ambilRingkasanKategori($koneksi, $statusFilter);
$labelKategori = array_column($ringkasan, 'nama_kategori');
$jumlahPesan = array_column($ringkasan, 'jumlah_pesan');
?>

<div class="btn-group mb-3">
    <a href="?status=semua" class="btn btn-outline-primary <?= $statusFilter === 'semua' ? 'active' : '' ?>">Semua</a>
    <a href="?status=baru" class="btn btn-outline-primary <?= $statusFilter === 'baru' ? 'active' : '' ?>">Baru</a>
    <a href="?status=dibaca" class="btn btn-outline-primary <?= $statusFilter === 'dibaca' ? 'active' : '' ?>">Dibaca</a>
</div>
<canvas id="chartKategori" style="max-width: 600px;"></canvas>
<script>
    // sama seperti pertemuan 15, memakai $labelKategori & $jumlahPesan yang sudah difilter
</script>
```

> **Catatan pengajar:** contoh di atas sengaja ditulis manual (`str_replace`) supaya peserta melihat bagaimana query SQL bisa berubah kondisional. Untuk kelas dengan level lebih lanjut, ini bisa disederhanakan dengan membangun query secara lebih terstruktur — namun untuk pemula, pendekatan eksplisit ini lebih mudah ditelusuri langkah demi langkah.

### 🎯 Proyek Pertemuan 16: dashboard dengan tombol filter status

**Target:** dashboard admin kini bisa difilter berdasarkan status pesan, dan grafik ikut berubah sesuai filter yang dipilih — menggabungkan hampir seluruh materi Part 2 sejauh ini.

---

## Pertemuan 17 — Publish: Server

### Tujuan Belajar

1. Menjelaskan tahapan yang perlu dilakukan saat publish website.

### Materi

Berbeda dari front end statis (yang bisa langsung deploy ke Vercel), website dengan PHP + MySQL butuh **hosting yang mendukung PHP & database**. Tahapan umum:

**1. Pilih layanan hosting**

| Opsi | Cocok untuk |
| --- | --- |
| Shared hosting (Niagahoster, DomaiNesia, Hostinger) | Paling mudah untuk pemula, ada cPanel |
| InfinityFree / 000webhost | Gratis, cocok untuk latihan/demo |
| Railway / Render | Modern, mendukung deployment dari GitHub, butuh sedikit konfigurasi tambahan untuk PHP |
| VPS (DigitalOcean, dsb) | Fleksibel penuh, tapi butuh setup manual (Apache/Nginx + PHP + MySQL sendiri) |

**2. Set Up Server (langkah umum di shared hosting/cPanel)**

1. Login ke cPanel dari penyedia hosting.
2. Buka **File Manager** → upload seluruh file project (`index.php`, `admin.php`, `css/`, `js/`, dst) ke folder `public_html`.
3. Buka **MySQL Databases** di cPanel → buat database baru & user baru, catat nama database/username/password.
4. Buka **phpMyAdmin** di cPanel → **Import** file `.sql` (export struktur tabel dari Laragon terlebih dulu lewat phpMyAdmin lokal: **Export → Quick → Go** ).
5. **Update `koneksi.php`** dengan kredensial database hosting (host, user, password, nama database — biasanya BUKAN `localhost` / `root` /kosong lagi seperti di Laragon).

```
<?php
// koneksi.php — versi production (contoh, sesuaikan dengan kredensial hosting asli)
$koneksi = new mysqli("localhost", "namauser_db", "passwordAsli123", "namauser_portfoliodb");
if ($koneksi->connect_error) {
    die("Koneksi database gagal.");
    // di production, JANGAN tampilkan detail error teknis ke pengguna publik
}
?>
```

> **Catatan keamanan production:** pesan error di atas sengaja dibuat generik ("Koneksi database gagal.") tanpa menampilkan `$koneksi->connect_error` — detail error sebaiknya hanya dicatat ke log server (`error_log()`), bukan ditampilkan ke pengunjung, supaya tidak membocorkan struktur internal sistem.

### 🎯 Proyek Pertemuan 17: checklist persiapan deployment

**Target:** peserta paham tahapan menyiapkan server untuk aplikasi PHP + MySQL, dan file `koneksi.php` sudah dipisahkan pengaturannya antara environment lokal (Laragon) dan production (hosting).

---

## Pertemuan 18 — Publish: System Test

### Tujuan Belajar

1. Melakukan uji coba terhadap website yang baru saja dipublish.

### Materi

**System Testing** — checklist pengujian sebelum website benar-benar dipakai publik:

1. **Functional testing** — semua fitur dicoba satu per satu:
  - Kirim pesan dari form kontak → cek apakah masuk ke database.
  - Coba kirim form dengan field kosong → harus muncul pesan error, bukan crash.
  - Coba kirim email tanpa `@` → harus ditolak validasi.
  - Urutkan data (terbaru/terlama) → cek hasilnya benar.
  - Filter dashboard by status → cek grafik ikut berubah.
  - Ubah status & hapus pesan → cek data benar-benar berubah di database.
2. **Security testing dasar**
  - Coba masukkan `<script>alert(1)</script>` di field pesan → pastikan tidak muncul sebagai popup (berarti `htmlspecialchars()` bekerja).
  - Coba masukkan tanda kutip aneh (`' OR '1'='1`) di field nama → pastikan tidak error/aneh (berarti prepared statement bekerja).
3. **Cross-browser & responsive testing**
  - Buka website di Chrome, Firefox, dan HP — pastikan tampilan tetap rapi (hasil dari materi responsive di front end).
4. **Error handling testing**
  - Matikan sementara koneksi database (misal salah kredensial) → pastikan muncul pesan error yang jelas, bukan halaman blank/crash fatal.

```
<?php
// Contoh sederhana mencatat error ke log, bukan ke layar (untuk production)
if ($koneksi->connect_error) {
    error_log("DB Connection Error: " . $koneksi->connect_error);
    die("Maaf, terjadi gangguan sistem. Silakan coba lagi nanti.");
}
?>
```

### 🎯 Proyek Pertemuan 18: laporan hasil system testing

Peserta membuat tabel sederhana berisi: nama fitur yang diuji, langkah pengujian, hasil yang diharapkan, hasil aktual, status (Pass/Fail).

| Fitur | Langkah | Hasil Diharapkan | Hasil Aktual | Status |
| --- | --- | --- | --- | --- |
| Kirim pesan | Isi & submit form | Data masuk ke DB | ✅ Sesuai | Pass |
| Validasi email | Kirim tanpa `@` | Muncul pesan error | ✅ Sesuai | Pass |
| Hapus pesan | Klik tombol hapus | Data hilang dari tabel | ✅ Sesuai | Pass |

**Target:** peserta terbiasa melakukan pengujian sistematis sebelum website benar-benar dipakai publik — bukan sekadar "kelihatannya jalan".

---

## Pertemuan 19 — Final Exam Part 2: Free Project

### Tujuan Belajar

Menghasilkan prototipe sistem yang dapat dijadikan sebagai portofolio nyata — front end dan back end terhubung penuh, online, dan sudah diuji.

### Aktivitas

1. Review seluruh materi Part 2 (Review gabungan → Join → Group By → Dynamic Chart → Filtering → Publish → Testing).
2. **Challenge**: peserta menyelesaikan versi final sistem manajemen pesan & dashboard admin, lalu publish ke hosting.

### Checklist Final Exam Part 2

- [ ] Dashboard admin menampilkan nama kategori (hasil JOIN), bukan angka id
- [ ] Ringkasan jumlah pesan per kategori (GROUP BY) ditampilkan sebagai grafik (Chart.js)
- [ ] Dashboard bisa difilter berdasarkan status pesan
- [ ] Semua query INSERT/UPDATE/DELETE memakai prepared statement
- [ ] Semua output data memakai `htmlspecialchars()`
- [ ] Sudah diuji dengan checklist system testing (functional, security, responsive, error handling)
- [ ] Sudah online di hosting yang mendukung PHP + MySQL, kredensial `koneksi.php` sudah disesuaikan ke production

### 📄 Kode Kumulatif Lengkap — Versi Final Back End (Part 1 + Part 2)

`koneksi.php`:

```
<?php
// Ganti kredensial ini sesuai environment (Laragon lokal vs hosting production)
$host = "localhost";
$user = "root";
$password = "";
$database = "portfolio_db";

$koneksi = new mysqli($host, $user, $password, $database);

if ($koneksi->connect_error) {
    error_log("DB Connection Error: " . $koneksi->connect_error);
    die("Maaf, terjadi gangguan sistem. Silakan coba lagi nanti.");
}
?>
```

`functions.php` (kumpulan function reusable):

```
<?php
function validasiPesan($nama, $email, $pesan) {
    if (empty($nama) || empty($email) || empty($pesan)) {
        return "⚠️ Semua field wajib diisi!";
    }
    if (strpos($email, '@') === false) {
        return "⚠️ Format email tidak valid.";
    }
    return "OK";
}

function labelStatus($status) {
    switch ($status) {
        case "baru": return "🔵 Baru";
        case "dibaca": return "✅ Sudah Dibaca";
        default: return "❓ Tidak diketahui";
    }
}

function ambilRingkasanKategori($koneksi, $statusFilter = 'semua') {
    if ($statusFilter !== 'semua') {
        $stmt = $koneksi->prepare("
            SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
            FROM kategori
            LEFT JOIN pesan ON pesan.kategori_id = kategori.id AND pesan.status = ?
            GROUP BY kategori.nama_kategori
        ");
        $stmt->bind_param("s", $statusFilter);
        $stmt->execute();
        $hasil = $stmt->get_result();
    } else {
        $hasil = $koneksi->query("
            SELECT kategori.nama_kategori, COUNT(pesan.id) AS jumlah_pesan
            FROM kategori
            LEFT JOIN pesan ON pesan.kategori_id = kategori.id
            GROUP BY kategori.nama_kategori
        ");
    }

    $data = [];
    while ($baris = $hasil->fetch_assoc()) {
        $data[] = $baris;
    }
    return $data;
}
?>
```

`proses_kirim_pesan.php`:

```
<?php
require 'koneksi.php';
require 'functions.php';

$nama = htmlspecialchars($_POST['nama'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$kategoriId = $_POST['kategori_id'] ?? '';
$pesanIsi = htmlspecialchars($_POST['pesan'] ?? '');

$hasilValidasi = validasiPesan($nama, $email, $pesanIsi);

if ($hasilValidasi === "OK") {
    $stmt = $koneksi->prepare("INSERT INTO pesan (nama, email, kategori_id, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nama, $email, $kategoriId, $pesanIsi);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?status=sukses");
} else {
    header("Location: index.php?status=gagal&pesan=" . urlencode($hasilValidasi));
}
$koneksi->close();
exit;
?>
```

`admin.php`:

```
<?php
require 'koneksi.php';
require 'functions.php';

$urutan = $_GET['urutan'] ?? 'terbaru';
$orderBy = ($urutan === 'terlama') ? 'ASC' : 'DESC';

$hasil = $koneksi->query("
    SELECT pesan.*, kategori.nama_kategori
    FROM pesan
    INNER JOIN kategori ON pesan.kategori_id = kategori.id
    ORDER BY pesan.tanggal_kirim $orderBy
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin — Daftar Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1>Daftar Pesan Masuk</h1>
    <a href="dashboard.php" class="btn btn-outline-dark mb-3">Lihat Dashboard →</a>

    <form method="GET" class="mb-3">
        <select name="urutan" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            <option value="terbaru" <?= $urutan === 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
            <option value="terlama" <?= $urutan === 'terlama' ? 'selected' : '' ?>>Terlama</option>
        </select>
    </form>

    <table class="table table-striped">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Kategori</th><th>Pesan</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            <?php while ($baris = $hasil->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($baris['nama']) ?></td>
                <td><?= htmlspecialchars($baris['email']) ?></td>
                <td><?= htmlspecialchars($baris['nama_kategori']) ?></td>
                <td><?= htmlspecialchars($baris['pesan']) ?></td>
                <td><?= labelStatus($baris['status']) ?></td>
                <td><?= $baris['tanggal_kirim'] ?></td>
                <td>
                    <a href="ubah_status.php?id=<?= $baris['id'] ?>" class="btn btn-sm btn-success">Tandai Dibaca</a>
                    <a href="hapus_pesan.php?id=<?= $baris['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
```

`dashboard.php`:

```
<?php
require 'koneksi.php';
require 'functions.php';

$statusFilter = $_GET['status'] ?? 'semua';
$ringkasan = ambilRingkasanKategori($koneksi, $statusFilter);

$labelKategori = array_column($ringkasan, 'nama_kategori');
$jumlahPesan = array_column($ringkasan, 'jumlah_pesan');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</head>
<body class="container py-4">
    <h1>Dashboard — Jumlah Pesan per Kategori</h1>
    <a href="admin.php" class="btn btn-outline-dark mb-3">← Kembali ke Daftar Pesan</a>

    <div class="btn-group mb-3">
        <a href="?status=semua" class="btn btn-outline-primary <?= $statusFilter === 'semua' ? 'active' : '' ?>">Semua</a>
        <a href="?status=baru" class="btn btn-outline-primary <?= $statusFilter === 'baru' ? 'active' : '' ?>">Baru</a>
        <a href="?status=dibaca" class="btn btn-outline-primary <?= $statusFilter === 'dibaca' ? 'active' : '' ?>">Dibaca</a>
    </div>

    <canvas id="chartKategori" style="max-width: 600px;"></canvas>

    <script>
        const labelKategori = <?= json_encode($labelKategori) ?>;
        const jumlahPesan = <?= json_encode($jumlahPesan) ?>;

        new Chart(document.getElementById('chartKategori'), {
            type: 'bar',
            data: {
                labels: labelKategori,
                datasets: [{ label: 'Jumlah Pesan', data: jumlahPesan, backgroundColor: '#1c3d5a' }]
            },
            options: { scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });
    </script>
</body>
</html>
```

`hapus_pesan.php`:

```
<?php
require 'koneksi.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $koneksi->prepare("DELETE FROM pesan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: admin.php");
exit;
?>
```

`ubah_status.php`:

```
<?php
require 'koneksi.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $koneksi->prepare("UPDATE pesan SET status = 'dibaca' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: admin.php");
exit;
?>
```

**Target akhir kelas:** peserta memiliki **1 sistem penuh front end + back end**: pengunjung mengisi form di website portfolio → data tersimpan ke database → admin mengelola pesan lewat dashboard yang aman (prepared statement, XSS-safe), bisa di-join/di-filter/diurutkan, dan dilengkapi grafik ringkasan — online dan sudah melalui system testing.

---

## Ringkasan Peta Konsep per Pertemuan

| # | Topik Utama | Peserta bisa apa setelah ini? |
| --- | --- | --- |
| 1 | Activity Diagram | Memvisualisasikan alur proses sistem sebelum coding |
| 2 | Class Diagram | Merancang struktur tabel & relasi sebelum membuat database |
| 3 | Intro to Database | Setup Laragon, membuat database & tabel sesuai rancangan |
| 4 | Intro to PHP | Struktur file, variabel, operator, `$_POST`/`$_GET` |
| 5 | Branching | Logika kondisi (if/switch/nested) di PHP |
| 6 | Connection | Menghubungkan PHP–MySQL, INSERT data dengan aman (prepared statement) |
| 7 | Loop (konsep) | Pengulangan dasar (while/do-while/for/nested) |
| 8 | Array + SELECT | Menampilkan semua data dari database ke halaman web |
| 9 | ORDER BY | Mengurutkan data yang ditampilkan |
| 10 | DELETE & UPDATE | Menghapus & memperbarui data tanpa akses manual ke database |
| 11 | **Final Exam 1** | Sistem CRUD pesan lengkap & aman |
| 12 | Review Full Stack | Menghubungkan kembali seluruh materi front end + back end |
| 13 | Join | Menggabungkan data dari 2 tabel yang berelasi |
| 14 | Group By | Meringkas & mengelompokkan data |
| 15 | Dynamic Chart | Menyajikan data sebagai grafik interaktif |
| 16 | Filtering Data | Menggabungkan branching + join + chart jadi 1 fitur filter |
| 17 | Setup Server | Menyiapkan hosting untuk aplikasi PHP + MySQL |
| 18 | System Testing | Menguji sistem secara sistematis sebelum go-live |
| 19 | **Final Exam 2** | Sistem full-stack lengkap, aman, teruji, dan online |
