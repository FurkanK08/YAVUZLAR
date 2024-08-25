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
var soru_no = localStorage.getItem("soru");
var A=document.getElementById("A");
var B=document.getElementById("B");
var C=document.getElementById("C");
var D=document.getElementById("D");
var E=document.getElementById("E");
console.log(soru_no);
for (let i = 0; i < sorular.length; i++) {
    if(i==soru_no-1){
        document.getElementById("soru").innerHTML = sorular[i].soru;
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
localStorage.removeItem("soru");