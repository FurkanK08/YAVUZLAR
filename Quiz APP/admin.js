const soru_ekle= document.getElementById("soru-ekle");
const soru_ara= document.getElementById("soru-ara");
function GoToSoruAra(){ 
    window.location.href = "soruAra.html";
}
function GoToSoruEkle(){
    window.location.href = "soruEkle.html";
}
soru_ekle.addEventListener("click", GoToSoruEkle);
soru_ara.addEventListener("click", GoToSoruAra);