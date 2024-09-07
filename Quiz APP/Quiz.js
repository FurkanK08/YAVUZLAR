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
const soruElement= document.getElementById("soru");
const cevaplarElements= document.getElementById("cevaplar-c");
const sonrakiElement= document.getElementById("sonraki");

let index=0;

function quizBaslat(){
    soruNumarası=0;
    puan=0;
    sonrakiElement.innerHTML="sonraki";
    soruGoster();
 }
 function soruGoster(){
    index=Math.floor(Math.random()*sorular.length);
    resetState(); 
    let currentSoru= sorular[index];
    soruNumarası++;
    soruElement.innerHTML= soruNumarası + ". " + currentSoru.soru;
    currentSoru.cevaplar.forEach(cevap => {
        const button= document.createElement("button");
        button.innerHTML= cevap.text;
        button.classList.add("cevaplar-btn");
        cevaplarElements.appendChild(button);
        if(cevap.correct){
            button.dataset.correct=cevap.correct;
        }
        
        button.addEventListener("click",cevapKontrol);
        
    });
    
 }
 function cevapKontrol(e){
    const buttonsec= e.target;
    const dogrumu= buttonsec.dataset.correct;
    if(dogrumu){
        buttonsec.classList.add("correct");
        puan++;
    }else{
        buttonsec.classList.add("incorrect");
    }
    Array.from(cevaplarElements.children).forEach(button =>{
        if(button.dataset.correct){
            button.classList.add("correct");
        }
        button.disabled=true;
        sonrakiElement.style.display="block";
    });
 }
function resetState(){
    sonrakiElement.style.display="none";
    while(cevaplarElements.firstChild){
        cevaplarElements.removeChild(cevaplarElements.firstChild); 
     }
};
sonrakiElement.addEventListener("click",function(){
    if(soruNumarası  <sorular.length){
        soruGoster();
    }else{
        PuanGoster();
    }
});

function PuanGoster(){
    resetState();
    soruElement.innerHTML= "Puanınız:" + puan ;
    sonrakiElement.innerHTML= "tekrar dene";
    sonrakiElement.addEventListener("click",quizBaslat);
    sonrakiElement.style.display="block";
 }
quizBaslat();
