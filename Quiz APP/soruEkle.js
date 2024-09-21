var sorular = [];

const soruEkle= document.getElementById("soru-ekle");
const soru= document.getElementById("soru-ekle-input");
const CevapElement1= document.getElementById("cevap-ekle-input1");
const CevapElement2= document.getElementById("cevap-ekle-input2");
const CevapElement3= document.getElementById("cevap-ekle-input3");
const CevapElement4= document.getElementById("cevap-ekle-input4");
const CevapElement5= document.getElementById("cevap-ekle-input5");

soruEkle.addEventListener("click", () => {
    const DogruCevapElement= document.querySelector('input[name="cevap"]:checked');

    var soru1= soru.value;
    var Cevap1= CevapElement1.value;
    var Cevap2= CevapElement2.value;
    var Cevap3= CevapElement3.value;
    var Cevap4= CevapElement4.value;
    var Cevap5= CevapElement5.value;
    var DogruCevap= DogruCevapElement.value;
    var dogruCevapArray= [];
    for (let i = 0; i < 5; i++) {
   if((i+1)==DogruCevap){ 
       dogruCevapArray.push(true);
   }
   else{
       dogruCevapArray.push(false);
   }

   } 
    sorular.push({
        soru: soru1,
        cevaplar:[
            {text: Cevap1, correct: dogruCevapArray[0]},
            {text: Cevap2, correct: dogruCevapArray[1]},
            {text: Cevap3, correct: dogruCevapArray[2]},
            {text: Cevap4, correct: dogruCevapArray[3]},
            {text: Cevap5, correct: dogruCevapArray[4]}
        ]
    })

});