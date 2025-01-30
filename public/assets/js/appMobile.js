document.addEventListener("DOMContentLoaded", () => {
    const isStandalone =
    window.matchMedia("(display-mode: standalone)").matches ||
    window.navigator.standalone === true;
    

    if (isStandalone) {
        const navbar = document.getElementById("navbarTop");
        const footer = document.getElementById("footer");
        const webApp = document.getElementById("web-app");
        const adminContainer = document.getElementById("admin-container");
    
        if (navbar) navbar.style.display = "none";
        if (footer) footer.style.display = "none";
        if (webApp) webApp.style.marginTop = "30px";
        if (adminContainer) adminContainer.style.marginTop = "30px";
      }

      
});


// ********** Manager serviceWorker
const screeningsData = document.getElementById("web-app");
const screeningsData1 = document.getElementById("logs");
let BASE_URL ;

if(screeningsData) {
    BASE_URL = screeningsData.getAttribute('data-base-url');
}

if(screeningsData1) {
    BASE_URL = screeningsData1.getAttribute('data-base-url');
}

if(screeningsData || screeningsData1) {
  if ("serviceWorker" in navigator) {
      navigator.serviceWorker
        .register(BASE_URL + "/public/assets/js/serviceWorker.js")
        .then((registration) => {
          console.log("Service Worker enregistré avec succès :", registration.scope);
        })
        .catch((error) => {
          console.error("Échec de l'enregistrement du Service Worker :", error);
        });
    } else {
      console.log("Service Worker non supporté par ce navigateur.");
  }
}
