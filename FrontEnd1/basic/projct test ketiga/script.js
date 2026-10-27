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