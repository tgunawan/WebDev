# Connecting PHP and Database

- pastikan localhost / Laragon berjalan
- pastikan phpmyadmin bisa dibuka
- pastikan database sudah dibuat
- buat sebuah file connection.php

$host = "localhost";  <!-- hostname / localhost / Laragon / 127.876.675.000-->
$username = "root";  <!-- username / root / Laragon / -->
$password = "";     <!-- password / default laragon kosong-->
$database = "kasir";    <!-- database / nama database pada phpmyadmin yang sebelumnya di buat -->
$conn = di bawah ini cara untuk menyimpan seting koneksi php dan mysql
mysqli_connect = digunakan untuk membuat koneksi antara PHP dengan MySQL.
    - arti code koneksi di bawah =  PHP mencoba terhubung ke MySQL yang berada di localhost menggunakan user root, tanpa password, dan menggunakan database kasir.
if (!$conn) = mengecek apakah koneksi gagal.
die("Connection failed: " . mysqli_connect_error()); = akan menghentikan program dan menampilkan pesan error.



<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "kasir";
$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connected successfully";

?>

======================================================
## include dan require
Connecting PHP file
include dan require sama-sama digunakan untuk menyisipkan file PHP ke file lain.

1. include

Jika file tidak ditemukan, PHP hanya menampilkan warning dan program tetap berjalan.

Kapan menggunakan include?

Ketika file tersebut opsional.

Misalnya:

PHP
include "header.php";
include "sidebar.php";
``

Kalau gagal memuat sidebar, halaman utama masih bisa berjalan.

2. require

Jika file tidak ditemukan, PHP menampilkan fatal error dan program langsung berhenti.

Kapan menggunakan require?

Ketika file tersebut wajib ada.

Contoh untuk koneksi database:

PHP
require "koneksi.php";

Karena tanpa file koneksi, aplikasi tidak bisa bekerja.

=============================================================
Menggunakan require

Contoh index.php:
<?php

require "koneksi.php";

echo "Connection berhasil";

?>
Ketika index.php dijalankan, PHP akan mengambil kode dari:
koneksi.php

==================================================================
## Get data
<?php

require "koneksi.php";

$query = "SELECT * FROM barang";

$result = mysqli_query($conn, $query);

?>


### Memahami mysqli_query()
mysqli_query($conn, $query) = digunakan untuk menjalankan SQL melalui koneksi database.
$conn = adalah koneksi database.
$query = adalah perintah SQL yang akan dijalankan
    $query = "SELECT * FROM barang";
$result = mysqli_query($conn, $query); = Jalankan query, menggunakan koneksi $conn. Dan simpan hasilnya di variabel $result.

note: pelajari SQL lebih dalam 
====================================================================

## Array dan Looping pada PHP

### Array adalah variable yang dapat digunakan untuk menyimpan lebih dari satu data dalam satu variable.
    - dapat berbeda tipe data
    - Associative Array : key-value pair = seperti dictionary di python atau object di js
    - bisa memasukkan sebuah object 

- Akses Array
$barang = [
    "Indomie",
    "Teh Botol",
    "Roti Coklat"
];
echo $barang[0];

$barang = [
    "nama" => "Indomie",
    "harga" => 3500,
    "stok" => 20
];
echo $barang["nama"];


- Array dari Data Database
mysqli_fetch_assoc() = data dari database akan diambil dalam bentuk associative array.
    $data = mysqli_fetch_assoc($result);

PHP akan menghasilkan data yang secara konsep seperti:
    $data = [
        "id_barang" => 1,
        "nama_barang" => "Indomie",
        "harga" => 3500,
        "stok" => 20
    ];
Maka kita dapat mengambil nama barang dengan:
    echo $data["nama_barang"];

### Looping

Beberapa looping yang umum digunakan di PHP:
- while
- do while
- for
- foreach

Untuk memahami show data dari database, yang paling penting adalah while dan foreach.

1. while

while digunakan untuk menjalankan kode selama kondisi bernilai true.
Syntax:
while (condition) {
    // kode yang diulang
}
Contoh:
$i = 1;

while ($i <= 5) {
    echo $i;
    echo "<br>";

    $i++;
}


2. do while

do while hampir sama dengan while, tetapi terdapat perbedaan penting.
Pada while, kondisi diperiksa sebelum kode dijalankan.
Pada do while, kode dijalankan terlebih dahulu, kemudian kondisi diperiksa.
Karena do while menjalankan kode minimal satu kali sebelum mengecek kondisi.

Syntax:
do {
    // kode
} while (condition);
Contoh:
$i = 1;

do {
    echo $i;
    echo "<br>";

    $i++;
} while ($i <= 5);

3. for

for biasanya digunakan ketika jumlah perulangan sudah diketahui.
Syntax:
for (initialization; condition; increment) {
    // kode
}
Contoh:
for ($i = 1; $i <= 5; $i++) {
    echo $i;
    echo "<br>";
}


Looping
Kapan digunakan?
while
Ketika perulangan bergantung pada kondisi
do while
Ketika kode harus dijalankan minimal satu kali
for
Ketika jumlah perulangan sudah diketahui

4. foreach

Untuk array, PHP memiliki looping khusus bernama foreach.
Contoh:
$barang = [
    "Indomie",
    "Teh Botol",
    "Roti Coklat"
];

foreach ($barang as $nama) {
    echo $nama;
    echo "<br>";
}
Hasil:
Indomie
Teh Botol
Roti Coklat
foreach akan mengambil setiap data dalam array satu per satu.

foreach pada Associative Array
Misalnya:
$barang = [
    "nama" => "Indomie",
    "harga" => 3500,
    "stok" => 20
];
Kita bisa menggunakan:
foreach ($barang as $key => $value) {
    echo $key . " : " . $value;
    echo "<br>";
}
Hasil:
nama : Indomie
harga : 3500
stok : 20


### Koneksi Array dengan database

    $result = mysqli_query($conn, $query); 1 x ambil data

    while ($data = mysqli_fetch_assoc($result)) {

    echo $data["nama_barang"];
    echo "<br>";
    }

    pakai while agar mengulang ambil dari database
    dan kombine dengan HTML Tag
    




