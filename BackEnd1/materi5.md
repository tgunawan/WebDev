# CRUD
Rangkuman Project Simple PHP CRUD & ORDER BY (Meet 5)
## Akan buat file
- barang.php
- File tambah_barang.php
- edit_barang.php
- hapus_barang.php

1. Struktur Project dan Database
Project ini terdiri dari 5 file PHP utama:
koneksi.php: Menghubungkan aplikasi ke database MySQL.
barang.php: Menampilkan daftar barang (Read) dengan fitur pengurutan (ORDER BY) serta navigasi ke Tambah, Edit, dan Hapus.
tambah_barang.php: Form untuk menambah data baru (Create / Add Data) menggunakan method POST dan SQL INSERT.
edit_barang.php: Form untuk mengubah data yang ada (Update) menggunakan method GET untuk mengambil ID, mengisi form, dan SQL UPDATE.
hapus_barang.php: File pemroses untuk menghapus data (Delete) berdasarkan ID dengan SQL DELETE.
Struktur Tabel Database (barang)
CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL
);

2. File koneksi.php

Penjelasan:
mysqli_connect() digunakan untuk membuka koneksi baru ke server MySQL.
Fungsi ini menerima parameter host, username, password, dan nama database.

3. File barang.php (Read & ORDER BY)

## Read Data & OREDER BY

- SELECT * FROM barang;
database akan menampilkan data sesuai urutan yang tersedia.
- Dengan ORDER BY, kita dapat menentukan urutannya.

+ ASC berarti Ascending, yaitu mengurutkan dari kecil ke besar atau A ke Z.
Contoh berdasarkan harga:
SELECT * FROM barang
ORDER BY harga ASC;

+ DESC berarti Descending, yaitu mengurutkan dari besar ke kecil atau Z ke A.
Contoh:
SELECT * FROM barang
ORDER BY harga DESC;

+ contoh:
ORDER BY dapat digunakan untuk berbagai kebutuhan:
- Barang termurah
SELECT * FROM barang
ORDER BY harga ASC;
- Barang termahal
SELECT * FROM barang
ORDER BY harga DESC;
- Stok paling banyak
SELECT * FROM barang
ORDER BY stok DESC;
- Stok paling sedikit
SELECT * FROM barang
ORDER BY stok ASC;
- Nama barang A-Z
SELECT * FROM barang
ORDER BY nama_barang ASC;


Penjelasan:
ORDER BY ASC: Mengurutkan data secara naik (kecil ke besar / A-Z).
ORDER BY DESC: Mengurutkan data secara turun (besar ke kecil / Z-A).
mysqli_fetch_assoc(): Mengambil tiap baris data dari hasil query dalam bentuk array asosiatif.

4. File tambah_barang.php (Add Data / Create)

## Add
Proses add data biasanya menggunakan:
- HTML Form untuk menerima input pengguna
- PHP untuk mengambil dan memproses input
- SQL INSERT untuk memasukkan data ke database
- MySQL sebagai tempat penyimpanan data

INSERT INTO barang (nama_barang, harga, stok)
VALUES ('Pensil', 3000, 20);

+ dari HTML
<form method="POST">
POST digunakan untuk mengirim data dari form ke server.

+ Maka PHP dapat mendeteksinya dengan:
<!-- isset($_POST["simpan"]) Program mengecek apakah tombol Simpan sudah ditekan.-->
<!-- $harga = $_POST["harga"]; ambil berdasarkan name pada input -->
<!-- dilanjutkan pakai querysql INSERT INTO -->
<!-- dan di kirim ke database, query sebelumnya -->
<!-- header("Location: barang.php"); mengarahkan ke halaman yang di tuju / kembali / redirect -->
<!--  Exit untuk menghentikan eksekusi skrip, memastikan PHP berhenti setelah melakukan redirect.  -->
if (isset($_POST["simpan"])) {  

    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $query = "INSERT INTO barang
              (nama_barang, harga, stok)
              VALUES
              ('$nama_barang', $harga, $stok)";

    mysqli_query($conn, $query);
    header("Location: barang.php");
    exit;

Penjelasan:
Method POST: Digunakan untuk mengirim data form secara aman ke server.
isset($_POST["simpan"]): Memeriksa apakah tombol simpan telah diklik.
SQL INSERT INTO: Menambahkan baris data baru ke tabel database.
header("Location: barang.php") & exit;: Mengarahkan kembali ke halaman utama dan menghentikan eksekusi skrip.

5. File edit_barang.php (Update Data)

## UPDATE 
digunakan untuk mengubah data yang sudah tersimpan di database.

UPDATE nama_table
SET column = value
WHERE kondisi;

+ ubah 1 kolom data
UPDATE barang
SET stok = 50
WHERE id_barang = 1;

+ Mengubah Beberapa Data Sekaligus
Kita dapat mengubah beberapa column sekaligus.
UPDATE barang
SET
    nama_barang = 'Indomie Goreng',
    harga = 4000,
    stok = 30
WHERE id_barang = 1;

+ jika tanpa WHERE  perubahan data terjadi untuk keseluruhan kolom

+ pada halaman baru untuk edit data, kita perlu mengirimkan ID
http://localhost/kasir/edit_barang.php?id=1
Bagian:
?id=1 digunakan untuk menentukan barang mana yang ingin diedit.

+ dari html
<button type="submit" name="update">
    Update
</button>

+ pada php
$id = $_GET["id"]; Mengambil ID dari URL
$query = "SELECT * FROM barang WHERE id_barang = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);


+ <?= ... ?>
Ini adalah singkatan dari:
<?php echo ...; ?>
<!-- isset($_POST["update"]) Program mengecek apakah tombol Update sudah ditekan.-->


Penjelasan:
$_GET["id"]: Mengambil nilai ID yang dikirim melalui parameter URL (misal: edit_barang.php?id=1).
Pre-filling Form: Parameter value="<?= $data['nama_barang']; ?>" mengisi form dengan data lama sebelum diedit.
Klausa WHERE pada UPDATE: Wajib digunakan agar hanya baris data dengan ID yang sesuai yang diperbarui, mencegah terubahnya seluruh data dalam tabel.

6. File hapus_barang.php (Delete Data)

## DELETE 
digunakan untuk menghapus data dari database.

Contoh:
- dengan WHERE Hapus barang yang memiliki id_barang tertentu.

DELETE FROM barang
WHERE id_barang = 1;

- tanpa WHERE semua data bisa terhapus

DELETE FROM barang;
karena query tersebut dapat menghapus seluruh data dalam table.

- onclick="return confirm('Yakin ingin menghapus data ini?')"

konfirmasi:
jika ok di jalankan 


Penjelasan:
SQL DELETE FROM: Menghapus data dari tabel.
Klausa WHERE pada DELETE: Wajib digunakan agar hanya data spesifik yang dihapus.
Konfirmasi JavaScript: Dipicu di halaman barang.php dengan onclick="return confirm('Yakin ingin menghapus data ini?')" untuk mengonfirmasi tindakan user sebelum mengarahkan ke hapus_barang.php.

7. Ringkasan Matriks Konsep CRUD
Komponen
Operasi CRUD
Method / Parameter
Query SQL Utama
Tambah Data
Create
POST
INSERT INTO barang (...) VALUES (...)
Tampil & Urutkan
Read
GET (sort)
SELECT * FROM barang ORDER BY ... ASC/DESC
Edit Data
Update
GET (id) & POST
UPDATE barang SET ... WHERE id_barang = $id
Hapus Data
Delete
GET (id)
DELETE FROM barang WHERE id_barang = $id


