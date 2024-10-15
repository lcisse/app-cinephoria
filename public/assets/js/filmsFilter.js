
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

        function toggltButtonFilter() {
            const toggleButtons = document.querySelectorAll('.toggleButton'); 
        
            toggleButtons.forEach(button => {
                const icon = button.querySelector('i'); 
                const target = document.querySelector(button.getAttribute('data-bs-target'));
        
                target.addEventListener('shown.bs.collapse', function () {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                });
        
                target.addEventListener('hidden.bs.collapse', function () {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                });
            });
        }
        
        // Appliquer la fonction
        toggltButtonFilter();
        
    });
