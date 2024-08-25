const admin_panel= document.getElementById("admin");
const quiz_panel= document.getElementById("quiz");

function GoTOAdminLogin(){
    window.location.href = "AdminLogin.html";
}
function GoTOQuizPanel(){
    window.location.href = "QuizPage.html";
}

admin_panel.addEventListener("click", GoTOAdminLogin);
quiz_panel.addEventListener("click", GoTOQuizPanel);