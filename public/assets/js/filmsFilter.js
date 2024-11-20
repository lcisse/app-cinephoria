document.addEventListener('DOMContentLoaded', function () {
    const radioCinemas = document.querySelectorAll('input[type="radio"].cinema-radio');
    const genreCheckboxes = document.querySelectorAll('input[type="checkbox"].genre-checkbox');
    const dayCheckboxes = document.querySelectorAll('input[type="checkbox"].day-checkbox');
    const movieContainer = document.querySelector('#all-films-list .row');
    const BASE_URL = document.getElementById('all-films-list').getAttribute('data-base-url').toLowerCase();
    const navPagination = document.getElementById('navPagination');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    let currentCinema = null; // Variable pour stocker le cinéma sélectionné

    window.addEventListener('pageshow', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        radioCinemas.forEach(checkbox => {
            checkbox.checked = false;
        });
    });

    // Fonction pour charger les films par cinéma via AJAX
    function fetchMoviesByCinema(cinemaName, selectedGenres, selectedDays) {
        fetch(`index.php?action=filterMoviesByCinema&cinema_name=${cinemaName}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateMovies(data.movies, selectedGenres, selectedDays);
                } else {
                    console.error('Erreur lors du chargement des films:', data.message);
                }
            })
            .catch(error => console.error('Erreur AJAX:', error));
    }

    // Mettre à jour les films affichés dans le conteneur
    function updateMovies(movies, selectedGenres = [], selectedDays = []) {
        
        if (movies.length > 0 || currentCinema !== null) {
            movieContainer.innerHTML = ''; // Effacer les anciens films uniquement si un cinéma est sélectionné
            navPagination.innerHTML = '';
        }
        // movieContainer.innerHTML = ''; // Effacer les anciens films
        movies.forEach(movie => {
            const movieGenres = movie.genre.toLowerCase().split(', ');
            const movieDays = movie.screening_days.toLowerCase().split(', ').map(normalizeDays);
            const normalizedSelectedDays = selectedDays.map(normalizeDays);
            
            
            // Appliquer les filtres des genres et des jours
            const matchesGenre =
            selectedGenres.length === 0 ||
            selectedGenres.some(genre => movieGenres.includes(genre));
            const matchesDay =
            normalizedSelectedDays.length === 0 ||
            normalizedSelectedDays.some(day => movieDays.includes(day));

            if (matchesGenre && matchesDay) {
                const movieCard = `
                    <div class="col movie-card" 
                         data-movie-id="${movie.id}" 
                         data-cinema="${movie.cinema.toLowerCase()}" 
                         data-genre="${movie.genre.toLowerCase()}" 
                         data-day="${movie.screening_days.toLowerCase()}">
                        <div class="card h-100 d-flex flex-column position-relative">
                            <img src="${BASE_URL}/public/${movie.poster}" class="card-img-top" alt="${movie.title}">
                            <div class="card-body flex-grow-1 position-relative">
                                <h3 class="card-title">${movie.title}</h3>
                                <p class="card-text">${truncateText(movie.description, 120)}</p>
                            </div>
                            <div class="card-body mt-auto flex-grow-0">
                                <a class="btn prim" href="${BASE_URL}/index.php?action=seances&movie_id=${movie.id}&cinema_id=${movie.cinema_id}">Séances</a>
                            </div>
                        </div>
                    </div>`;
                movieContainer.insertAdjacentHTML('beforeend', movieCard);
            }
        });
    }

    // Fonction pour obtenir les valeurs sélectionnées des checkboxes
    function getSelectedValues(checkboxes) {
        return Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value.toLowerCase());
    }

    // Fonction pour appliquer tous les filtres
    function applyFilters() {
        const selectedCinema = currentCinema; // Utiliser le cinéma actuel ou une valeur par défaut
        const selectedGenres = getSelectedValues(genreCheckboxes);
        const selectedDays = getSelectedValues(dayCheckboxes);

        fetchMoviesByCinema(selectedCinema, selectedGenres, selectedDays); // Charger les films avec les filtres
    }

    // Gestion des événements des boutons radio (cinéma)
    radioCinemas.forEach(radio => {
        radio.addEventListener('change', function () {
            if (radio.checked) {
                currentCinema = radio.value; // Mettre à jour le cinéma sélectionné
                applyFilters(); // Appliquer les filtres
            }
        });
    });

    // Gestion des événements des checkboxes (genres et jours)
    genreCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    dayCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    function normalizeDays(day) {
        const daysMap = {
            monday: 'lundi',
            tuesday: 'mardi',
            wednesday: 'mercredi',
            thursday: 'jeudi',
            friday: 'vendredi',
            saturday: 'samedi',
            sunday: 'dimanche'
        };
    
        return daysMap[day.toLowerCase()] || day.toLowerCase();
    }

    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        }
        return text;
    }

    // Appliquer les filtres une fois au chargement
    applyFilters();
});



