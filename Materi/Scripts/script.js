function sayHello() {
            alert("Hello Cinderella2!");
            console.log("Hello World!");
        }


let greeting = "Hello!";
let character = "Prince Charming";

let age = 18;
let score = 95.4;

let isLoggedIn = false;
console.log(age);

// alert(character);
let nama = (4/3).toFixed(2);

document.getElementById("result").innerHTML = nama; //ubah text pada html
console.log(document.getElementById("result"));
let text = document.getElementsByName("test_para")[0]; //ambil text pada html
console.log(text);
text.innerHTML = text.textContent +"Hello World!"; //ubah text pada html

let kelas= document.getElementsByClassName("paragraf"); 
console.log(kelas[2].innerHTML);

let kelas2= document.querySelector(".paragraf"); 
console.log(kelas2.innerHTML);

let kelas3= document.querySelectorAll(".paragraf"); 
console.log(kelas3);

document.body.innerHTML += "<p> <hr><b>Ini adalah paragraf baru<hr></b>Dari JS<hr></p>";

let paragraf = document.getElementsByTagName("p");
console.log(paragraf)
let paragraf2 = document.querySelectorAll("p"); 
console.log(paragraf2)

// ==================================================================

let titleStyle = document.getElementById("title");
document.body.style.backgroundColor = "lightblue";
titleStyle.style.color = "purple";
titleStyle.style.fontSize = "40px";

function changeTitle() {
    document.getElementById("title").textContent =
        "Welcome to My World!";}

function ubahNama(){
    let name = document.getElementById("textInput2").value
    document.getElementById("nama").textContent =name;
}

function showArticle(artId){
    let article = document.querySelectorAll(".paragraf")
    article.forEach(
        function(art){
            art.style.display ="none";
        });
    document.getElementById(artId).style.display = "block";
}
showArticle("art1")

function goto(art){
    document.getElementById(art).scrollIntoView(
        {
            behavior:"smooth"
        }
    );
}

// ==================================================================
// Loop

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