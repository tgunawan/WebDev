# Panduan Lengkap Website Portfolio

Dokumen ini berisi seluruh materi yang dibahas:

- Struktur project portfolio
- Home Page
- About Page
- Portfolio Page
- Blog Page
- Contact Page
- Navigasi antar halaman
- CSS Styling
- JavaScript Interaktif 
- Portfolio Gallery dengan Flip Card Animation

---

# Struktur Folder

```text
portfolio/
│
├── index.html
├── about.html
├── portfolio.html
├── blog.html
├── contact.html
│
├── style.css
└── script.js
```

---

# index.html

```html
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Joe.</div>

    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<section class="hero">
    <div>
        <h1>Hi, I'm Joe Greyson</h1>
        <h2>Frontend Developer</h2>
        <p>Membuat website modern dan responsif.</p>
        <button id="hireBtn">Hire Me</button>
    </div>
</section>

<script src="script.js"></script>

</body>
</html>
```

---

# about.html

```html
<!DOCTYPE html>
<html>
<head>
    <title>About Me</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Joe.</div>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<section class="page">
    <h1>About Me</h1>

    <p>Saya adalah Front-End Developer yang fokus membuat website modern menggunakan HTML, CSS dan JavaScript.</p>

    <h2>Skills</h2>

    <ul>
        <li>HTML</li>
        <li>CSS</li>
        <li>JavaScript</li>
        <li>Responsive Design</li>
    </ul>
</section>

</body>
</html>
```

---

# portfolio.html

```html
<!DOCTYPE html>
<html>
<head>
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Joe.</div>

    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<section class="portfolio-section">

    <h1>My Projects</h1>

    <div class="gallery">

        <div class="flip-card">
            <div class="flip-card-inner">

                <div class="flip-card-front">
                    <img src="https://picsum.photos/300/200?1">
                    <h3>E-Commerce Website</h3>
                </div>

                <div class="flip-card-back">
                    <h3>E-Commerce Website</h3>
                    <p>Website toko online menggunakan HTML, CSS dan JavaScript.</p>
                    <a href="#">GitHub</a>
                    <a href="#">Live Demo</a>
                </div>

            </div>
        </div>

    </div>

</section>

</body>
</html>
```

---

# blog.html

```html
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Joe.</div>

    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<section class="page">
    <h1>Blog</h1>

    <div class="card">
        <h3>Belajar HTML untuk Pemula</h3>
        <p>HTML adalah dasar dari semua website.</p>
    </div>

</section>

</body>
</html>
```

---

# contact.html

```html
<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Joe.</div>

    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>

<form id="contactForm">
    <input type="text" placeholder="Your Name" required>
    <input type="email" placeholder="Your Email" required>
    <textarea rows="5" placeholder="Your Message"></textarea>
    <button type="submit">Send Message</button>
</form>

<script src="script.js"></script>

</body>
</html>
```

---

# style.css

```css
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    background:#f4f4f4;
}

.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 60px;
    background:white;
}

.logo{
    color:#7d3cff;
    font-size:30px;
    font-weight:bold;
}

.nav-links{
    list-style:none;
    display:flex;
    gap:25px;
}

.nav-links a{
    text-decoration:none;
    color:black;
}

.gallery{
    display:flex;
    gap:30px;
    flex-wrap:wrap;
    justify-content:center;
}

.flip-card{
    width:300px;
    height:380px;
    perspective:1000px;
}

.flip-card-inner{
    width:100%;
    height:100%;
    position:relative;
    transition:transform .8s;
    transform-style:preserve-3d;
}

.flip-card:hover .flip-card-inner{
    transform:rotateY(180deg);
}

.flip-card-front,
.flip-card-back{
    position:absolute;
    width:100%;
    height:100%;
    backface-visibility:hidden;
    border-radius:15px;
}

.flip-card-front{
    background:white;
}

.flip-card-back{
    background:#7c3aed;
    color:white;
    transform:rotateY(180deg);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}
```

---

# script.js

```javascript
let hireBtn = document.getElementById('hireBtn');

if (hireBtn){
    hireBtn.addEventListener('click', function(){
        alert('Thank you for your interest!');
    });
}

let contactForm = document.getElementById('contactForm');

if(contactForm){

    contactForm.addEventListener('submit', function(event){

        event.preventDefault();

        alert('Message sent successfully!');

    });
}
```

---

# Penjelasan Komponen

## HTML

- Navbar
- Hero Section
- About Section
- Portfolio Gallery
- Blog Section
- Contact Form

## CSS

- Flexbox Layout
- Responsive Design
- Hover Effect
- Flip Card Animation
- Card Styling

## JavaScript

- Event Listener
- Alert Interaction
- Form Submission Handling

---

# Tahapan Pembuatan

1. Buat struktur folder.
2. Buat halaman Home.
3. Tambahkan Navbar.
4. Buat halaman About.
5. Buat halaman Portfolio.
6. Tambahkan Flip Card Animation.
7. Buat halaman Blog.
8. Buat halaman Contact.
9. Hubungkan semua halaman dengan link navbar.
10. Tambahkan CSS dan JavaScript.
11. Uji semua halaman.
12. Deploy ke GitHub Pages.
