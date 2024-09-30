document.addEventListener("DOMContentLoaded", function () {
    const dayButtonsContainer = document.getElementById("day-buttons-container");
    const screeningsContainer = document.getElementById("screenings-container");
    const screeningsData = document.getElementById("screenings-data");
    const BASE_URL = screeningsData.getAttribute('data-base-url');

    const movieId = screeningsData.getAttribute("data-movie-id");
    const todayDate = new Date(); // Obtenir la date actuelle

    const daysOfWeek = ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'];
    const monthNames = ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juill.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'];

    // Fonction pour formater la date sous forme "21 SEPT"
    function formatDate(date) {
        const day = date.getDate(); // Jour du mois
        const month = monthNames[date.getMonth()]; // Mois (nom court)
        return `${day} ${month}`;
    }

    // Fonction pour créer les boutons pour les 7 prochains jours
    function generateDayButtons() {
        for (let i = 0; i < 7; i++) {
            const date = new Date(todayDate); // Créer une nouvelle date à partir d'aujourd'hui
            date.setDate(todayDate.getDate() + i); // Ajouter i jours à la date

            const dayOfWeek = daysOfWeek[date.getDay()]; // Jour de la semaine
            const formattedDate = formatDate(date); // Formater la date

            let buttonLabel = "";
            if (i === 0) {
                buttonLabel = "Aujourd'hui";
            } else if (i === 1) {
                buttonLabel = "Demain";
            } else {
                buttonLabel = `${dayOfWeek} ${formattedDate}`; // Ex: "Sam. 21 Sept."
            }

            // Créer un bouton
            const button = document.createElement("button");
            button.classList.add("btn", "btn-primary");
            if (i === 0) button.classList.add("active"); // Activer le bouton d'aujourd'hui par défaut
            button.setAttribute("data-day", date.toISOString().split('T')[0]); // Date formatée en YYYY-MM-DD
            button.textContent = buttonLabel;

            // Ajouter l'événement de filtre des séances
            button.addEventListener("click", function () {
                // Charger les séances pour la date sélectionnée
                loadScreenings(movieId, button.getAttribute("data-day"));

                // Mettre à jour le bouton actif
                document.querySelectorAll('#day-buttons button').forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");
            });

            // Ajouter le bouton au conteneur
            dayButtonsContainer.appendChild(button);
        }
    }

    // Fonction pour charger les séances via AJAX
    function loadScreenings(movieId, date) {
        fetch(`index.php?action=getScreenings&movie_id=${movieId}&date=${date}`)
            .then((response) => response.json())
            .then((data) => {
                // Vider le conteneur des séances avant d'en insérer de nouvelles
                screeningsContainer.innerHTML = "";
                console.log(data);

                // Insérer les nouvelles séances
                data.forEach((screening) => {
                    const screeningHTML = `
                        <div class="col">
                        <a href="${BASE_URL}/index.php?action=reservationsSeats&screening_id=${screening.id}">
                            <div class="card position-relative">
                                <div class="card-body text-center">
                                    <h5 class="card-title">${screening.start_time}</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">(fin ${screening.end_time})</h6>
                                    <p class="card-text">Salle ${screening.room_number}</p>
                                </div>
                                <span class="position-absolute top-0 start-0 badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 b-quality">${screening.projection_quality}</span>
                            </div>
                        </a>    
                        </div>`;
                    screeningsContainer.innerHTML += screeningHTML;
                });
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des séances :", error);
            });
    }

    // Générer les boutons des jours dynamiquement
    generateDayButtons();

    // Charger les séances d'aujourd'hui par défaut
    loadScreenings(movieId, todayDate.toISOString().split('T')[0]);
});