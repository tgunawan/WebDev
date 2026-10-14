# UML

Dalam Web Development, UML adalah singkatan dari Unified Modeling Language.

UML digunakan untuk merancang dan memvisualisasikan sistem sebelum coding dimulai. Bisa dianggap sebagai "blueprint" atau "gambar kerja" sebuah aplikasi web.

 1. Use Case Diagram

Menjelaskan siapa yang menggunakan sistem dan apa yang bisa dilakukan.

Contoh website perpustakaan:


+----------------+
| Admin         |
+----------------+
|               |
|               |
Tambah Buku Hapus Buku
 
+----------------+
| Member           |
+----------------+
        |
Pinjam Buku


Pertanyaan yang dijawab:

Siapa penggunanya?
Apa yang bisa dilakukan pengguna?

 2. Activity Diagram

Menjelaskan alur proses.

Contoh Login:

Plain Text
Start
|
Input Username & Password
|
Valid?
/ \
Ya Tidak
|       |
Masuk Error
|       |
End     End

Mirip flowchart.

 3. Sequence Diagram

Menjelaskan urutan komunikasi antar objek.

Contoh login:

Plain Text
User -> Login Page
Login Page -> Server
Server -> Database
Database -> Server
Server -> Login Page
Login Page -> User

Digunakan untuk melihat urutan proses dari awal sampai akhir.

 4. Class Diagram

Paling sering dipakai saat belajar OOP.

Contoh sistem perpustakaan:

Plain Text
+----------------+
| Book |
+----------------+
| title:String |
| year:Int |
+----------------+
| showBook() |
+----------------+

## Activity Diagram 
    Diagram UML yang menggambarkan alur kerja/proses dalam sistem — mirip flowchart, tapi dengan notasi standar:

uml adalah 
Simbol                           | 	Arti
● (bulat hitam)                  |	Start / titik mulai
⬤ dalam lingkaran(bullseye)     |	End / titik akhir
▭ (persegi ujung bulat)	        |   Activity / aktivitas
◇ (belah ketupat)	            |   Decision / percabangan kondisi
▬ (garis tebal horizontal)	     |   Fork/Join — proses paralel
→	                             |   Alur/arah proses

Rules to Create Activity Diagram

1. Selalu mulai dari 1 titik start dan boleh berakhir di lebih dari 1 titik end.
2. Setiap decision (◇) wajib punya minimal 2 output dengan guard condition yang jelas.
3. Gunakan swimlane jika melibatkan lebih dari 1 aktor (pengunjung vs sistem/admin).
4. Urutan proses harus logis — tidak boleh ada aktivitas yang "menggantung" tanpa alur masuk/keluar.


Challenge 1 — New Case Study
Peserta membuat Activity Diagram untuk alur Admin mengelola pesan (login admin → lihat daftar pesan → pilih pesan → ubah status/hapus → sistem update database → tampilan diperbarui).

Challenge 2 — Create UI Design
Peserta membuat wireframe/sketsa tampilan (boleh pakai Figma, Excalidraw, atau kertas) untuk halaman admin yang nanti akan diisi data sungguhan dari database: tabel daftar pesan, tombol filter, tombol urutkan, tombol hapus/ubah status.

Target: peserta bisa memvisualisasikan alur sistem sebelum menulis kode apa pun — kebiasaan penting sebelum membangun sistem sungguhan.


## Class Diagram

Class Diagram menggambarkan struktur data (bukan alur proses seperti Activity Diagram). Setiap "class" nantinya akan menjadi 1 tabel di database.

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
Advanced Model Components — Relasi antar Class

Association (garis biasa ——) — dua class saling terhubung.
One-to-Many (1 — *) — 1 kategori bisa dipakai banyak pesan.
Rules to Create Class

Nama class ditulis singular & PascalCase secara konsep (Pesan, bukan pesan-pesan atau Pesans) — walau nama tabel di database biasanya ditulis lowercase.
Atribut wajib punya tipe data.
Tanda - (private) untuk atribut yang hanya diakses lewat method, + (public) untuk yang bisa diakses bebas.
Unique Value (Primary Key)

Setiap tabel wajib punya Primary Key — kolom unik yang tidak boleh sama antar baris, biasanya id dengan AUTO_INCREMENT. Primary Key inilah yang dipakai tabel lain untuk membuat relasi (Foreign Key).

🎯 Studi Kasus: Class Diagram "Pesan" & "Kategori"
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
Penjelasan relasi: 1 kategori bisa dimiliki oleh banyak pesan (One-to-Many) — misalnya kategori "Landing Page" bisa muncul di banyak baris pesan yang berbeda.

Challenge 2 — New Case Study
Peserta membuat Class Diagram untuk kasus lain, misalnya "Sistem Perpustakaan" (Buku dan Peminjam) atau "Sistem Toko" (Produk dan Kategori Produk) — untuk melatih pemahaman relasi One-to-Many di konteks berbeda.

Catatan pengajar: di pertemuan berikutnya (Intro to Database), Class Diagram di atas akan langsung diimplementasikan menjadi tabel kategori dan pesan yang sungguhan di MySQL — jadi pastikan peserta benar-benar memahami diagram ini sebelum lanjut.

Target: peserta memahami pentingnya merancang struktur data & relasi SEBELUM membuat tabel database, serta paham konsep Primary Key.