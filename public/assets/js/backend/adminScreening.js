/*document.addEventListener('DOMContentLoaded', function () {
    const cinemaSelect = document.getElementById('cinema');
    const roomSelect = document.getElementById('room-number');

    // Récupérer les données JSON depuis l'attribut data-cinemas
    const cinemaRooms = JSON.parse(cinemaSelect.getAttribute('data-cinemas'));

    // Mettre à jour les salles en fonction du cinéma sélectionné
    cinemaSelect.addEventListener('change', function () {
        const selectedCinemaId = this.value;

        // Vider les options actuelles des salles
        roomSelect.innerHTML = '<option value="">Sélectionnez une salle</option>';

        // Si un cinéma est sélectionné, afficher les salles correspondantes
        if (cinemaRooms[selectedCinemaId]) {
            cinemaRooms[selectedCinemaId].forEach(room => {
                const option = document.createElement('option');
                option.value = room.id;
                option.textContent = `Salle ${room.number}`;
                roomSelect.appendChild(option);
            });
        }
    });
});*/

document.addEventListener('DOMContentLoaded', function () {
    const cinemaSelect = document.getElementById('cinema');
    const roomSelect = document.getElementById('room-number');
    const selectedRoomId = roomSelect.getAttribute('data-selected-room');  // Nouvelle variable pour stocker l'ID de la salle préremplie

    // Récupérer les données JSON depuis l'attribut data-cinemas
    const cinemaRooms = JSON.parse(cinemaSelect.getAttribute('data-cinemas'));

    // Mettre à jour les salles en fonction du cinéma sélectionné
    cinemaSelect.addEventListener('change', function () {
        const selectedCinemaId = this.value;

        // Vider les options actuelles des salles
        roomSelect.innerHTML = '<option value="">Sélectionnez une salle</option>';

        // Si un cinéma est sélectionné, afficher les salles correspondantes
        if (cinemaRooms[selectedCinemaId]) {
            cinemaRooms[selectedCinemaId].forEach(room => {
                const option = document.createElement('option');
                option.value = room.id;
                option.textContent = `Salle ${room.number}`;
                roomSelect.appendChild(option);

                // Sélectionner la salle si elle correspond à la salle préremplie
                if (room.id == selectedRoomId) {
                    option.selected = true;
                }
            });
        }
    });

    // Déclencher manuellement le changement pour sélectionner la bonne salle au chargement de la page
    cinemaSelect.dispatchEvent(new Event('change'));
});