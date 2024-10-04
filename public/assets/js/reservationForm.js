document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const createAccountForm = document.getElementById("createAccountForm");
    const loginBtn = document.getElementById("loginBtn");
    const createAccountBtn = document.getElementById("createAccountBtn");


    
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

    /* **************************Section plan and log************************ */
    const seatsSection = document.getElementById("seats-section");
    const logSection = document.getElementById("log");
    const reserveBtn = document.getElementById("reserveBtn");

    // Fonction pour basculer entre les sections avec une transition fluide
    function switchSection() {
        seatsSection.classList.remove("active");
        logSection.classList.add("active");

      
        logSection.scrollIntoView({ behavior: 'smooth' });
    }


    reserveBtn.addEventListener("click", function () {
        fetch("index.php?action=checkAuthentication") 
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.isAuthenticated) {
                    window.location.href = "index.php?action=recapCommande";
                } else {
                    switchSection();
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    });
});