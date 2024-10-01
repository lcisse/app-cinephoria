/*document.addEventListener("DOMContentLoaded", function () {
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
});*/




document.addEventListener("DOMContentLoaded", function () {
    const seatPlanContainer = document.getElementById("seatPlanContainer");
    const seatCounter = document.getElementById("selectedCount");
    const selectedSeats = document.getElementById("selectedSeatNumbers");
    const screeningId = document.querySelector(".rooms-seats").getAttribute("data-screening-id");
    const counterSelectedBtn = document.getElementById("counter-selected-btn");

    let totalSeats = 0;
    let selectedSeatNumbers = [];

    // Fonction pour générer le plan de salle avec les icônes SVG
    function generateSeatPlan(seatsData) {
        let seatPlanHTML = '<div class="row seat-plan-row">'; // Commence une nouvelle ligne de sièges
        seatsData.forEach((seat, index) => {
            const isReserved = seat.reserved === 1; // Siège réservé
            const isAccessible = seat.is_accessible === 1; // Siège pour PMR (Personne à Mobilité Réduite)
            const seatLabel = seat.seat_number; // Numéro du siège

            // Générer le HTML pour un siège avec l'icône SVG
            seatPlanHTML += `
                <div class="seat">
                    <label for="seat-${seat.id}" class="seat-icon ${isReserved ? 'reserved' : 'available'} ${isAccessible ? 'accessible' : ''}" data-seat-number="${seatLabel}">
                        ${isAccessible ? accessibleSeatIcon : normalSeatIcon}
                    </label>
                </div>`;

            // Fermer la ligne après chaque 10 sièges
            if ((index + 1) % 10 === 0) {
                seatPlanHTML += '</div><div class="row seat-plan-row">';
            }
        });

        seatPlanHTML += "</div>"; // Ferme la dernière ligne de sièges
        seatPlanContainer.innerHTML = seatPlanHTML; // Injecte le plan de salle dans le HTML

        // Attacher des gestionnaires d'événements pour sélectionner les sièges
        attachSeatClickHandlers();
    }

    // Fonction pour charger les sièges depuis la base de données
    function loadSeats(screeningId) {
        fetch(`index.php?action=getSeats&screening_id=${screeningId}`)
            .then(response => response.json())
            .then(data => {
                generateSeatPlan(data); // Génère le plan de salle avec les données reçues
            })
            .catch(error => console.error('Erreur lors de la récupération des sièges :', error));
    }

    // Gestionnaire de clics pour sélectionner/désélectionner les sièges
    function attachSeatClickHandlers() {
        /*const seatIcons = document.querySelectorAll(".seat-icon.available");
        seatIcons.forEach(seatIcon => {
            seatIcon.addEventListener("click", function () {
                const isSelected = seatIcon.classList.contains("selected");

                if (isSelected) {
                    seatIcon.classList.remove("selected");
                } else {
                    seatIcon.classList.add("selected");
                }

                updateSeatSelection();
            });
        });*/

        const seatIcons = document.querySelectorAll(".seat-icon.available, .seat-icon.accessible"); // Cibler les sièges disponibles ET accessibles
        seatIcons.forEach(seatIcon => {
            seatIcon.addEventListener("click", function () {
                const isReserved = seatIcon.classList.contains("reserved");
                const isSelected = seatIcon.classList.contains("selected");

                // Si le siège n'est pas réservé (non cliquable), changer la couleur au clic
                if (!isReserved) {
                    if (isSelected) {
                        seatIcon.classList.remove("selected");
                    } else {
                        seatIcon.classList.add("selected");
                    }

                    updateSeatSelection();
                }
            });
        });
    }

    // Fonction pour mettre à jour le compteur de sièges sélectionnés
    function updateSeatSelection() {
        const selectedSeatsElements = document.querySelectorAll(".seat-icon.selected");
        totalSeats = selectedSeatsElements.length;
        selectedSeatNumbers = Array.from(selectedSeatsElements).map(seat => seat.getAttribute("data-seat-number"));

        seatCounter.innerText = `${totalSeats}`;
        selectedSeats.innerText = `${selectedSeatNumbers.length > 0 ? selectedSeatNumbers.join(", ") : "Aucun"}`;
        if (totalSeats > 0) {
            // Afficher le bloc avec effet de fondu
            counterSelectedBtn.style.display = 'block'; 
            setTimeout(() => {
                counterSelectedBtn.style.opacity = 1;
            }, 10); // Petit délai pour l'effet de transition
    
            // Faire un défilement fluide vers le bas du bloc
            counterSelectedBtn.scrollIntoView({ behavior: 'smooth', block: 'end' });
        } else {
            // Faire disparaître le bloc en douceur
            counterSelectedBtn.style.opacity = 0;
            setTimeout(() => {
                counterSelectedBtn.style.display = 'none'; // Cacher après la transition
            }, 500); // Correspond à la durée de la transition d'opacité (0.5s)
        }
    }

    // Charger les sièges lors du chargement de la page
    loadSeats(screeningId);
});

// Icône SVG pour un siège normal
const normalSeatIcon = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
    <path d="M70,50v17c0,1.1-0.9,2-2,2h-6V50c0-1.1,0.9-2,2-2h4C69.1,48,70,48.9,70,50z M37,48h-4c-1.1,0-2,0.9-2,2v17c0,1.1,0.9,2,2,2  h6V50C39,48.9,38.1,48,37,48z M65,46V34c0-1.7-1.3-3-3-3H39c-1.7,0-3,1.3-3,3v12h1c2.2,0,4,1.8,4,4v2h19v-2c0-2.2,1.8-4,4-4H65z   M40,69h21V54H40V69z"/>
</svg>`;

// Icône SVG pour un siège pour personnes à mobilité réduite
const accessibleSeatIcon = `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 640">
    <path d="M384,159c0-16.6-13.4-30-30-30H158c-16.6,0-30,13.4-30,30v196c0,16.6,13.4,30,30,30h196c16.6,0,30-13.4,30-30V159z   M229.4,161.5c8.8,0,16,7.2,16,16c0,8.8-7.2,16-16,16c-8.8,0-16-7.2-16-16C213.4,168.7,220.6,161.5,229.4,161.5z M293.8,313.8  c-7.5,22.4-29,38.4-54.1,37.7c-29.5-0.8-53.4-25-53.9-54.5c-0.2-15.8,6.1-30.1,16.5-40.3c4.1-4.1,11.1-1.6,11.9,4.1  c0.3,2.3-0.5,4.6-2.2,6.2c-7.5,7.5-12.1,17.8-12.1,29.2c0,23.4,19.5,42.3,43.1,41.2c17.3-0.8,31.9-12.4,37.2-28.1  c1.6-4.8,7.7-6.3,11.5-2.8C293.9,308.3,294.7,311.2,293.8,313.8z M321.8,330.2c-3.5,1.1-7.2-0.5-8.9-3.7l-25.7-50.2  c-1.3-2.5-3.9-4.3-6.7-4.3h-37.1c-11.3,0-20.8-8.1-22.3-19.3l-5.2-40c-0.9-7.1,4.6-13.3,11.7-13.3c5.2,0,9.8,3.4,11.3,8.4l7.6,25.2  c1.2,4.1,5,7,9.2,7h11.8c3.6,0,6.9,1.8,8.6,5c1.6,3.2,4.9,5,8.6,5h8.1c3,0,5.8,2,6.9,4.8l26.8,65.3  C328.1,324.2,325.9,328.8,321.8,330.2z"/>
</svg>`;