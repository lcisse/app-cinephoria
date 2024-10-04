<?php
namespace App\controllers;

use App\Models\DataSeeder;
use App\models\MovieManager;
use App\models\ScreeningManager;
use App\Models\ReservationManager;
use App\Models\SeatManager;
use App\controllers\UsersController;

class MovieController
{
    private $moviesManager;
    private $usersController;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
        $this->usersController = new UsersController();
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

    public function showRecapCommande()
    {
        //$movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/reservation-commande-recap.php';
    }

    public function showMoviesByCinema($cinema)
    {
        $movies = $this->moviesManager->getMoviesByCinema($cinema);

        if (!empty($movies)) {
            $cinemaName = $movies[0]['cinema'];
        } else {
            // name of cinema if movies is empty
            $cinemaName = ucfirst($cinema);
        }

        $ratings = [];

        foreach ($movies as $movie) {
            $ratings[$movie['id']] = $this->moviesManager->getMovieAverageRating($movie['id']);

            // Vérifier si 'screening_day' existe avant d'essayer de le convertir
            if (isset($movie['screening_days'])) {
                $movie['screening_days'] = $this->convertDayToFrench($movie['screening_days']); // Convertir le jour au format français
            }
        }
        
        require __DIR__ . '/../views/frontend/reservation.php';
    }

    public function showScreenings($movieId)
    {
        $screenings = $this->moviesManager->getMovieScreenings($movieId);
        //var_dump($screenings);

        if (!empty($screenings)) {
            $movieTitle = $screenings[0]['title'];
            $movieDescription = $screenings[0]['description'];
            $moviePoster = $screenings[0]['poster'];
        }else {
            // Ajouter un message d'erreur si aucune séance n'est trouvée
            $movieTitle = "Pas de séances disponibles pour cette date.";
            $movieDescription = "";
            $moviePoster = "default-image.jpg"; // Une image par défaut
        }
        
        require __DIR__ . '/../views/frontend/seances.php';
    }

    public function handleScreeningsRequest()
    {
        if (isset($_GET['movie_id']) && isset($_GET['date'])) {
            $movieId = (int)$_GET['movie_id'];
            $date = $_GET['date'];

            $screenings = $this->moviesManager->getScreeningsByDate($movieId, $date);

            // Retourner les séances en format JSON
            echo json_encode($screenings);
            exit;
        }
    }

    public function reservationsSeats($screening_id) {
        $screenings = $this->moviesManager->getScreeningDetails($screening_id);
        $usersController = $this->usersController->isAuthenticated();
        //var_dump($screenings);

       if (!empty($screenings)) {
            $movieTitle = $screenings['title'];
            $moviePoster = $screenings['poster'];
            $cinema = $screenings['cinema'];
            $room_number = $screenings['room_number'];
            $start_time = $screenings['start_time'];
            $end_time = $screenings['end_time'];
            $screening_day = $screenings['screening_day'];
            $seat_capacity = $screenings['seat_capacity'];
            $projection_quality = $screenings['projection_quality'];

            $dateTime = new \DateTime($screening_day);
            $screening_day = $dateTime->format('d/m');
        }
        require __DIR__ . '/../views/frontend/reservation-siege.php';
    }

    public function handleSeatsRequest($screening_id)
    {
        $seats = $this->moviesManager->getSeatsByScreening($screening_id); // Appel au modèle pour récupérer les sièges

        // Renvoyer les sièges sous format JSON pour être utilisés par AJAX
        echo json_encode($seats);
        exit;
    }
}
