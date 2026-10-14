# Laragon

Setelah install jalankan dan buka broser:
1. http://localhost/ untuk cek apakah Laragon terinstall
2. http://localhost/phpmyadmin untuk akses php myadmin atau masuk lewat menu tools PHP MyAdmin

Untuk Laragon, default phpMyAdmin biasanya:

Default Login MySQL/MariaDB Laragon
Plain Text
Username : root
Password : (kosong)

## Data base

Create Database and Table

Lewat phpMyAdmin:

Klik New di sidebar kiri → beri nama database: portfolio_db → Create.
Pilih database portfolio_db → tab SQL → jalankan query berikut untuk membuat tabel sesuai Class Diagram pertemuan 2:
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
Penjelasan tiap bagian:

AUTO_INCREMENT PRIMARY KEY — id otomatis bertambah & unik (implementasi dari "Unique Value" pertemuan 2).
NOT NULL — kolom wajib diisi, tidak boleh kosong.
ENUM('baru','dibaca') — kolom hanya boleh berisi salah satu dari 2 nilai ini.
DEFAULT CURRENT_TIMESTAMP — otomatis terisi waktu saat data dimasukkan.
FOREIGN KEY (kategori_id) REFERENCES kategori(id) — inilah relasi One-to-Many dari Class Diagram diimplementasikan secara nyata.

Memecah Arti utf8mb4_0900_ai_ci
utf8mb4

Character set yang digunakan.

Mendukung:

Huruf latin
Bahasa Indonesia
Arab
Jepang
China
Emoji 😀

0900 - Menggunakan aturan Unicode versi 9.0.
Accent Insensitive
Case Insensitive

beberapa collation yang sering di pakai
1. utf8mb4_0900_ai_ci
Paling umum untuk MySQL 8.

✅ Cocok untuk:
Website
Laravel
PHP Native
WordPress


2. utf8mb4_unicode_ci
Versi lama tetapi sangat kompatibel.

✅ Cocok untuk:
Hosting lama
XAMPP
Laragon dengan MySQL lama


3. utf8mb4_general_ci
Lebih cepat sedikit tetapi aturan bahasa kurang akurat.

✅ Untuk project kecil.

===============================================================

Saat buat database untuk versi baru primary key biasanya tidak perlu pakai length

setelah selesai di buat insert data dummy

Mengenal Tipe Data
Beberapa tipe data yang sering digunakan dalam database:
|Tipe Data   | Fungsi | Contoh |
|------------|--------|------- |
|INT    | Bilangan bulat| 100 |
|VARCHAR | Teks | "Indomie" |
|TEXT | Teks panjang | Deskripsi barang |
|DATE |Tanggal | 2026-09-16 |
|DATETIME | Tanggal + waktu | 2026-09-16 17:00:00 |
|DECIMAL |Angka desimal | 15000.50 |
|BOOLEAN |True/False | 1 / 0 |




