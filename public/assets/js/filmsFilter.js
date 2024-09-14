/*document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner toutes les checkbox et les éléments à filtrer
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const movieCards = document.querySelectorAll('.col');

        // Fonction pour appliquer les filtres
        function applyFilters() {
            const selectedCinemas = getSelectedValues('cinemas-genres-jours', 'cinema');
            const selectedGenres = getSelectedValues('cinemas-genres-jours', 'genre');
            const selectedDays = getSelectedValues('cinemas-genres-jours', 'day');

            movieCards.forEach(movie => {
                const movieCinema = movie.getAttribute('data-cinema');
                const movieGenre = movie.getAttribute('data-genre');
                const movieDay = movie.getAttribute('data-day');
            
                // Déterminer si des filtres sont appliqués
                const hasCinemaFilter = selectedCinemas.length > 0;
                const hasGenreFilter = selectedGenres.length > 0;
                const hasDayFilter = selectedDays.length > 0;
            
                // Vérifier si un filtre est activé
                const noFilterApplied = !hasCinemaFilter && !hasGenreFilter && !hasDayFilter;
            
                // Vérifier si le film correspond aux filtres sélectionnés
                const matchesCinema = !hasCinemaFilter || selectedCinemas.includes(movieCinema);
                const matchesGenre = !hasGenreFilter || selectedGenres.includes(movieGenre);
                const matchesDay = !hasDayFilter || selectedDays.includes(movieDay);
            
                // Si aucun filtre n'est appliqué, afficher tous les films
                if (noFilterApplied || (matchesCinema && matchesGenre && matchesDay)) {
                    movie.style.display = 'block';  // Afficher le film
                } else {
                    movie.style.display = 'none';  // Masquer le film
                }
            });
        }

        // Fonction pour obtenir les valeurs sélectionnées
        function getSelectedValues(className, attribute) {
            const selected = [];
            document.querySelectorAll(`.${className} input[type="checkbox"]:checked`).forEach(checkbox => {
                if (checkbox.name === attribute) {
                    selected.push(checkbox.value);
                }
            });
            return selected;
        }

        // Écouter les événements de changement sur les checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', applyFilters);
        });

        // Appliquer les filtres une fois au chargement
        applyFilters();
    });*/

    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner toutes les checkbox et les éléments à filtrer
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const movieCards = document.querySelectorAll('.movie-card');
    
        // Fonction pour appliquer les filtres
        function applyFilters() {
            const selectedCinemas = getSelectedValues('cinema-checkbox');
            const selectedGenres = getSelectedValues('genre-checkbox');
            const selectedDays = getSelectedValues('day-checkbox');

            console.log('Selected Cinemas:', selectedCinemas);
            console.log('Selected Genres:', selectedGenres);
            console.log('Selected Days:', selectedDays);
    
            movieCards.forEach(movie => {
                const movieCinema = movie.getAttribute('data-cinema').toLowerCase();
                const movieGenre = movie.getAttribute('data-genre').toLowerCase().split(', ');
                const movieDay = movie.getAttribute('data-day').toLowerCase().split(', ');

                console.log('Movie Cinema:', movieCinema, 'Movie Genre:', movieGenre, 'Movie Day:', movieDay);
            
                // Vérifier les conditions des filtres
                const matchesCinema = selectedCinemas.length === 0 || selectedCinemas.includes(movieCinema);
                const matchesGenre = selectedGenres.length === 0 || selectedGenres.some(genre => movieGenre.includes(genre));
                const matchesDay = selectedDays.length === 0 || selectedDays.some(day => movieDay.includes(day));
            
                // Afficher ou masquer les films en fonction des filtres
                if (matchesCinema && matchesGenre && matchesDay) {
                    movie.style.display = 'block';  // Afficher le film
                } else {
                    movie.style.display = 'none';  // Masquer le film
                }
            });
        }
    
        // Fonction pour obtenir les valeurs sélectionnées des checkboxes
        function getSelectedValues(className) {
            const selected = [];
            document.querySelectorAll(`.${className}:checked`).forEach(checkbox => {
                selected.push(checkbox.value);
            });
            console.log(`Selected values for ${className}:`, selected);
            return selected;
        }
    
        // Écouter les événements de changement sur les checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', applyFilters);
        });
    
        // Appliquer les filtres une fois au chargement
        applyFilters();


        function toggltButtonFilter () {
            const toggleButton = document.getElementById('toggleButton');
            const icon = toggleButton.querySelector('#toggleButton i'); // Sélectionner l'icône
        
            toggleButton.addEventListener('click', function() {
                // Vérifier quelle icône est actuellement affichée
                if (icon.classList.contains('fa-chevron-down')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                    icon.classList.add('icon-rotate'); 
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                    icon.classList.remove('icon-rotate');
                }
            });
        }
        toggltButtonFilter ();
        
    });

    /*document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton');
        const icon = toggleButton.querySelector('#toggleButton i'); // Sélectionner l'icône
    
        toggleButton.addEventListener('click', function() {
            // Vérifier quelle icône est actuellement affichée
            if (icon.classList.contains('fa-chevron-down')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    });*/