
<!--  intro js
review direct page
    Redirect manual pakai link 
    <a href="Materi1.html">Lihat halaman "Coming Soon"</a> 
    Redirect otomatis pakai meta tag 
    <meta http-equiv="refresh" content="3;url=Materi2.html "> 
    <p>Anda akan diarahkan ke halaman utama dalam 3 detik...</p> 

    test : peserta paham efek hover CSS, transisi, dan cara membuat + redirect halaman baru.

panggil js ada 2 cara sebelum </body>
1.  <script>
        function sayHello() {
            alert("Hello Cinderella!");
        }
    </script>
2.  <script src="./Scripts/script.js"></script>

tipe data dalam js
string = text
number = bilangan bulat / desimal
boolean = true / false
array = dengan pakai []
object (dictionary di python) = dengan pakai {} ada properti dan value

let nama; undefined = ada variable namun belum ada nilai
let nama= null; => sengaja kosong


variable
let = dapat di ubah
const = tidak dapat di ubah
var = tidak efektif di modern js, gaya lama

cara panggil:
let firstName = "Cinderella";
let greeting = "Hello " + firstName;

let greeting2 = 'Hello ${firstName}!';

menampilkan variable / mengubah text pada html dengan innerHTML

let name = "Cinderella";

document.getElementById("result").innerHTML = name;

<p id="result"></p> otomatis akan menampilkan Cinderella

MethodMencari           | berdasarkan  
getElementById()        | id
getElementsByClassName()| class
getElementsByTagName()  | tag / elemen (p/h1/article)
querySelector()         | selector CSS pertama
querySelectorAll()      | semua selector CSS



operator
- Arithmetic
    - console.log(a + b); +,-,*,/,%
- Assignment
    - score += 10;
    - let name = 2;
- Comparison hasil true / false
    - >
    - <
    - >=
    - <=
    - === => nilai dan tipe data harus sama jadi lebih aman
    - ==  => nilai harus sama tipe data dapat berbeda
    - !==

- Logical
    - AND &&
    - OR ||
    - NOT !

Commentar dengan // atau /**/

DOM — Document Object Model

document.body.innerHTML += "<p> <hr><b>Ini adalah paragraf baru<hr></b>Dari JS<hr></p>";
dapat ubah html file dari js

textContent vs. innerHTML
Feature         |	textContent                                                         |	innerHTML
What it returns | Plain text string – tags are treated as literal characters.	        | HTML markup string – tags are parsed into DOM nodes when read.
What it sets	| Plain text (no HTML tags are interpreted).	                        | Full HTML markup (tags become live elements).
Performance 	| Very fast – no parsing.	                                            | Slower – must parse HTML each time.
Safety	        | Safe – no accidental script execution.	                            | Potentially unsafe – can run <script>, <img>, etc., if you set from untrusted data.
Use‑case	    | Displaying or editing plain text, copying text, simple replacements.	|Building complex UI fragments, inserting HTML, dynamically‑generated markup.

let nama = (4/3).toFixed(2);
document.getElementById("result").innerHTML = nama; //ubah text pada html

let text = document.getElementById("test_para"); //ambil text pada html
let text = document.getElementsByName("test_para")[0]; //ambil text pada html
console.log(text);
text.innerHTML = text.textContent +"Hello World!"; //ubah text pada html

innerHTML = Dapat memasukkan HTML
    element.innerHTML = "<b>Hello</b>"; akan jadi bold

textContent = Mengubah teks saja
    element.innerHTML = "<b>Hello</b>"; akan menampilkan <b>Hello</b>

==============================================================
    Target: peserta paham variabel, tipe data, dan operator lewat DevTools Console 
(console.log), sebagai fondasi sebelum masuk DOM.
==============================================================

getElementById()         -> sudah sebelumnya berdasarkan id yang ada di elemen
getElementsByClassName() ->
    let kelas= document.getElementsByClassName("paragraf")[0]; 
    console.log(kelas.innerHTML);
    let kelas= document.getElementsByClassName("paragraf"); 
    console.log(kelas[2].innerHTML);
    -> mengambil class sesuai no array 
    => untuk modern jarang di pakai karena hanya bisa class
    => di pakai jika butuh live update data karena bersifat HTML Collection LIVE
    => selain butuh data live di saranakan pakai    
        document.querySelector("#id");
        document.querySelector(".class");
        document.querySelectorAll(".class");

getElementsByTagName()  
    let paragraf = document.getElementsByTagName("p");
    console.log(paragraf[1])
    sama seperti by class name -> HTML Colection Live

querySelector()
    let kelas2= document.querySelector(".paragraf"); 
    console.log(kelas2.innerHTML);
    -> mengambil class pertama 

querySelectorAll()
    let characters =
    document.querySelectorAll(".character");
    -> mengambil semua class mirip byclassname

id
document.querySelector("#nama");

class
document.querySelector(".card");

tag
document.querySelector("button");

kombinasi
document.querySelector(".card img");

semua
document.querySelectorAll(".menu");

queryselector dapat dipakai dengan gaya css, 
namun tidak live

dapat ubah style pada file html

let titleStyle = document.getElementById("title");

titleStyle.style.color = "purple";
titleStyle.style.fontSize = "40px";

document.body.style.backgroundColor = "pink";

menambahkan / hapus class dalam suatu elemen
let story = document.getElementById("story");
story.classList.add("highlight"); 
story.classList.remove("highlight");

Untuk menambahkan jika belum ada dan menghapus jika sudah ada:
story.classList.toggle("highlight");

panggil dengan tombol
dalam file js
function changeTitle() {
    document.getElementById("title").textContent =
        "Welcome to My World!";}
dengan nilai dari input
function ubahNama(){
    let name = document.getElementById("textInput").value
    document.getElementById("nama").textContent =name;
}
di html
<button onclick="changeTitle()">
    Change Title
</button>
dapat juga pakai event di input
<input id="textInput2" type="text" placeholder="Masukkan nama" oninput="ubahNama()">
    
versi modern pakai eventlistener
const textBox = document.getElementById("textInput");
const nama = document.getElementById("nama");

textBox.addEventListener("input", function () {
    nama.textContent = textBox.value;
});

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
}

'
for (let i = 1; i <= 5; i++) {
    console.log(i , "counting");
}

let i = 1;

while (i <= 5) {
    console.log(i);
    i++;
}

function segitiga(){
    for (let i=1;i<=5;i++){
        let row=""
        for(let j=1;j<i;j++){
            row+="+"
        }
        console.log(row)
    }
}
segitiga()

let user=[
    ["admin","admin"],
    ["user1","123"],
    ["tester","superadmin"]]

function cekUser(){
    for(let i=0;i<user.length;i++){
        let data=""
        for(let j=0;j<user[i].length;j++){
            if(j===0){
                console.log("your username: "+user[i][j])
            }else{
                console.log("your password: "+user[i][j])
            }
            data+=user[i][j]+"-"
        }
        console.log(data)
    }
}
cekUser()
'
======================
Loop Array
- array bisa berbeda tipe data
- akses dan ubah data = array[1]=n
- cek jumlah data array = array.length
- menambah di akhir array = array.push("tambah")
- menghapus data di akhir array = array.pop()
- menambah data di awal array = array.unshift("pertama")
- hapus array pertama dan mengembalikan nilai yang dihapus = array.shift()
- array object / dictionary(python)
let characters = [
    {
        name: "Cinderella",
        role: "Main Character"
    },
    {
        name: "Prince",
        role: "Prince"
    },
    {
        name: "Fairy Godmother",
        role: "Helper"
    }
];

for (let i = 0; i < characters.length; i++) {

    console.log(characters[i].name);
    console.log(characters[i].role);




membuat list karakter di halaman dengan array di js
let characters = [
    "Cinderella","Prince","Fairy Godmother",
    "Lady Tremaine","Anastasia","Drizella"
];

let characterList = document.getElementById("characterList");

for (let i = 0; i < characters.length; i++) {

    characterList.innerHTML += `
        <div class="character">
            <h3>${characters[i]}</h3>
        </div>
    `;

}

default input.value dari dokumen menjadi string

let number1 = Number(document.getElementById("number1").value);
let number2 = Number(document.getElementById("number2").value);

let total = number1 + number2;

=====================================================
Form

<form>
    <label>Name</label>
    <input type="text" id="name">

    <label>Age</label>
    <input type="number" id="age">

    <button type="button" onclick="showData() ">Submit</button>
</form>

---------------------------
<form action="satu.html">
    <label>Name</label>
    <input type="text" id="name" pattern="set">

    <button type="submit"">Submit</button>
</form>

jika dalam form ada action dapat pakai submit type button untuk pindah html namun akan merefresh halaman terkadang tidak dapat di gabung dengan function js, contoh untuk ubah text dalam halaman maka akan terefresh terus dan text tidak terlihat berubah
- dengan pattern bisa set kondisi input tertentu
---------------------------------------------------------
bisa di gabung
<form id="myForm">
    <input type="text" id="nama" required>
    <button type="submit">Kirim</button>
</form>

<script>
document.getElementById("myForm").addEventListener("submit", function(e) {
    e.preventDefault();

    if (this.checkValidity()) {
        window.location.href = "halaman2.html";
    }
});
</script>
-------------------------------------------------------
<input type="text" id="name">
let name = document.getElementById("name").value;
<input type="number" id="age"> default tetap string saat di ambil data
let age = document.getElementById("age").value;

 <input type="checkbox" id="invitation">
 let invitation = document.getElementById("invitation").checked;

----------------------------------------

 <label>
    <input type="radio" name="role" value="guest">
    Guest
</label>
<label>
    <input type="radio" name="role" value="royal">
    Royal
</label>

let role = document.querySelector(
    'input[name="role"]:checked'
).value;

------------------------------------------
<select id="character">
    <option value="cinderella">Cinderella</option>
    <option value="prince">Prince</option>
    <option value="fairy">Fairy Godmother</option>
</select>
let character =
    document.getElementById("character").value;
-------------------------------------------
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
}

===========================================================
input.addEventListener("input", handleInput);     // setiap kali user mengetik
form.addEventListener("submit", handleSubmit);     // saat form dikirim
window.addEventListener("scroll", handleScroll);   // saat halaman di-scroll
element.addEventListener("mouseover", handleHover); // saat mouse di atas elemen


Event Handler
- onclick = user klik button
    <button onclick="sayHello()">
        Click Me
    </button>

- onmouseover = mouse masuk ke element
- onmouseout = mouse keluar
<h1 onmouseover="changeColor()"
    onmouseout="resetColor()">
    Cinderella
</h1>

function changeColor() {
    document.querySelector("h1").style.color = "purple";
}

function resetColor() {
    document.querySelector("h1").style.color = "black";
}


- addEventListener = event handler yang menjalankan fungsi berdasarkan trigger dari suatu elemen

    - click
    <input type="text" id="name">
    <button id="submitButton">
        Submit
    </button>
    <p id="result"></p>

    JavaScript:
    let button = document.getElementById("submitButton");
    button.addEventListener("click", function() {
        let name = document.getElementById("name").value;
        document.getElementById("result").textContent =
            `Welcome, ${name}!`;
    });

    - submit = form di kirim
    <form id="cinderellaForm">
    <input type="text" id="name">
    <button type="submit">
        Submit
    </button>
    </form>

    JavaScript:
    let form = document.getElementById("cinderellaForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        let name = document.getElementById("name").value;
        alert(`Welcome, ${name}!`);
    });

    event.preventDefault() digunakan agar browser tidak melakukan aksi default form, seperti reload halaman.

    - input =user mengetik / real time DOM manipulation

    <input type="text" id="name">
    <p id="result"></p>
    
    JavaScript:
    let input = document.getElementById("name");
    let result = document.getElementById("result");
    input.addEventListener("input", function() {
        result.textContent = input.value;
    });

    - cek validasi
    <form id="myForm">
    <input type="text" id="nama" required>
    <input type="email" id="email" required>
    <button type="submit">Lanjut</button>
    </form>

    <script>
    document.getElementById("myForm").addEventListener("submit", function(e) {
        e.preventDefault();
        if (this.checkValidity()) {
            window.location.href = "halaman2.html";
        } else {
            this.reportValidity();
        }
    });
    </script>

    - cek keyboard input
    <input type="text" id="cari">
 

    JavaScript:

    JavaScript
    document.getElementById("cari").addEventListener("keydown", function(event) {
      if (event.key === "Enter") {
        alert("Anda menekan Enter");
    }
    console.log("Tombol ditekan:", event.key);
     
    });

    - arrow function
    document.getElementById("btn").addEventListener("click", () => {
    alert("Hello World");
    });



Local Storage

    - Multi-Step Form Sederhana
     Di halaman1.html:
    <form id="dataForm">
    <input type="text" id="nama" required>
    <input type="email" id="email" required>
    <button type="submit">Next</button>
    </form>
     
    <script>
    const form = document.getElementById("dataForm");
    form.addEventListener("submit", function(e) {
    e.preventDefault();
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
     
    localStorage.setItem("nama",
    document.getElementById("nama").value);
    localStorage.setItem("email",
    document.getElementById("email").value);
     
    window.location.href = "halaman2.html";
    });
    </script>
     

    Di halaman2.html:

    JavaScript
    const nama = localStorage.getItem("nama");
    const email = localStorage.getItem("email");
     
    console.log(nama);
    console.log(email); 

    - load =  berjalan ketika seluruh halaman selesai dimuat:
        window.addEventListener("load", () => {
        console.log("Semua resource telah dimuat");
        });

    - DOMContentLoaded = Tidak menunggu gambar selesai dimuat.
        <h1 id="judul">Hello</h1>
 
        <script>
        document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("judul").textContent = "Selamat Datang";
        });
        </script>
         


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

-->