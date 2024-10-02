document.addEventListener("DOMContentLoaded", function () {
    // Sélection des éléments
    const loginForm = document.getElementById("loginFormAccount");
    const createAccountForm = document.getElementById("createFormAccount");
    const loginBtn = document.getElementById("loginBtn1");
    const createAccountBtn = document.getElementById("createAccountBtn1");


    // Fonction pour afficher le formulaire de connexion et masquer celui de création
    function showLoginForm() {
        loginForm.style.display = "block"; // Affiche le formulaire de connexion
        createAccountForm.style.display = "none"; // Masque le formulaire de création
        loginBtn.classList.add("active"); // Active le bouton de connexion
        createAccountBtn.classList.remove("active"); // Désactive le bouton de création
    }

    // Fonction pour afficher le formulaire de création et masquer celui de connexion
    function showCreateAccountForm() {
        loginForm.style.display = "none"; // Masque le formulaire de connexion
        createAccountForm.style.display = "block"; // Affiche le formulaire de création
        loginBtn.classList.remove("active"); // Désactive le bouton de connexion
        createAccountBtn.classList.add("active"); // Active le bouton de création
    }

    // Ajouter les événements de clic aux boutons
    loginBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Empêche le rechargement de la page
        showLoginForm(); // Affiche le formulaire de connexion
    });

    createAccountBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Empêche le rechargement de la page
        showCreateAccountForm(); // Affiche le formulaire de création
    });

    // Afficher le formulaire de connexion par défaut
    showLoginForm();
});