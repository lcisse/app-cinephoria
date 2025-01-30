document.addEventListener('DOMContentLoaded', function () {
    const cinemaSelect = document.getElementById('cinema');
    const roomSelect = document.getElementById('room-number');
    const selectedRoomId = roomSelect ? roomSelect.getAttribute('data-selected-room') : ""; 

    // Initialiser le sélecteur des salles avec une option par défaut désactivée
    function initializeRoomSelect() {
        if(roomSelect) {
            roomSelect.innerHTML = '<option value="" disabled selected>Sélectionnez d\'abord un cinéma</option>';
            roomSelect.setAttribute('disabled', 'disabled'); // Désactiver par défaut
        }
        
    }

    // Récupérer les données JSON des cinémas et salles
    const cinemaRooms = cinemaSelect ?  JSON.parse(cinemaSelect.getAttribute('data-cinemas')) : null;
  

    // Mettre à jour les options des salles en fonction du cinéma sélectionné
    cinemaSelect?.addEventListener('change', function () {
        const selectedCinemaId = this.value;

        // Réinitialiser les options des salles
        roomSelect.innerHTML = '<option value="" disabled selected>Sélectionnez une salle</option>';

        if (cinemaRooms[selectedCinemaId]) {
            // Ajouter les salles correspondantes
            cinemaRooms[selectedCinemaId].forEach(room => {
                const option = document.createElement('option');
                option.value = room.id + ',' + room.capacity;
                console.log(option.value);
                option.textContent = room.number ? `Salle ${room.number}` : `Aucune salle pour ce cinéma`;
                roomSelect.appendChild(option);

                // Pré-sélectionner la salle si elle correspond à l'ID prérempli
                if (room.id == selectedRoomId) {
                    option.selected = true;
                }
            });

            // Activer le sélecteur des salles
            roomSelect.removeAttribute('disabled');
        } else {
            // Si aucun cinéma sélectionné, réinitialiser le sélecteur des salles
            initializeRoomSelect();
        }
    });

    // Initialiser avec l'état par défaut
    initializeRoomSelect();

    // Déclencher l'événement 'change' manuellement pour gérer les préremplissages au chargement
    if(cinemaSelect) {
        cinemaSelect.dispatchEvent(new Event('change'));
    }
        
});