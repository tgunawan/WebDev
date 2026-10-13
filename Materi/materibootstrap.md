Untuk cepat menguasai Bootstrap, jangan menghafal semua class. Fokus pada pola penggunaannya dulu.

=======================================================
1. Bootstrap itu dibagi menjadi beberapa kelompok besar
Layout

Mengatur posisi dan ukuran.

HTML
container
container-fluid
row
col

Contoh:

HTML
<div class="container">
<div class="row">
<div class="col">
Kiri
</div>
<div class="col">
Kanan
</div>
</div>
</div>

Ingat:

Plain Text
container
└─ row
└─ col
``

Hampir semua layout Bootstrap memakai pola ini.

Spacing

Mengatur margin dan padding.

HTML
m-3
p-3
mt-3
mb-3
ms-3
me-3
``

Contoh:

HTML
<div class="mt-4 p-3">
Konten
</div>

Arti:

Plain Text
m = margin
p = padding
 
t = top
b = bottom
s = start (kiri)
e = end (kanan)
 
0 - 5 = ukuran

Contoh:

HTML
mb-5
 
Content couldn't be displayed
Sorry, something went wrong. Please try again.

=

CSS
margin-bottom
``
Flexbox

Sangat sering digunakan.

HTML
d-flex
justify-content-center
align-items-center
``

Contoh:

HTML
<div class="d-flex justify-content-center">
<button>Login</button>
</div>

Cheat sheet:

Plain Text
d-flex
 
justify-content-center
justify-content-between
justify-content-end
 
align-items-center
align-items-start
align-items-end
Warna
HTML
bg-primary
bg-success
bg-danger
 
text-primary
text-danger
text-success
`

Contoh:

HTML
<div class="bg-primary text-white p-3">
Halo Bootstrap
</div>
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Button
HTML
btn
btn-primary
btn-success
btn-danger

Contoh:

HTML
<button class="btn btn-primary">
Simpan
</button>
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Form
HTML
form-control
form-label
form-select

Contoh:

HTML
<label class="form-label">
Nama
</label>
 
<input
type="text"
class="form-control"
>

Bootstrap form hampir selalu:

HTML
<form>
<div class="mb-3">
<label class="form-label">Nama</label>
<input class="form-control">
</div>
</form>

=======================================================
2. Cara Cepat Menentukan Class Yang Dipakai

Tanya sendiri:

Mau mengatur ukuran?
HTML
col
w-50
h-100
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Mau mengatur jarak?
HTML
m-3
p-3
mt-4
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Mau membuat posisi horizontal?
HTML
d-flex
justify-content-center
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Mau membuat posisi vertikal?
HTML
align-items-center
``
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Mau membuat warna?
HTML
bg-primary
text-danger
Content couldn't be displayed
Sorry, something went wrong. Please try again.
Mau membuat form?
HTML
form-control
``
Mau membuat tombol?
HTML
btn btn-primary

========================================================
3. Cara Menggunakan JavaScript Bootstrap

Tambahkan Bootstrap JS:

HTML
<script src="https://cdn.jsdelivrstrap@5.3.8/dist/js/bootstrap.bundle.min.jsscript>

Setelah itu komponen Bootstrap bisa digunakan.

Contoh Modal

HTML:

HTML
<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalku">
Buka Modal
</button>
 
<div class="modal fade" id="modalku">
<div class="modal-dialog">
<div class="modal-content">
 
<div class="modal-header">
<h5>Modal</h5>
</div>
 
<div class="modal-body">
Isi Modal
</div>
 
</div>
</div>
</div>

Tanpa JavaScript pun modal sudah bekerja karena memakai:

HTML
data-bs-toggle
data-bs-target
``
Mengontrol Modal dengan JavaScript
JavaScript
const modal =
new bootstrap.Modal(
document.getElementById("modalku")
);
 
modal.show();

Menutup:

JavaScript
modal.hide();
Contoh Collapse

HTML:

HTML
<button
class="btn btn-primary"
data-bs-toggle="collapse"
data-bs-target="#detail">
Detail
</button>
 
<div id="detail" class="collapse">
Isi Detail
</div>

Bootstrap JS otomatis menjalankan animasinya.

4. Cara Belajar Bootstrap Paling Cepat

Fokus hafal 15 class ini dulu:

Plain Text
container
row
col
 
d-flex
 
justify-content-center
justify-content-between
 
align-items-center
 
m-3
p-3
mb-3
 
btn
btn-primary
 
form-control
form-label
 
bg-primary
text-white

Dengan 15 class tersebut Anda sudah bisa membuat:

Landing page
Login form
Dashboard sederhana
CRUD sederhana
Form pendaftaran
Portofolio pribadi

sekitar 70-80% kebutuhan Bootstrap sehari-hari.

Dari tab yang sedang terbuka, saya lihat Anda sedang mempelajari Bootstrap Grid. Saran saya fokus urutan belajar berikut:

Plain Text
1. Container
2. Row
3. Col

4. Flexbox (d-flex)
5. Spacing (m, p)

6. Form
7. Button
8. Card
9. Modal
10. Navbar

Kalau sudah menguasai 10 topik itu, Anda akan bisa membaca hampir semua template Bootstrap dan cepat tahu class mana yang harus dipakai.




// =====================================================================
// =====================================================================

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- konten -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


Grid System Bootstrap (mirip konsep CSS Grid, tapi dengan class siap pakai)

<div class="container">
    <div class="row">
        <div class="col-md-4">Kolom 1</div>
        <div class="col-md-4">Kolom 2</div>
        <div class="col-md-4">Kolom 3</div>
    </div>
</div>


Navbar Bootstrap

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Budi Santoso</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="#project">Project</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>


Card Bootstrap (pengganti flip-card manual, opsional dikombinasikan)

<div class="card" style="width: 18rem;">
    <img src="assets/images/project1.jpg" class="card-img-top" alt="Landing Page">
    <div class="card-body">
        <h5 class="card-title">Landing Page</h5>
        <p class="card-text">Dibuat dengan HTML & CSS Flexbox.</p>
    </div>
</div>


<form>
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="inputNama">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail">
    </div>
    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
</form>


