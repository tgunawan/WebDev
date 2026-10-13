
// auto skill create
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

// auto project
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


// Form pesan kontak
const form = document.getElementById("formKontak");

form.addEventListener("submit", function (e) {
    e.preventDefault(); // mencegah halaman reload saat submit

    const nama = document.getElementById("inputNama").value;
    const email = document.getElementById("inputEmail").value;
    const pesan = document.getElementById("inputPesan").value;

    console.log({ nama, email, pesan });
});
/* dengan fungsi validasi
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
*/
