document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginFormAccount");
    const createAccountForm = document.getElementById("createFormAccount");
    const loginBtn = document.getElementById("loginBtn1");
    const createAccountBtn = document.getElementById("createAccountBtn1");


    function showLoginForm() {
        loginForm.style.display = "block";
        createAccountForm.style.display = "none"; 
        loginBtn.classList.add("active"); 
        createAccountBtn.classList.remove("active"); 
    }

    function showCreateAccountForm() {
        loginForm.style.display = "none"; 
        createAccountForm.style.display = "block"; 
        loginBtn.classList.remove("active"); 
        createAccountBtn.classList.add("active"); 
    }

    loginBtn.addEventListener("click", function (event) {
        event.preventDefault(); 
        showLoginForm(); 
    });

    createAccountBtn.addEventListener("click", function (event) {
        event.preventDefault(); 
        showCreateAccountForm(); 
    });

    showLoginForm();
});