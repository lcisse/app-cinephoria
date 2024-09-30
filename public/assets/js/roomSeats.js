document.addEventListener("DOMContentLoaded", function () {
    const seatPlanContainer = document.getElementById("seatPlanContainer");
    const seatCounter = document.getElementById("selectedCount");
    const selectedSeats = document.getElementById("selectedSeatNumbers");
    const screeningId = document.querySelector(".rooms-seats").getAttribute("data-screening-id"); // Récupère l'ID de la séance

    let totalSeats = 0;
    let selectedSeatNumbers = [];

    // Fonction pour générer le plan de salle avec les données reçues
    function generateSeatPlan(seatsData) {
        let seatPlanHTML = '<div class="row seat-plan-row">'; // Commence une nouvelle ligne de sièges
        seatsData.forEach((seat, index) => {
            const isReserved = seat.reserved === 1; // Siège réservé
            const isAccessible = seat.is_accessible === 1; // Siège pour PMR (Personne à Mobilité Réduite)
            const seatLabel = seat.seat_number; // Numéro du siège

            // Générer le HTML pour un siège
            seatPlanHTML += `
                <div class="seat">
                    <input type="checkbox" id="seat-${seat.id}" class="seat-checkbox" ${isReserved ? 'disabled' : ''}>
                    <label for="seat-${seat.id}" 
                           class="seat-icon ${isReserved ? 'reserved' : 'available'} ${isAccessible ? 'accessible' : ''}" 
                           data-seat-number="${seatLabel}">
                    </label>
                </div>`;

            // Fermer la ligne après chaque 10 sièges pour respecter la disposition
            if ((index + 1) % 10 === 0) {
                seatPlanHTML += '</div><div class="row seat-plan-row">';
            }
        });

        seatPlanHTML += "</div>"; // Ferme la dernière ligne de sièges
        seatPlanContainer.innerHTML = seatPlanHTML; // Injecte le plan de salle dans le HTML
    }

    // Fonction pour charger les sièges depuis la base de données
    function loadSeats(screeningId) {
        fetch(`index.php?action=getSeats&screening_id=${screeningId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Affiche les données reçues pour vérifier
                generateSeatPlan(data); // Génère le plan de salle avec les données reçues
            })
            .catch(error => console.error('Erreur lors de la récupération des sièges :', error));
    }

    // Fonction pour mettre à jour le compteur de sièges sélectionnés
    function updateSeatSelection() {
        const selectedSeatsElements = document.querySelectorAll(".seat-checkbox:checked");
        totalSeats = selectedSeatsElements.length;
        selectedSeatNumbers = Array.from(selectedSeatsElements).map(seat => seat.nextElementSibling.getAttribute("data-seat-number"));

        seatCounter.innerText = `${totalSeats}`;
        selectedSeats.innerText = `${selectedSeatNumbers.length > 0 ? selectedSeatNumbers.join(", ") : "Aucun"}`;
    }

    // Gérer les clics sur les sièges
    seatPlanContainer.addEventListener("change", function (event) {
        if (event.target.classList.contains("seat-checkbox")) {
            updateSeatSelection();
        }
    });

    // Charger les sièges lors du chargement de la page
    loadSeats(screeningId);
});