# Lesson Plan Lengkap: Web Development Front End

### HTML • CSS • JavaScript • Bootstrap — Progressive Portfolio Project

---

## Tentang Lesson Plan Ini

Lesson plan ini disusun berdasarkan silabus **"Welcome to Web Development"** yang mencakup dua part besar:

- **Part 1** — Fondasi HTML & CSS (8 pertemuan)
- **Part 2** — JavaScript & Bootstrap (11 pertemuan)

Total **19 pertemuan**, ditutup dengan Final Exam di setiap part.

**Prinsip utama lesson plan ini: satu proyek yang tumbuh setiap pertemuan.** Setiap peserta akan membangun **1 website portofolio pribadi** yang sama dari pertemuan 1 sampai pertemuan 19. Di setiap pertemuan, mereka menambahkan 1-2 fitur baru ke website yang sama — bukan membuat proyek baru dari nol setiap kali. Ini membuat peserta benar-benar merasakan progres, dan di akhir kelas mereka punya portofolio nyata yang bisa dipakai melamar kerja/magang.

**Konsep tambahan yang saya masukkan** (tidak ada di tabel asli, tapi penting agar alur belajar tidak bolong):

- Git & GitHub basic workflow (add, commit, push) sebelum "Connecting GitHub with Vercel" — karena di tabel ada "Connecting GitHub with Vercel" tapi belum ada dasar Git-nya.
- Semantic HTML tags (`header`, `nav`, `main`, `section`, `footer`) — supaya struktur HTML tidak hanya `div` semua.
- CSS Box Model (margin, border, padding, width/height) — prasyarat wajib sebelum Flexbox/Grid, ditambahkan di pertemuan Layout.
- `console.log()` dan DevTools Console — dasar debugging sebelum masuk DOM.
- Array method dasar (`.push`, `.forEach`, `.map`) — pelengkap alami dari "Intro to Array".
- Form validation dasar dengan JavaScript (melengkapi "DOM Form" agar terasa fungsinya).
- Sedikit pengantar `localStorage` di pertemuan Event Handler (opsional/bonus) — agar data form contact tidak hilang saat refresh, sekaligus latihan event yang terasa nyata.

---

## Gambaran Proyek Progresif: "Portfolio Pribadi"

| Fase | Pertemuan | Yang ditambahkan ke proyek |
| --- | --- | --- |
| Fondasi | 1 | Struktur HTML dasar: bio, heading, paragraf |
| Fondasi | 2 | Styling CSS dasar: warna, font, alignment |
| Fondasi | 3 | Section "Skills" (list) & "Experience" (ordered list) |
| Fondasi | 4 | Tombol CTA, form kontak versi statis (radio/checkbox/select) |
| Fondasi | 5 | Foto profil, galeri project (images), audio player |
| Fondasi | 6 | Navbar dengan Flexbox, galeri dengan Grid |
| Fondasi | 7 | Membuat semua di atas responsive (mobile-first) |
| Fondasi | 8 | **Final Exam Part 1**: portfolio statis lengkap & rapi |
| Interaktif | 9 | Efek hover zoom di project card, flip card, halaman redirect |
| Interaktif | 10 | Variabel & tipe data untuk menyimpan info pribadi |
| Interaktif | 11 | Navbar aktif otomatis, smooth scroll, teks sapaan dinamis |
| Interaktif | 12 | Validasi form kontak dengan if/else |
| Interaktif | 13 | Generate skill bar / testimonial secara otomatis dengan loop |
| Interaktif | 14 | Data project disimpan di Array, di-render otomatis dengan loop |
| Interaktif | 15 | Form kontak: validasi field kosong |
| Interaktif | 16 | Refactor semua logic jadi function yang rapi & reusable |
| Interaktif | 17 | Event handler: klik, submit, filter project by kategori |
| Interaktif | 18 | Rebuild layout pakai Bootstrap (grid, navbar, card, form) |
| Interaktif | 19 | **Final Exam Part 2**: portfolio interaktif, responsive, deploy ke Vercel |

---

# PART 1 — FONDASI HTML & CSS

## Pertemuan 1 — Basic Equipment & Intro to HTML

### Tujuan Belajar

1. Memahami struktur file dalam satu project website.
2. Memahami pentingnya penempatan file yang konsisten dan terstruktur.
3. Memahami format dokumen (HTML) yang dipakai selama kelas.
4. Memahami struktur dasar HTML dan elemen-elemen teks dasar.

### A. Basic Equipment (Persiapan)

**1. Install & Setup Visual Studio Code**

- Download di [code.visualstudio.com](https://code.visualstudio.com/)
- Install extension **"Open in Browser"** atau **Live Server** (di silabus disebut TechER — gunakan Live Server sebagai pengganti umum jika TechER tidak tersedia) supaya file HTML bisa dibuka otomatis di browser dan auto-reload setiap disimpan.
- Set default browser (misal Chrome) supaya file HTML selalu terbuka di browser yang sama.

**2. File Structure — struktur folder project**

Struktur folder adalah hal pertama yang harus rapi sebelum menulis kode:

```
portfolio-project/
├── index.html          <- halaman utama
├── css/
│   └── style.css       <- semua styling
├── js/
│   └── script.js       <- semua logic JavaScript (dipakai mulai Part 2)
├── assets/
│   ├── images/         <- semua foto & gambar
│   └── audio/          <- file audio (jika ada)
└── README.md           <- deskripsi singkat project
```

> **Kenapa penting?** Kalau semua file (html, css, gambar) dicampur jadi satu folder tanpa struktur, project akan sangat sulit dikelola begitu jumlah file bertambah. Kebiasaan menata folder sejak awal = kebiasaan developer profesional.

**3. Git & GitHub — dasar version control** *(konsep tambahan, prasyarat sebelum connect ke Vercel)*

```
# di dalam folder project, jalankan sekali:
git init
git add .
git commit -m "Initial commit: struktur project portfolio"

# hubungkan ke repository GitHub yang sudah dibuat di github.com
git remote add origin https://github.com/username/portfolio-project.git
git branch -M main
git push -u origin main
```

**4. Connecting Visual Studio Code with GitHub**

- Install extension **GitHub Pull Requests and Issues** atau gunakan tab **Source Control** bawaan VS Code (ikon garpu di sidebar kiri).
- Login ke akun GitHub lewat VS Code (`Sign in to GitHub` di Source Control panel).
- Setiap perubahan file akan muncul di tab Source Control → tinggal klik `+` (stage) → tulis pesan commit → klik centang (commit) → `Sync Changes` (push).

**5. Connecting GitHub with Vercel**

- Buka [vercel.com](https://vercel.com/) → Sign up/login pakai akun GitHub.
- Klik **Add New → Project** → pilih repository `portfolio-project`.
- Klik **Deploy** — Vercel otomatis mendeteksi ini static HTML dan langsung online dalam hitungan detik.
- Setiap kali kamu `git push`, Vercel otomatis re-deploy versi terbaru (auto CI/CD).

### B. Intro to HTML

**Main Structure (tag html, head, body)**

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Saya</title>
</head>
<body>

    <!-- Semua konten yang tampil di layar ditulis di dalam body -->

</body>
</html>
```

Penjelasan:

- `<!DOCTYPE html>` — memberitahu browser bahwa ini dokumen HTML5.
- `<html>` — elemen pembungkus seluruh halaman.
- `<head>` — berisi metadata (judul tab, charset, link CSS) — **tidak tampil di layar** .
- `<body>` — berisi semua konten yang **tampil di layar** .
- `<meta charset="UTF-8">` — supaya karakter khusus (é, —, emoji) tampil dengan benar.
- `<meta name="viewport"...>` — wajib untuk membuat halaman responsive di HP (dipakai lagi di pertemuan 7).

**Comment Tag**

```
<!-- Ini adalah komentar, tidak akan tampil di browser -->
<!-- Gunakan untuk memberi catatan pada kode, atau menonaktifkan sementara sebuah elemen -->
```

**HTML Tag for Basic Text (`<h1>`–`<h6>`, `<p>`)**

```
<h1>Nama Lengkap Kamu</h1>
<h2>Front End Web Developer</h2>
<p>
    Saya adalah seorang calon web developer yang sedang belajar
    membangun website dari HTML, CSS, hingga JavaScript.
</p>
<h3>Tentang Saya</h3>
<p>Detail cerita singkat tentang dirimu di sini.</p>
```

- `<h1>` adalah heading terbesar/terpenting (idealnya hanya 1 per halaman), `<h6>` terkecil.
- `<p>` adalah paragraf teks biasa.

**HTML Tag Formatting Elements**

```
<p><strong>Teks tebal (bold)</strong> untuk penekanan penting.</p>
<p><em>Teks miring (italic)</em> untuk penekanan halus.</p>
<p>Baris pertama<br>Baris kedua setelah line break</p>
<hr>
<p>Ini <mark>teks yang di-highlight</mark>.</p>
<p><small>Teks kecil, biasanya untuk disclaimer.</small></p>
```

**HTML Style (Color, Font, Alignment) — inline style**

```
<h1 style="color: darkblue; text-align: center;">Nama Lengkap Kamu</h1>
<p style="font-family: Arial, sans-serif; color: gray;">
    Front End Web Developer
</p>
```

> **Catatan penting untuk peserta:** inline style (`style="..."` langsung di tag) memang bisa dipakai, tapi **tidak direkomendasikan** untuk project sungguhan karena bercampur dengan struktur HTML dan susah di-maintain. Ini hanya latihan awal — mulai pertemuan 2 kita pindah ke CSS file terpisah.

### 🎯 Proyek Pertemuan 1: `index.html` versi awal

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Saya</title>
</head>
<body>
    <h1 style="text-align: center;">Budi Santoso</h1>
    <p style="text-align: center;"><em>Front End Web Developer</em></p>

    <hr>

    <h2>Tentang Saya</h2>
    <p>
        Halo! Saya Budi, seorang pemula yang sedang belajar web development.
        Saya tertarik membangun website yang <strong>rapi</strong> dan
        <strong>fungsional</strong>.
    </p>

    <h2>Kontak</h2>
    <p>Email: budi@example.com<br>Instagram: @budisantoso</p>
</body>
</html>
```

**Target:** peserta bisa membuka file ini di browser lewat Live Server, dan sudah paham kenapa file disusun dengan struktur folder di atas.

---

## Pertemuan 2 — Intro to CSS

### Tujuan Belajar

1. Mengenal struktur dan penerapan perintah CSS.
2. Mampu mengkombinasikan CSS dengan HTML.
3. Menciptakan halaman website yang lebih menarik.

### Materi

**CSS Model File (Internal vs External)**

```
<!-- 1. Internal CSS — ditulis di dalam <style> pada head -->
<head>
    <style>
        h1 { color: darkblue; }
    </style>
</head>
```

```
<!-- 2. External CSS — file terpisah, dipanggil lewat <link> (INI YANG DIPAKAI SELAMA KELAS) -->
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
```

> **Kenapa external CSS lebih disarankan?** Karena HTML (struktur) dan CSS (tampilan) jadi terpisah rapi, file CSS bisa dipakai ulang di banyak halaman HTML, dan lebih mudah di-maintain.

**Comment Line**

```
/* Ini adalah komentar di CSS */
/* Section: Header */
```

**Unique Identity (class vs id)**

```
/* id -> untuk 1 elemen unik saja, ditulis dengan # */
#main-title {
    color: navy;
}

/* class -> bisa dipakai berkali-kali untuk banyak elemen, ditulis dengan . */
.section-title {
    color: darkslategray;
    text-decoration: underline;
}
```

```
<h1 id="main-title">Budi Santoso</h1>
<h2 class="section-title">Tentang Saya</h2>
<h2 class="section-title">Kontak</h2>
```

Aturan sederhana: **`id` = satu-satunya di halaman itu, `class` = boleh dipakai berulang**.

### 🎯 Proyek Pertemuan 2: `css/style.css` + update `index.html`

`css/style.css`:

```
/* ===== Global Style ===== */
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f6f8;
    color: #2b2b2b;
    margin: 0;
    padding: 40px 20px;
}

/* ===== Header ===== */
#main-title {
    text-align: center;
    color: #1c3d5a;
    margin-bottom: 4px;
}

.subtitle {
    text-align: center;
    color: #5a5a5a;
    font-style: italic;
}

/* ===== Section Titles ===== */
.section-title {
    color: #1c3d5a;
    border-bottom: 2px solid #1c3d5a;
    padding-bottom: 4px;
}
```

`index.html` (bagian head & sedikit body diubah):

```
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Saya</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1 id="main-title">Budi Santoso</h1>
    <p class="subtitle">Front End Web Developer</p>

    <hr>

    <h2 class="section-title">Tentang Saya</h2>
    <p>
        Halo! Saya Budi, seorang pemula yang sedang belajar web development.
    </p>

    <h2 class="section-title">Kontak</h2>
    <p>Email: budi@example.com<br>Instagram: @budisantoso</p>
</body>
```

**Target:** peserta paham perbedaan `class` vs `id`, dan portfolio sudah punya tampilan warna/font yang konsisten lewat file CSS terpisah.

---

## Pertemuan 3 — List (HTML x CSS)

### Tujuan Belajar

1. Mengenal berbagai macam model list.
2. Mampu menghias list dengan CSS.

### Materi

**Unordered List**

```
<ul>
    <li>HTML</li>
    <li>CSS</li>
    <li>JavaScript</li>
</ul>
```

**Ordered List**

```
<ol>
    <li>Belajar HTML dasar</li>
    <li>Belajar CSS</li>
    <li>Belajar JavaScript</li>
</ol>
```

**Other List — Description List** *(pelengkap: dl/dt/dd)*

```
<dl>
    <dt>HTML</dt>
    <dd>Bahasa untuk membangun struktur halaman web.</dd>
    <dt>CSS</dt>
    <dd>Bahasa untuk mengatur tampilan halaman web.</dd>
</dl>
```

**Styling List dengan CSS**

```
.skill-list {
    list-style-type: square;   /* disc, circle, square, none */
    padding-left: 20px;
}
.skill-list li {
    margin-bottom: 6px;
    color: #333;
}

.timeline {
    list-style: none;          /* hilangkan bullet default */
    padding-left: 0;
    border-left: 3px solid #1c3d5a;
}
.timeline li {
    padding: 8px 16px;
    margin-bottom: 8px;
}
```

### 🎯 Proyek Pertemuan 3: tambah section "Skills" & "Experience"

Tambahkan di `index.html` (sebelum bagian Kontak):

```
<h2 class="section-title">Skills</h2>
<ul class="skill-list">
    <li>HTML5</li>
    <li>CSS3</li>
    <li>JavaScript (basic)</li>
    <li>Git & GitHub</li>
</ul>

<h2 class="section-title">Pengalaman</h2>
<ol class="timeline">
    <li>2023 — Mengikuti bootcamp Web Development</li>
    <li>2024 — Membuat 3 project portfolio pribadi</li>
    <li>2024 — Magang sebagai Front End Developer</li>
</ol>
```

**Target:** portfolio sudah punya section Skills & Experience yang tampil rapi dengan bullet/nomor custom.

---

## Pertemuan 4 — Button Style (HTML x CSS)

### Tujuan Belajar

1. Mengenal berbagai model tombol/button dan implementasinya.
2. Mampu membuat komponen website yang menarik dengan HTML & CSS.

### Materi

**Basic Button**

```
<button class="btn-primary">Hire Me</button>
<a href="#kontak" class="btn-primary">Hubungi Saya</a>
```

**Radio Button** (memilih 1 dari beberapa opsi)

```
<p>Metode kontak yang diinginkan:</p>
<label><input type="radio" name="contact" value="email" checked> Email</label>
<label><input type="radio" name="contact" value="wa"> WhatsApp</label>
<label><input type="radio" name="contact" value="ig"> Instagram</label>
```

**Check Button (Checkbox)** (memilih lebih dari 1 opsi)

```
<p>Jenis project yang saya minati:</p>
<label><input type="checkbox" name="interest" value="landing"> Landing Page</label>
<label><input type="checkbox" name="interest" value="ecommerce"> E-Commerce</label>
<label><input type="checkbox" name="interest" value="dashboard"> Dashboard</label>
```

**Select Button (Dropdown)**

```
<label for="topik">Topik favorit:</label>
<select id="topik" name="topik">
    <option value="html">HTML</option>
    <option value="css">CSS</option>
    <option value="js">JavaScript</option>
</select>
```

**Styling Button dengan CSS**

```
.btn-primary {
    display: inline-block;
    background-color: #1c3d5a;
    color: #ffffff;
    padding: 10px 24px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}
.btn-primary:hover {
    background-color: #2f5d84;
}

input[type="radio"], input[type="checkbox"] {
    margin-right: 6px;
}

select {
    padding: 6px 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}
```

### 🎯 Proyek Pertemuan 4: tambah section "Hubungi Saya" (form statis)

```
<h2 class="section-title" id="kontak">Hubungi Saya</h2>
<form>
    <p>Metode kontak yang diinginkan:</p>
    <label><input type="radio" name="contact" value="email" checked> Email</label>
    <label><input type="radio" name="contact" value="wa"> WhatsApp</label>

    <p>Jenis project yang saya minati:</p>
    <label><input type="checkbox" name="interest" value="landing"> Landing Page</label>
    <label><input type="checkbox" name="interest" value="ecommerce"> E-Commerce</label>

    <p>
        <label for="topik">Topik favorit:</label>
        <select id="topik" name="topik">
            <option value="html">HTML</option>
            <option value="css">CSS</option>
            <option value="js">JavaScript</option>
        </select>
    </p>

    <button type="button" class="btn-primary">Kirim Pesan</button>
</form>
```

**Target:** peserta bisa membuat & menata radio, checkbox, select, dan tombol CTA yang menarik secara visual.

---

## Pertemuan 5 — Media (HTML x CSS)

### Tujuan Belajar

1. Mengenal implementasi media pada website.

### Materi

**Images**

```
<img src="assets/images/profile.jpg" alt="Foto profil Budi Santoso" class="profile-photo">
```

```
.profile-photo {
    width: 160px;
    height: 160px;
    object-fit: cover;      /* foto tidak gepeng walau ukuran dipaksa */
    border-radius: 50%;     /* foto profil bulat */
    display: block;
    margin: 0 auto 20px auto;
}
```

**Audio**

```
<audio controls>
    <source src="assets/audio/intro.mp3" type="audio/mpeg">
    Browser kamu tidak mendukung audio player.
</audio>
```

### 🎯 Proyek Pertemuan 5: tambah foto profil & galeri project

```
<img src="assets/images/profile.jpg" alt="Foto Budi Santoso" class="profile-photo">
<h1 id="main-title">Budi Santoso</h1>
<p class="subtitle">Front End Web Developer</p>

<h2 class="section-title">Project Saya</h2>
<div class="gallery">
    <img src="assets/images/project1.jpg" alt="Project Landing Page" class="gallery-img">
    <img src="assets/images/project2.jpg" alt="Project E-Commerce" class="gallery-img">
    <img src="assets/images/project3.jpg" alt="Project Dashboard" class="gallery-img">
</div>

<h2 class="section-title">Perkenalan Singkat (Audio)</h2>
<audio controls>
    <source src="assets/audio/intro.mp3" type="audio/mpeg">
    Browser kamu tidak mendukung audio player.
</audio>
```

```
.gallery-img {
    width: 200px;
    height: 140px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 10px;
}
```

**Target:** portfolio punya foto profil bulat, galeri project, dan audio player.

---

## Pertemuan 6 — Layout (HTML x CSS): Flexbox & Grid

### Tujuan Belajar

1. Memahami pentingnya layout pada website.
2. Memiliki website yang terstruktur.

### Materi Tambahan (prasyarat): CSS Box Model & Semantic HTML

Sebelum flexbox/grid, peserta wajib paham **box model** — setiap elemen HTML adalah kotak dengan 4 lapisan:

```
margin (jarak ke elemen lain)
  └── border (garis tepi)
        └── padding (jarak ke isi)
              └── content (isi elemen)
```

```
.card {
    width: 200px;
    padding: 16px;     /* jarak dalam */
    border: 1px solid #ccc;
    margin: 12px;      /* jarak luar */
}
```

Gunakan **semantic tag** agar struktur HTML bermakna (bukan `<div>` semua):

```
<header>...</header>
<nav>...</nav>
<main>
    <section id="tentang">...</section>
    <section id="skills">...</section>
</main>
<footer>...</footer>
```

### Flexbox (untuk layout 1 dimensi — navbar, baris/kolom sejajar)

```
.navbar {
    display: flex;
    justify-content: space-between; /* sebar kiri-kanan */
    align-items: center;            /* rata tengah vertikal */
    background-color: #1c3d5a;
    padding: 12px 24px;
}
.navbar ul {
    display: flex;
    gap: 20px;
    list-style: none;
}
.navbar a {
    color: white;
    text-decoration: none;
}
```

### Grid (untuk layout 2 dimensi — galeri, kartu project)

```
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 kolom sama lebar */
    gap: 16px;
}
.gallery-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 8px;
}
```

### 🎯 Proyek Pertemuan 6: restrukturisasi portfolio dengan semantic tag + flexbox navbar + grid gallery

```
<body>
    <header class="navbar">
        <span class="logo">Budi Santoso</span>
        <nav>
            <ul>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#project">Project</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="tentang">
            <img src="assets/images/profile.jpg" alt="Foto Budi Santoso" class="profile-photo">
            <h1 id="main-title">Budi Santoso</h1>
            <p class="subtitle">Front End Web Developer</p>
        </section>

        <section id="skills">
            <h2 class="section-title">Skills</h2>
            <ul class="skill-list">
                <li>HTML5</li><li>CSS3</li><li>JavaScript (basic)</li><li>Git & GitHub</li>
            </ul>
        </section>

        <section id="project">
            <h2 class="section-title">Project Saya</h2>
            <div class="gallery">
                <img src="assets/images/project1.jpg" alt="Landing Page" class="gallery-img">
                <img src="assets/images/project2.jpg" alt="E-Commerce" class="gallery-img">
                <img src="assets/images/project3.jpg" alt="Dashboard" class="gallery-img">
            </div>
        </section>

        <section id="kontak">
            <h2 class="section-title">Hubungi Saya</h2>
            <!-- form dari pertemuan 4 -->
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Budi Santoso. Dibuat dengan HTML, CSS.</p>
    </footer>
</body>
```

**Target:** portfolio kini punya navbar flexbox yang rapi, galeri grid 3 kolom, dan struktur semantic yang jelas (header/nav/main/section/footer).

---

## Pertemuan 7 — HTML Responsive Website

### Tujuan Belajar

1. Mengimplementasikan website yang responsive di berbagai ukuran layar.

### Materi: Media Query

```
/* Default: tampilan desktop */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
.navbar ul {
    display: flex;
    gap: 20px;
}

/* Tablet: layar <= 768px */
@media (max-width: 768px) {
    .gallery {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile: layar <= 480px */
@media (max-width: 480px) {
    .gallery {
        grid-template-columns: 1fr; /* 1 kolom */
    }
    .navbar {
        flex-direction: column;    /* logo & menu ditumpuk */
        align-items: flex-start;
    }
    .navbar ul {
        flex-direction: column;
        gap: 10px;
    }
}
```

Prinsip **mobile-first** (opsional tapi disarankan untuk dijelaskan): tulis CSS dasar untuk mobile dulu, lalu tambahkan `min-width` untuk layar lebih besar. Untuk kelas ini, pendekatan desktop-first di atas sudah cukup dan lebih mudah dipahami pemula.

### 🎯 Proyek Pertemuan 7: tambahkan media query ke `style.css`

Tambahkan blok `@media` di atas ke file `css/style.css` yang sudah ada. Uji dengan **DevTools → Toggle Device Toolbar** (Ctrl+Shift+M di Chrome) untuk melihat tampilan di berbagai ukuran layar.

**Target:** portfolio tampil rapi baik di desktop, tablet, maupun HP.

---

## Pertemuan 8 — Final Exam Part 1: Free Project (Review + Challenge)

### Tujuan Belajar

Memiliki satu prototipe website yang siap dikembangkan lebih lanjut.

### Aktivitas

1. Review seluruh materi Part 1 (HTML dasar → CSS → List → Button → Media → Layout → Responsive).
2. **Challenge** : peserta merapikan & melengkapi portfolio pribadi masing-masing secara mandiri, lalu deploy ke Vercel.

### Checklist Final Exam Part 1

- [ ] Struktur folder rapi (`index.html`, `css/`, `assets/`)
- [ ] HTML memakai semantic tag (`header`, `nav`, `main`, `section`, `footer`)
- [ ] CSS eksternal (bukan inline style)
- [ ] Ada minimal: 1 heading utama, section Tentang, Skills (list), Project (gallery/grid), Kontak (form + button)
- [ ] Layout memakai Flexbox dan/atau Grid
- [ ] Responsive di 3 ukuran layar (desktop/tablet/mobile)
- [ ] Sudah di-push ke GitHub dan online di Vercel

### 📄 Kode Kumulatif Lengkap — Akhir Part 1

`index.html`:

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Saya — Budi Santoso</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <span class="logo">Budi Santoso</span>
        <nav>
            <ul>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#project">Project</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="tentang">
            <img src="assets/images/profile.jpg" alt="Foto Budi Santoso" class="profile-photo">
            <h1 id="main-title">Budi Santoso</h1>
            <p class="subtitle">Front End Web Developer</p>
            <p>
                Halo! Saya Budi, seorang pemula yang sedang belajar web development.
                Saya tertarik membangun website yang <strong>rapi</strong> dan
                <strong>fungsional</strong>.
            </p>
        </section>

        <section id="skills">
            <h2 class="section-title">Skills</h2>
            <ul class="skill-list">
                <li>HTML5</li>
                <li>CSS3</li>
                <li>JavaScript (basic)</li>
                <li>Git & GitHub</li>
            </ul>

            <h2 class="section-title">Pengalaman</h2>
            <ol class="timeline">
                <li>2023 — Mengikuti bootcamp Web Development</li>
                <li>2024 — Membuat 3 project portfolio pribadi</li>
            </ol>
        </section>

        <section id="project">
            <h2 class="section-title">Project Saya</h2>
            <div class="gallery">
                <img src="assets/images/project1.jpg" alt="Landing Page" class="gallery-img">
                <img src="assets/images/project2.jpg" alt="E-Commerce" class="gallery-img">
                <img src="assets/images/project3.jpg" alt="Dashboard" class="gallery-img">
            </div>
        </section>

        <section id="kontak">
            <h2 class="section-title">Hubungi Saya</h2>
            <form>
                <p>Metode kontak yang diinginkan:</p>
                <label><input type="radio" name="contact" value="email" checked> Email</label>
                <label><input type="radio" name="contact" value="wa"> WhatsApp</label>

                <p>Jenis project yang saya minati:</p>
                <label><input type="checkbox" name="interest" value="landing"> Landing Page</label>
                <label><input type="checkbox" name="interest" value="ecommerce"> E-Commerce</label>

                <p>
                    <label for="topik">Topik favorit:</label>
                    <select id="topik" name="topik">
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="js">JavaScript</option>
                    </select>
                </p>

                <button type="button" class="btn-primary">Kirim Pesan</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Budi Santoso. Dibuat dengan HTML & CSS.</p>
    </footer>
</body>
</html>
```

`css/style.css`:

```
/* ===== Global ===== */
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f6f8;
    color: #2b2b2b;
    margin: 0;
}
main {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}
section {
    margin-bottom: 40px;
}

/* ===== Navbar (Flexbox) ===== */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #1c3d5a;
    padding: 14px 24px;
}
.logo {
    color: white;
    font-weight: bold;
    font-size: 18px;
}
.navbar ul {
    display: flex;
    gap: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.navbar a {
    color: white;
    text-decoration: none;
}

/* ===== Profile & Section Title ===== */
.profile-photo {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 50%;
    display: block;
    margin: 20px auto;
}
#main-title { text-align: center; color: #1c3d5a; margin-bottom: 4px; }
.subtitle { text-align: center; color: #5a5a5a; font-style: italic; }
.section-title {
    color: #1c3d5a;
    border-bottom: 2px solid #1c3d5a;
    padding-bottom: 4px;
}

/* ===== List ===== */
.skill-list { list-style-type: square; padding-left: 20px; }
.skill-list li { margin-bottom: 6px; }
.timeline { list-style: none; padding-left: 0; border-left: 3px solid #1c3d5a; }
.timeline li { padding: 8px 16px; margin-bottom: 8px; }

/* ===== Gallery (Grid) ===== */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
.gallery-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 8px;
}

/* ===== Button ===== */
.btn-primary {
    display: inline-block;
    background-color: #1c3d5a;
    color: #ffffff;
    padding: 10px 24px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}
.btn-primary:hover { background-color: #2f5d84; }

/* ===== Footer ===== */
footer {
    text-align: center;
    padding: 20px;
    color: #5a5a5a;
    font-size: 14px;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .gallery { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .gallery { grid-template-columns: 1fr; }
    .navbar { flex-direction: column; align-items: flex-start; gap: 10px; }
    .navbar ul { flex-direction: column; gap: 10px; }
}
```

---

# PART 2 — JAVASCRIPT & BOOTSTRAP

## Pertemuan 9 — Review Part 1 + Zoom Hover, Redirect, Flip Box

### Tujuan Belajar

1. Mampu memahami konsep serta implementasi struktur dasar website.
2. Menjelaskan redirect webpage dan flip box.

### Materi

**Review Part 1**: peserta diminta menjelaskan ulang alur folder, tag semantic, flexbox vs grid dari portfolio masing-masing.

**Intro to Zoom Hover** (efek CSS saat mouse hover)

```
.gallery-img {
    transition: transform 0.3s ease;
}
.gallery-img:hover {
    transform: scale(1.08);
    cursor: pointer;
}
```

**Intro to Redirect Webpage**

```
<!-- Redirect otomatis pakai meta tag -->
<meta http-equiv="refresh" content="3;url=index.html">
<p>Anda akan diarahkan ke halaman utama dalam 3 detik...</p>
```

```
<!-- Redirect manual pakai link -->
<a href="under-construction.html">Lihat halaman "Coming Soon"</a>
```

**Intro to Flip Box** (kartu yang membalik saat di-hover, pakai CSS 3D transform)

```
<div class="flip-card">
    <div class="flip-card-inner">
        <div class="flip-card-front">
            <img src="assets/images/project1.jpg" alt="Landing Page">
        </div>
        <div class="flip-card-back">
            <h3>Landing Page</h3>
            <p>Dibuat dengan HTML, CSS, Flexbox.</p>
        </div>
    </div>
</div>
```

```
.flip-card {
    width: 200px;
    height: 160px;
    perspective: 1000px;
}
.flip-card-inner {
    position: relative;
    width: 100%; height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}
.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
}
.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%; height: 100%;
    backface-visibility: hidden;
    border-radius: 8px;
    overflow: hidden;
}
.flip-card-front img { width: 100%; height: 100%; object-fit: cover; }
.flip-card-back {
    background: #1c3d5a;
    color: white;
    transform: rotateY(180deg);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 12px;
}
```

### Challenge 1 — Create New Page

Peserta membuat halaman baru `under-construction.html` yang berisi pesan "Halaman ini sedang dikembangkan" dan redirect otomatis ke `index.html` setelah beberapa detik, lalu buat link ke halaman itu dari navbar (misal menu "Blog" yang belum siap).

### 🎯 Proyek Pertemuan 9: ganti galeri jadi flip card + halaman baru

Ganti section `#project` di `index.html` dengan flip card di atas (3 kartu, masing-masing untuk 1 project), tambahkan efek zoom-hover pada foto profil, dan buat `under-construction.html` baru.

**Target:** peserta paham efek hover CSS, transisi, dan cara membuat + redirect halaman baru.

---

## Pertemuan 10 — Intro to JavaScript

### Tujuan Belajar

1. Mengenal bahasa pemrograman JavaScript.
2. Memahami tipe data, variabel, dan operator.

### Materi

**Menghubungkan JavaScript ke HTML**

```
<!-- letakkan sebelum penutup </body> agar HTML sudah termuat lebih dulu -->
<script src="js/script.js"></script>
```

**Data Type**

```
let nama = "Budi Santoso";      // String
let umur = 22;                  // Number
let isMahasiswa = false;        // Boolean
let hobi = ["coding", "desain"]; // Array
let alamat = { kota: "Jakarta", kodePos: "12345" }; // Object
let belumDiisi = null;          // Null (sengaja kosong)
let belumDidefinisikan;         // Undefined
```

**Variable — `let`, `const`, `var`**

```
let umur = 22;        // nilai BISA diubah lagi nanti
const nama = "Budi";  // nilai TIDAK BISA diubah lagi (konstan)
// var namaLama = "..."; // gaya lama, dihindari di kode modern
```

**Operator**

```
// Aritmethic operator
let total = 10 + 5;   // + - * / % (modulus/sisa bagi)
let sisa = 10 % 3;    // hasil: 1

// Comparison operator
console.log(10 == "10");   // true  (hanya bandingkan nilai)
console.log(10 === "10");  // false (bandingkan nilai DAN tipe data)
console.log(10 !== 5);     // true

// Logical operator
let umurCukup = umur >= 18 && isMahasiswa === false; // AND
let bolehDaftar = umur >= 18 || isMahasiswa === true; // OR
let bukanMahasiswa = !isMahasiswa; // NOT
```

**Comments**

```
// Ini komentar satu baris
/* Ini komentar
   beberapa baris */
```

### 🎯 Proyek Pertemuan 10: `js/script.js` — data diri lewat variabel

```
// js/script.js

// Data diri disimpan sebagai variabel
const namaDepan = "Budi";
const namaBelakang = "Santoso";
const tahunMulaiBelajar = 2023;
const tahunSekarang = new Date().getFullYear();

// Operator dipakai untuk menghitung lama belajar
const lamaBelajar = tahunSekarang - tahunMulaiBelajar;

console.log("Nama:", namaDepan, namaBelakang);
console.log("Sudah belajar web dev selama", lamaBelajar, "tahun");
```

Hubungkan di `index.html` sebelum `</body>`:

```
<script src="js/script.js"></script>
```

**Target:** peserta paham variabel, tipe data, dan operator lewat DevTools Console (`console.log`), sebagai fondasi sebelum masuk DOM.

---

## Pertemuan 11 — JavaScript DOM (Document Object Model)

### Tujuan Belajar

1. Mengenal komponen dan perintah dasar DOM.
2. Menjelaskan struktur dan fungsi DOM.
3. Implementasi DOM pada project.

### Materi

**Intro to DOM (Method | Document)**

DOM adalah representasi HTML dalam bentuk objek yang bisa "dibaca" dan "diubah" lewat JavaScript.

```
document.getElementById("main-title");     // ambil 1 elemen lewat id
document.querySelector(".section-title");  // ambil elemen PERTAMA yang cocok selector CSS
document.querySelectorAll(".gallery-img"); // ambil SEMUA elemen yang cocok (jadi list)
```

**DOM Element — Style**

```
const title = document.getElementById("main-title");
title.style.color = "crimson";
title.style.fontSize = "40px";
```

**DOM Element — Tab Link (navigasi aktif)**

```
const navLinks = document.querySelectorAll(".navbar a");
navLinks.forEach(link => {
    link.addEventListener("click", () => {
        navLinks.forEach(l => l.classList.remove("active"));
        link.classList.add("active");
    });
});
```

```
.navbar a.active {
    font-weight: bold;
    text-decoration: underline;
}
```

**DOM Element — Scroll (smooth scroll ke section)**

```
document.querySelectorAll('.navbar a[href^="#"]').forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        target.scrollIntoView({ behavior: "smooth" });
    });
});
```

**DOM HTML — mengubah isi/konten elemen**

```
const subtitle = document.querySelector(".subtitle");
subtitle.innerHTML = "Front End Web Developer <strong>| Open for Work</strong>";
```

### Challenge 2 — Show Data with DOM HTML

Tampilkan sapaan dinamis berdasarkan jam saat halaman dibuka (pagi/siang/malam) menggunakan DOM.

```
const jamSekarang = new Date().getHours();
let sapaan;

if (jamSekarang < 11) {
    sapaan = "Selamat Pagi!";
} else if (jamSekarang < 18) {
    sapaan = "Selamat Siang!";
} else {
    sapaan = "Selamat Malam!";
}

document.getElementById("greeting").innerHTML = sapaan + " Terima kasih sudah berkunjung.";
```

### 🎯 Proyek Pertemuan 11: navbar aktif, smooth scroll, sapaan dinamis

Tambahkan `<p id="greeting"></p>` di bawah `.subtitle` pada `index.html`, lalu tambahkan seluruh kode DOM di atas ke `js/script.js`.

**Target:** navbar terasa "hidup" (highlight menu aktif + smooth scroll), dan halaman menampilkan sapaan otomatis sesuai jam.

---

## Pertemuan 12 — Branching (If Statement & Nested If)

### Tujuan Belajar

1. Memahami konsep kondisi pada program.
2. Implementasi if & nested if.

### Materi

**Intro to Alert System**

```
alert("Selamat datang di portfolio saya!");
```

**If Statement**

```
let nama = "";
if (nama === "") {
    alert("Nama wajib diisi!");
}
```

**Nested If** (kondisi di dalam kondisi)

```
let umur = 17;
let punyaKTP = false;

if (umur >= 17) {
    if (punyaKTP) {
        console.log("Boleh mendaftar sebagai relawan.");
    } else {
        console.log("Umur cukup, tapi KTP belum ada.");
    }
} else {
    console.log("Umur belum mencukupi.");
}
```

### Challenge 3 — Check Data Condition

Validasi form kontak sederhana: cek apakah field nama & email sudah diisi sebelum menampilkan pesan "terkirim".

```
function validasiForm(nama, email) {
    if (nama === "" || email === "") {
        alert("Nama dan Email wajib diisi!");
    } else {
        if (email.includes("@")) {
            alert("Pesan berhasil dikirim. Terima kasih, " + nama + "!");
        } else {
            alert("Format email tidak valid.");
        }
    }
}

// simulasi pemanggilan
validasiForm("Budi", "budi@example.com"); // -> berhasil
validasiForm("", "budi@example.com");     // -> nama wajib diisi
validasiForm("Budi", "budigmail.com");    // -> format tidak valid
```

### 🎯 Proyek Pertemuan 12: validasi dasar form kontak

Tambahkan `id` pada input form kontak (`id="inputNama"`, `id="inputEmail"`), lalu buat tombol "Kirim Pesan" memanggil fungsi `validasiForm()` di atas dengan `document.getElementById(...).value` sebagai argumennya (detail lengkap tentang function dijelaskan pertemuan 16 — untuk sekarang cukup gunakan bentuk sederhana di atas).

**Target:** peserta paham logika percabangan `if / else if / else` dan nested if, serta menerapkannya untuk validasi input pengguna.

---

## Pertemuan 13 — Loop (While & For Statement)

### Tujuan Belajar

1. Memahami konsep pengulangan (looping) pada program.
2. Implementasi loop & nested loop.

### Materi

**Intro to Looping Concept** Loop dipakai ketika kita ingin mengulang sebuah aksi tanpa menulis kode yang sama berkali-kali.

**While Statement**

```
let i = 1;
while (i <= 5) {
    console.log("Perulangan ke-" + i);
    i++;
}
```

**For Statement**

```
for (let i = 1; i <= 5; i++) {
    console.log("Perulangan ke-" + i);
}
```

**Nested Loop** (loop di dalam loop)

```
// membuat pola grid sederhana 3x3 di console
for (let baris = 1; baris <= 3; baris++) {
    let teksBaris = "";
    for (let kolom = 1; kolom <= 3; kolom++) {
        teksBaris += "[" + baris + "," + kolom + "] ";
    }
    console.log(teksBaris);
}
```

### 🎯 Proyek Pertemuan 13: generate skill bar otomatis dengan loop

```
const skills = [
    { nama: "HTML", level: 90 },
    { nama: "CSS", level: 80 },
    { nama: "JavaScript", level: 60 }
];

const skillContainer = document.getElementById("skill-bars");

for (let i = 0; i < skills.length; i++) {
    skillContainer.innerHTML += `
        <div class="skill-bar">
            <span>${skills[i].nama}</span>
            <div class="bar-bg">
                <div class="bar-fill" style="width: ${skills[i].level}%;"></div>
            </div>
        </div>
    `;
}
```

```
<!-- tambahkan div kosong ini di section#skills -->
<div id="skill-bars"></div>
```

```
.skill-bar { margin-bottom: 12px; }
.bar-bg { background: #dde3e8; border-radius: 6px; overflow: hidden; height: 12px; }
.bar-fill { background: #1c3d5a; height: 100%; }
```

**Target:** peserta paham `for` vs `while`, dan bisa memakainya untuk generate elemen HTML secara otomatis (bibit dari Array + DOM rendering di pertemuan berikutnya).

> Catatan pengajar: contoh di atas sengaja memakai array `skills` walau materi Array formal baru diajarkan pertemuan berikutnya — ini jembatan alami agar peserta melihat kenapa Array dan Loop selalu dipakai berdampingan.

---

## Pertemuan 14 — Intro to Array

### Tujuan Belajar

1. Memahami array sebagai struktur data untuk menyimpan banyak nilai.
2. Menggabungkan Array + Loop untuk render data secara dinamis.

### Materi

**Array 1D**

```
const bahasaPemrograman = ["HTML", "CSS", "JavaScript"];

console.log(bahasaPemrograman[0]); // "HTML"   (index dimulai dari 0)
console.log(bahasaPemrograman.length); // 3

// menambah data
bahasaPemrograman.push("TypeScript");

// mengakses semua data dengan loop
for (let i = 0; i < bahasaPemrograman.length; i++) {
    console.log(bahasaPemrograman[i]);
}

// method modern (pelengkap): forEach
bahasaPemrograman.forEach(function (item) {
    console.log("Bahasa:", item);
});
```

**Array of Object** (dipakai untuk data project yang punya banyak informasi)

```
const daftarProject = [
    { judul: "Landing Page", deskripsi: "Dibuat dengan HTML & CSS Flexbox.", gambar: "assets/images/project1.jpg" },
    { judul: "E-Commerce UI", deskripsi: "Latihan Grid & responsive design.", gambar: "assets/images/project2.jpg" },
    { judul: "Dashboard Admin", deskripsi: "Kombinasi Flexbox, Grid, dan JavaScript.", gambar: "assets/images/project3.jpg" }
];
```

### 🎯 Proyek Pertemuan 14: data project disimpan di Array, render otomatis

```
const daftarProject = [
    { judul: "Landing Page", deskripsi: "Dibuat dengan HTML & CSS Flexbox.", gambar: "assets/images/project1.jpg" },
    { judul: "E-Commerce UI", deskripsi: "Latihan Grid & responsive design.", gambar: "assets/images/project2.jpg" },
    { judul: "Dashboard Admin", deskripsi: "Kombinasi Flexbox, Grid, dan JavaScript.", gambar: "assets/images/project3.jpg" }
];

const projectContainer = document.getElementById("project-container");

for (let i = 0; i < daftarProject.length; i++) {
    const p = daftarProject[i];
    projectContainer.innerHTML += `
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="${p.gambar}" alt="${p.judul}">
                </div>
                <div class="flip-card-back">
                    <h3>${p.judul}</h3>
                    <p>${p.deskripsi}</p>
                </div>
            </div>
        </div>
    `;
}
```

```
<!-- ganti flip card manual dari pertemuan 9 dengan container kosong ini -->
<section id="project">
    <h2 class="section-title">Project Saya</h2>
    <div class="gallery" id="project-container"></div>
</section>
```

**Target:** peserta paham kenapa data sebaiknya disimpan di Array, bukan ditulis manual berkali-kali di HTML — menambah project baru cukup menambah 1 baris di Array, tidak perlu menulis ulang HTML.

---

## Pertemuan 15 — DOM Form

### Tujuan Belajar

1. Memahami fungsi DOM Form.
2. Implementasi validasi field kosong.

### Materi

**DOM Form — mengambil nilai input**

```
<form id="formKontak">
    <input type="text" id="inputNama" placeholder="Nama Lengkap">
    <input type="email" id="inputEmail" placeholder="Email">
    <textarea id="inputPesan" placeholder="Pesan Anda"></textarea>
    <button type="submit" class="btn-primary">Kirim Pesan</button>
</form>
<p id="formStatus"></p>
```

```
const form = document.getElementById("formKontak");

form.addEventListener("submit", function (e) {
    e.preventDefault(); // mencegah halaman reload saat submit

    const nama = document.getElementById("inputNama").value;
    const email = document.getElementById("inputEmail").value;
    const pesan = document.getElementById("inputPesan").value;

    console.log({ nama, email, pesan });
});
```

### Challenge 4 — Check Blank Field

```
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const nama = document.getElementById("inputNama").value.trim();
    const email = document.getElementById("inputEmail").value.trim();
    const pesan = document.getElementById("inputPesan").value.trim();
    const status = document.getElementById("formStatus");

    if (nama === "" || email === "" || pesan === "") {
        status.textContent = "⚠️ Semua field wajib diisi!";
        status.style.color = "crimson";
        return; // hentikan proses jika ada field kosong
    }

    status.textContent = "✅ Pesan berhasil dikirim. Terima kasih, " + nama + "!";
    status.style.color = "green";
    form.reset(); // kosongkan kembali form
});
```

### 🎯 Proyek Pertemuan 15: form kontak fungsional dengan validasi blank field

Ganti form statis pada section `#kontak` dengan versi `id`-berbasis di atas, dan tambahkan seluruh script validasi ke `js/script.js`.

**Target:** form kontak sekarang benar-benar mengecek input kosong dan memberi feedback langsung ke pengguna tanpa reload halaman.

---

## Pertemuan 16 — Intro to Function (Argument & Parameter)

### Tujuan Belajar

1. Memahami konsep function.
2. Implementasi function dengan parameter & argument.

### Materi

**Intro to Function**

```
function sapa() {
    console.log("Halo, selamat datang!");
}
sapa(); // memanggil function
```

**Argument & Parameter**

```
// "nama" adalah PARAMETER (tempat menampung nilai)
function sapaDenganNama(nama) {
    console.log("Halo, " + nama + "!");
}

sapaDenganNama("Budi"); // "Budi" adalah ARGUMENT (nilai yang dikirim)
sapaDenganNama("Sari");
```

```
// Function bisa mengembalikan nilai dengan "return"
function tambah(a, b) {
    return a + b;
}
const hasil = tambah(5, 3); // hasil = 8
```

### 🎯 Proyek Pertemuan 16: refactor semua logic jadi function yang rapi

```
// ===== 1. Function render project (dari pertemuan 14) =====
function renderProject(daftarProject) {
    const container = document.getElementById("project-container");
    container.innerHTML = ""; // kosongkan dulu sebelum render ulang

    daftarProject.forEach(function (p) {
        container.innerHTML += `
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front"><img src="${p.gambar}" alt="${p.judul}"></div>
                    <div class="flip-card-back"><h3>${p.judul}</h3><p>${p.deskripsi}</p></div>
                </div>
            </div>
        `;
    });
}

// ===== 2. Function render skill bar (dari pertemuan 13) =====
function renderSkills(skills) {
    const container = document.getElementById("skill-bars");
    container.innerHTML = "";
    skills.forEach(function (s) {
        container.innerHTML += `
            <div class="skill-bar">
                <span>${s.nama}</span>
                <div class="bar-bg"><div class="bar-fill" style="width: ${s.level}%;"></div></div>
            </div>
        `;
    });
}

// ===== 3. Function validasi form (dari pertemuan 15) =====
function validasiForm(nama, email, pesan) {
    if (nama === "" || email === "" || pesan === "") {
        return { sukses: false, pesan: "⚠️ Semua field wajib diisi!" };
    }
    if (!email.includes("@")) {
        return { sukses: false, pesan: "⚠️ Format email tidak valid." };
    }
    return { sukses: true, pesan: "✅ Pesan berhasil dikirim. Terima kasih, " + nama + "!" };
}

// ===== Pemanggilan semua function saat halaman dimuat =====
const daftarProject = [
    { judul: "Landing Page", deskripsi: "Dibuat dengan HTML & CSS Flexbox.", gambar: "assets/images/project1.jpg" },
    { judul: "E-Commerce UI", deskripsi: "Latihan Grid & responsive design.", gambar: "assets/images/project2.jpg" },
    { judul: "Dashboard Admin", deskripsi: "Kombinasi Flexbox, Grid, dan JavaScript.", gambar: "assets/images/project3.jpg" }
];
const skills = [
    { nama: "HTML", level: 90 }, { nama: "CSS", level: 80 }, { nama: "JavaScript", level: 60 }
];

renderProject(daftarProject);
renderSkills(skills);
```

**Target:** peserta paham kenapa memecah kode jadi function membuat kode lebih rapi, mudah dibaca, dan mudah dipakai ulang (reusable) — ini fondasi menuju kode yang "production-ready".

---

## Pertemuan 17 — Event Handlers

### Tujuan Belajar

1. Memahami & mengimplementasi event handler dengan konsep function.

### Materi

**Intro to Event Handlers**

```
const tombol = document.querySelector(".btn-primary");

tombol.addEventListener("click", function () {
    console.log("Tombol diklik!");
});
```

Event lain yang umum dipakai:

```
input.addEventListener("input", handleInput);     // setiap kali user mengetik
form.addEventListener("submit", handleSubmit);     // saat form dikirim
window.addEventListener("scroll", handleScroll);   // saat halaman di-scroll
element.addEventListener("mouseover", handleHover); // saat mouse di atas elemen
```

### Challenge 5 — Show Data with Function (Filter Project by Kategori)

```
const daftarProjectLengkap = [
    { judul: "Landing Page", kategori: "landing", deskripsi: "...", gambar: "assets/images/project1.jpg" },
    { judul: "Toko Online", kategori: "ecommerce", deskripsi: "...", gambar: "assets/images/project2.jpg" },
    { judul: "Dashboard Admin", kategori: "dashboard", deskripsi: "...", gambar: "assets/images/project3.jpg" }
];

function filterProject(kategori) {
    if (kategori === "semua") {
        return daftarProjectLengkap;
    }
    return daftarProjectLengkap.filter(function (p) {
        return p.kategori === kategori;
    });
}

document.querySelectorAll(".filter-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
        const kategoriDipilih = btn.dataset.kategori; // ambil dari atribut data-kategori
        renderProject(filterProject(kategoriDipilih));
    });
});
```

```
<div class="filter-buttons">
    <button class="filter-btn" data-kategori="semua">Semua</button>
    <button class="filter-btn" data-kategori="landing">Landing Page</button>
    <button class="filter-btn" data-kategori="ecommerce">E-Commerce</button>
    <button class="filter-btn" data-kategori="dashboard">Dashboard</button>
</div>
<div class="gallery" id="project-container"></div>
```

### 🎯 Bonus: menyimpan pesan form dengan `localStorage` *(opsional, konsep tambahan)*

Supaya event handler terasa lebih nyata manfaatnya — data form tidak hilang walau halaman di-refresh:

```
form.addEventListener("submit", function (e) {
    e.preventDefault();
    const nama = document.getElementById("inputNama").value.trim();
    const email = document.getElementById("inputEmail").value.trim();
    const pesan = document.getElementById("inputPesan").value.trim();

    const hasil = validasiForm(nama, email, pesan);
    document.getElementById("formStatus").textContent = hasil.pesan;

    if (hasil.sukses) {
        localStorage.setItem("pesanTerakhir", JSON.stringify({ nama, email, pesan }));
        form.reset();
    }
});
```

### 🎯 Proyek Pertemuan 17: filter project by kategori + event handler lengkap

Tambahkan `kategori` pada setiap object di array `daftarProject`, tambahkan tombol filter di atas galeri project, dan hubungkan semua event handler (klik tombol filter, submit form, dsb) ke `js/script.js`.

**Target:** portfolio kini benar-benar interaktif — pengunjung bisa memfilter project berdasarkan kategori, dan form kontak berfungsi penuh dengan validasi + penyimpanan sementara.

---

## Pertemuan 18 — Welcome to Bootstrap

### Tujuan Belajar

1. Menjelaskan fungsi dan penerapan Bootstrap.
2. Mempercepat proses pembuatan tampilan dengan Bootstrap.

### Materi

**Intro to Bootstrap** — apa itu Bootstrap?

Bootstrap adalah framework CSS siap pakai yang menyediakan sistem grid, komponen (navbar, card, button, form), dan utility class, sehingga kita tidak perlu menulis CSS dari nol untuk kebutuhan layout umum.

**Instalasi via CDN**

```
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- konten -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
```

**Grid System Bootstrap** (mirip konsep CSS Grid, tapi dengan class siap pakai)

```
<div class="container">
    <div class="row">
        <div class="col-md-4">Kolom 1</div>
        <div class="col-md-4">Kolom 2</div>
        <div class="col-md-4">Kolom 3</div>
    </div>
</div>
```

**Navbar Bootstrap**

```
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
```

**Card Bootstrap** (pengganti flip-card manual, opsional dikombinasikan)

```
<div class="card" style="width: 18rem;">
    <img src="assets/images/project1.jpg" class="card-img-top" alt="Landing Page">
    <div class="card-body">
        <h5 class="card-title">Landing Page</h5>
        <p class="card-text">Dibuat dengan HTML & CSS Flexbox.</p>
    </div>
</div>
```

**Form & Button Bootstrap**

```
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
```

### 🎯 Proyek Pertemuan 18: rebuild navbar, grid project, dan form pakai Bootstrap

Ganti navbar custom (flexbox manual) dengan navbar Bootstrap di atas, ganti grid galeri (`display:grid` manual) dengan `row` + `col-md-4` Bootstrap berisi `card`, dan ganti form kontak dengan komponen form Bootstrap — **JavaScript custom dari pertemuan 10-17 tetap dipakai** (validasi, filter, render project), hanya tampilannya yang kini dibangun dengan class Bootstrap.

**Target:** peserta paham bahwa Bootstrap mempercepat styling (bukan mengganti logic JavaScript), dan portfolio kini lebih cepat dibangun dengan komponen siap pakai.

---

## Pertemuan 19 — Final Exam Part 2: Free Project (Review + Challenge)

### Tujuan Belajar

Memiliki satu prototipe website yang siap dikembangkan lebih lanjut — interaktif, responsive, dan online.

### Aktivitas

1. Review seluruh materi Part 2 (JavaScript dasar → DOM → Branching → Loop → Array → Form → Function → Event Handler → Bootstrap).
2. **Challenge** : peserta menyempurnakan portfolio pribadi masing-masing menjadi versi final, lalu re-deploy ke Vercel.

### Checklist Final Exam Part 2

- [ ] Navbar aktif otomatis & smooth scroll berfungsi
- [ ] Data project & skill disimpan di Array, dirender otomatis lewat loop + function
- [ ] Filter project by kategori berfungsi (event handler)
- [ ] Form kontak: validasi field kosong & format email, memberi feedback ke user
- [ ] Semua logic JavaScript dipecah jadi function yang rapi (bukan kode acak-acakan di satu blok)
- [ ] Layout dibangun dengan Bootstrap (navbar, grid, card, form)
- [ ] Website tetap responsive di desktop/tablet/mobile
- [ ] Sudah di-push ke GitHub dan online di Vercel (versi final)

### 📄 Kode Kumulatif Lengkap — Versi Final (Part 1 + Part 2)

`index.html`:

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Saya — Budi Santoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
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

    <main class="container py-5">
        <section id="tentang" class="text-center mb-5">
            <img src="assets/images/profile.jpg" alt="Foto Budi Santoso" class="profile-photo">
            <h1 id="main-title">Budi Santoso</h1>
            <p class="subtitle">Front End Web Developer</p>
            <p id="greeting" class="fst-italic text-secondary"></p>
        </section>

        <section id="skills" class="mb-5">
            <h2 class="section-title">Skills</h2>
            <div id="skill-bars"></div>
        </section>

        <section id="project" class="mb-5">
            <h2 class="section-title">Project Saya</h2>
            <div class="filter-buttons mb-3">
                <button class="btn btn-outline-primary btn-sm filter-btn" data-kategori="semua">Semua</button>
                <button class="btn btn-outline-primary btn-sm filter-btn" data-kategori="landing">Landing Page</button>
                <button class="btn btn-outline-primary btn-sm filter-btn" data-kategori="ecommerce">E-Commerce</button>
                <button class="btn btn-outline-primary btn-sm filter-btn" data-kategori="dashboard">Dashboard</button>
            </div>
            <div class="row g-3" id="project-container"></div>
        </section>

        <section id="kontak" class="mb-5">
            <h2 class="section-title">Hubungi Saya</h2>
            <form id="formKontak" class="w-100" style="max-width: 500px;">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="inputNama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pesan</label>
                    <textarea class="form-control" id="inputPesan" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                <p id="formStatus" class="mt-2 fw-bold"></p>
            </form>
        </section>
    </main>

    <footer class="text-center py-4 text-secondary">
        <p>&copy; 2026 Budi Santoso. Dibuat dengan HTML, CSS, JavaScript & Bootstrap.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
```

`js/script.js`:

```
// ===================================================
// 1. DATA (Array of Object)
// ===================================================
const daftarProjectLengkap = [
    { judul: "Landing Page", kategori: "landing", deskripsi: "Dibuat dengan HTML & CSS Flexbox.", gambar: "assets/images/project1.jpg" },
    { judul: "Toko Online", kategori: "ecommerce", deskripsi: "Latihan Grid & responsive design.", gambar: "assets/images/project2.jpg" },
    { judul: "Dashboard Admin", kategori: "dashboard", deskripsi: "Kombinasi Flexbox, Grid, dan JavaScript.", gambar: "assets/images/project3.jpg" }
];

const skills = [
    { nama: "HTML", level: 90 },
    { nama: "CSS", level: 80 },
    { nama: "JavaScript", level: 60 }
];

// ===================================================
// 2. FUNCTION — Render
// ===================================================
function renderProject(daftarProject) {
    const container = document.getElementById("project-container");
    container.innerHTML = "";
    daftarProject.forEach(function (p) {
        container.innerHTML += `
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="${p.gambar}" class="card-img-top" alt="${p.judul}">
                    <div class="card-body">
                        <h5 class="card-title">${p.judul}</h5>
                        <p class="card-text">${p.deskripsi}</p>
                    </div>
                </div>
            </div>
        `;
    });
}

function renderSkills(skillsData) {
    const container = document.getElementById("skill-bars");
    container.innerHTML = "";
    skillsData.forEach(function (s) {
        container.innerHTML += `
            <div class="skill-bar">
                <span>${s.nama}</span>
                <div class="bar-bg"><div class="bar-fill" style="width: ${s.level}%;"></div></div>
            </div>
        `;
    });
}

function tampilkanSapaan() {
    const jamSekarang = new Date().getHours();
    let sapaan;
    if (jamSekarang < 11) {
        sapaan = "Selamat Pagi!";
    } else if (jamSekarang < 18) {
        sapaan = "Selamat Siang!";
    } else {
        sapaan = "Selamat Malam!";
    }
    document.getElementById("greeting").textContent = sapaan + " Terima kasih sudah berkunjung.";
}

// ===================================================
// 3. FUNCTION — Filter (Branching + Array method)
// ===================================================
function filterProject(kategori) {
    if (kategori === "semua") {
        return daftarProjectLengkap;
    }
    return daftarProjectLengkap.filter(function (p) {
        return p.kategori === kategori;
    });
}

// ===================================================
// 4. FUNCTION — Validasi Form (Branching)
// ===================================================
function validasiForm(nama, email, pesan) {
    if (nama === "" || email === "" || pesan === "") {
        return { sukses: false, pesan: "⚠️ Semua field wajib diisi!" };
    }
    if (!email.includes("@")) {
        return { sukses: false, pesan: "⚠️ Format email tidak valid." };
    }
    return { sukses: true, pesan: "✅ Pesan berhasil dikirim. Terima kasih, " + nama + "!" };
}

// ===================================================
// 5. EVENT HANDLERS
// ===================================================
document.querySelectorAll(".filter-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
        renderProject(filterProject(btn.dataset.kategori));
    });
});

const form = document.getElementById("formKontak");
form.addEventListener("submit", function (e) {
    e.preventDefault();
    const nama = document.getElementById("inputNama").value.trim();
    const email = document.getElementById("inputEmail").value.trim();
    const pesan = document.getElementById("inputPesan").value.trim();
    const status = document.getElementById("formStatus");

    const hasil = validasiForm(nama, email, pesan);
    status.textContent = hasil.pesan;
    status.style.color = hasil.sukses ? "green" : "crimson";

    if (hasil.sukses) {
        localStorage.setItem("pesanTerakhir", JSON.stringify({ nama, email, pesan }));
        form.reset();
    }
});

// Smooth scroll + navbar active state
document.querySelectorAll('.navbar a[href^="#"]').forEach(function (link) {
    link.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelectorAll(".navbar a").forEach(l => l.classList.remove("active"));
        link.classList.add("active");
        document.querySelector(link.getAttribute("href")).scrollIntoView({ behavior: "smooth" });
    });
});

// ===================================================
// 6. INISIALISASI — dijalankan saat halaman dimuat
// ===================================================
tampilkanSapaan();
renderSkills(skills);
renderProject(daftarProjectLengkap);
```

`css/style.css` (tambahan khusus di atas CSS Bootstrap):

```
body { font-family: 'Segoe UI', Arial, sans-serif; }
.profile-photo {
    width: 160px; height: 160px; object-fit: cover;
    border-radius: 50%; margin-bottom: 16px;
    transition: transform 0.3s ease;
}
.profile-photo:hover { transform: scale(1.05); }
.section-title { border-bottom: 2px solid #1c3d5a; padding-bottom: 4px; margin-bottom: 20px; }
.skill-bar { margin-bottom: 12px; }
.bar-bg { background: #dde3e8; border-radius: 6px; overflow: hidden; height: 12px; }
.bar-fill { background: #1c3d5a; height: 100%; }
.navbar a.active { text-decoration: underline; font-weight: bold; }
```

**Target akhir kelas:** setiap peserta memiliki **satu website portfolio pribadi yang lengkap**: struktur semantic, styling Bootstrap + custom CSS, responsive di semua device, dan interaktif penuh (render data dari Array, filter project, validasi form) — online dan bisa dibagikan lewat link Vercel.

---

## Ringkasan Peta Konsep per Pertemuan

| # | Topik Utama | Peserta bisa apa setelah ini? |
| --- | --- | --- |
| 1 | Setup tools, HTML dasar | Membuat halaman HTML dasar & paham struktur project |
| 2 | CSS dasar | Styling halaman lewat file CSS eksternal |
| 3 | List | Menampilkan data dalam bentuk list yang rapi |
| 4 | Button & form input | Membuat tombol, radio, checkbox, select |
| 5 | Media | Menampilkan gambar & audio |
| 6 | Flexbox & Grid | Membuat layout navbar & galeri yang terstruktur |
| 7 | Responsive | Website tampil baik di semua ukuran layar |
| 8 | **Final Exam 1** | Portfolio statis lengkap, online di Vercel |
| 9 | Hover, redirect, flip box | Efek visual interaktif dasar (CSS) |
| 10 | JS dasar | Variabel, tipe data, operator |
| 11 | DOM | Memanipulasi elemen HTML lewat JavaScript |
| 12 | Branching | Logika kondisi (if/else, nested if) |
| 13 | Loop | Pengulangan (for/while) |
| 14 | Array | Menyimpan & mengelola banyak data sekaligus |
| 15 | DOM Form | Mengambil & memvalidasi input form |
| 16 | Function | Kode yang rapi, reusable, terorganisir |
| 17 | Event Handler | Website merespons interaksi pengguna |
| 18 | Bootstrap | Membangun UI lebih cepat dengan komponen siap pakai |
| 19 | **Final Exam 2** | Portfolio interaktif & responsive penuh, online di Vercel |
