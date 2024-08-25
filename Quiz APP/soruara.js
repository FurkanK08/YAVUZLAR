
const sorular = [
    {
        soru: "Hangisi bir sürüngendir?",
        cevaplar:[
            {text:"yılan", correct: true},
            {text:"kedi", correct: false},
            {text:"balık", correct: false},
            {text:"kopek", correct: false},
            {text:"at", correct: false}
        ]
    },
    {
        soru:"5+9=?",
        cevaplar:[
            {text:"14", correct: true},
            {text:"15", correct: false},
            {text:"16", correct: false},
            {text:"17", correct: false},
            {text:"18", correct: false}
        ]
    }
    ,{
        soru: "21+56=?",
        cevaplar:[
            {text:"77", correct: true},
            {text:"66", correct: false},
            {text:"547", correct: false},
            {text:"32", correct: false},
            {text:"67", correct: false}
        ]
    }
    ,{
        soru: "hangisi bir memelidir?",
        cevaplar:[
            {text:"kedi", correct: true},
            {text:"balık", correct: false},
            {text:"yılan", correct: false},
            {text:"kertenkele", correct: false},
            {text:"amip", correct: false}]
    },{
        soru: "89+11=?",
        cevaplar:[
            {text:"100", correct: true},
            {text:"90", correct: false},
            {text:"91", correct: false},
            {text:"92", correct: false},
            {text:"93", correct: false}
        ]
    }
  ]
var soru_no = document.getElementById("soru-ara");
var arama= document.querySelector("#ara");

arama.addEventListener("click",function Arama(){
    if(soru_no.value=="" || soru_no.value>sorular.length){
        window.alert("Hatalı Giriş yaptınız.");
    }
    else{
        td = document.getElementById("soru");
        td.innerHTML = sorular[soru_no.value-1].soru;
        localStorage.setItem("soru", soru_no.value);
        let soruNo=localStorage.getItem("soru");
        console.log(soruNo);
      
    } }
  );
  var sil = document.querySelector("#sil");
  sil.addEventListener("click",function(){
    sorular.splice(soru_no.value-1,1);
    window.alert("soru silindi");
  }
  );
  var detay = document.getElementById("detay");
  detay.addEventListener("click",function(){
    window.location.href = "SoruDetay.html";
  }
  );

  var duzenle = document.getElementById("duzenle");
  duzenle.addEventListener("click",function(){
    window.location.href = "SoruDüzenle.html";
  }
  );

  
  localStorage.removeItem("soru")