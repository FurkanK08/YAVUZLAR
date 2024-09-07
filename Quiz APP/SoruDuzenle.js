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

const KaydetElement=document.getElementById("kaydet");
const IptalElement=document.getElementById("iptal");
var soruDuzenleElement=document.getElementById("soru-I");
var AElement=document.getElementById("A-I");
var BElement=document.getElementById("B-I");
var CElement=document.getElementById("C-I");
var DElement=document.getElementById("D-I");
var EElement=document.getElementById("E-I");
var soruElement=document.getElementById("soru");
var aElement=document.getElementById("a");
var bElement=document.getElementById("b");
var cElement=document.getElementById("c");
var dElement=document.getElementById("d");
var eElement=document.getElementById("e");
var soru_no = localStorage.getItem("soru");
yazdır();
KaydetElement.addEventListener("click",function(event){
    event.preventDefault();
    const DogruCevapElement=document.querySelector('input[name="cevap"]:checked');
    var DogruCevap= DogruCevapElement.value;
    sorular[soru_no-1].soru=soruDuzenleElement.value;
    sorular[soru_no-1].cevaplar[0].text=AElement.value;
    sorular[soru_no-1].cevaplar[1].text=BElement.value;
    sorular[soru_no-1].cevaplar[2].text=CElement.value;
    sorular[soru_no-1].cevaplar[3].text=DElement.value;
    sorular[soru_no-1].cevaplar[4].text=EElement.value;
    for (let i = 0; i < 5; i++) {
        if((i+1)==DogruCevap){ 
            sorular[soru_no-1].cevaplar[i].correct=true;
        }
        else{
            sorular[soru_no-1].cevaplar[i].correct=false;
        }}
    console.log(sorular[soru_no-1]);
    yazdır();
    
    
})
IptalElement.addEventListener("click",function(event){
    event.preventDefault();
    localStorage.removeItem("soru");
    window.location="soruAra.html";
    
});
function yazdır(){
    for (let i = 0; i < sorular.length; i++) {
        if(i==soru_no-1){
            soruElement.innerHTML=sorular[i].soru;
            A.innerHTML = sorular[i].cevaplar[0].text;
            B.innerHTML = sorular[i].cevaplar[1].text;
            C.innerHTML = sorular[i].cevaplar[2].text;
            D.innerHTML = sorular[i].cevaplar[3].text;
            E.innerHTML = sorular[i].cevaplar[4].text;
        }
        else{
            continue;
        }
    }
    
}



