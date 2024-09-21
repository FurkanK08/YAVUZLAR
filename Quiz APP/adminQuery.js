const gonderElement= document.getElementById("login-btn");
const usernameElement= document.getElementById("username");
const passwordElement= document.getElementById("password");




gonderElement.addEventListener("click",()=>{
 let username="admin";
let password="admin123";
var inputUsername= usernameElement.value;
var inputPassword= passwordElement.value;
console.log(inputUsername);
console.log(inputPassword);

    if(username==inputUsername && password==inputPassword){
        window.location.href = "AdminPanel.html";
    }
    else{
        alert("Hatalı giriş yaptınız.");
    }
    
});
