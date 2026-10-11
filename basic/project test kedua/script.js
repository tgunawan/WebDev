function ubahNama(){
    let nama=document.getElementById("username").value
    document.getElementById("namaUbah").textContent=nama
}

function ubahPassw(){
    let pass=document.getElementById("password").value
    document.getElementById("passUbah").textContent=pass
}

function cek(){
    let nama=document.getElementById("username").value
    let pass=document.getElementById("password").value
    if (!nama || !pass) {
        alert("Isi input yang kosong");
        return;
    }
    if (nama==="admin" && pass==="admin"){
        alert("Selamat datang admin")
    }else{
        alert("Selamat datang user")
        window.location.href = "indexTestDua2.html";
    }
    console.log(nama)
    console.log(pass)
}