<?php
namespace App\controllers;

use App\models\MovieManager;

class MovieController
{
    private $moviesManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
    }

    private function convertDayToFrench($englishDays) {
        $days = [
            'Monday' => 'lundi',
            'Tuesday' => 'mardi',
            'Wednesday' => 'mercredi',
            'Thursday' => 'jeudi',
            'Friday' => 'vendredi',
            'Saturday' => 'samedi',
            'Sunday' => 'dimanche'
        ];

        // Diviser les jours si plusieurs sont présents, sinon traiter comme un seul jour
        $englishDaysArray = explode(', ', $englishDays);

        // Convertir chaque jour en français
        $frenchDaysArray = array_map(function($day) use ($days) {
            return $days[$day] ?? $day;  // Si le jour n'existe pas dans le tableau, retourner le jour original
        }, $englishDaysArray);

        // Rejoindre les jours traduits en une seule chaîne
        return implode(', ', $frenchDaysArray);
    }

    public function showHome()
    {
        $movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/home.php';
    }

    public function showFimsPage($movieId)
    {
        $movies = $this->moviesManager->getAllMovies();

        $ratings = [];

        foreach ($movies as $movie) {
            $ratings[$movie['id']] = $this->moviesManager->getMovieAverageRating($movie['id']);

            // Vérifier si 'screening_day' existe avant d'essayer de le convertir
            if (isset($movie['screening_days'])) {
                $movie['screening_days'] = $this->convertDayToFrench($movie['screening_days']); // Convertir le jour au format français
            }
        }

        require __DIR__ . '/../views/frontend/films.php';
    }

    public function showScreenings($movieId)
    {
        $screenings = $this->moviesManager->getMovieScreenings($movieId);
        
        require __DIR__ . '/../views/frontend/seances.php';
    }
}
