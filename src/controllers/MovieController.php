<?php
namespace App\controllers;
require_once __DIR__ . '/../../config/session.php';
use App\Models\DataSeeder;
use App\models\MovieManager;
use App\models\ScreeningManager;
use App\Models\ReservationManager;
use App\Models\SeatManager;
use App\controllers\UsersController;
use App\models\mongodb\ReservationMongoManager;
use App\models\ReviewManager;
use App\models\CinemaManager;

require_once __DIR__ . '/../../lips/phpqrcode/qrlib.php';


class MovieController
{
    private $moviesManager;
    private $usersController;
    private $reservationMongoManager;
    private $reviewManager;
    private $cinemaManager;
    private $seatManager;
    private $screeningManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
        $this->usersController = new UsersController();
        $this->reservationMongoManager = new ReservationMongoManager();
        $this->reviewManager = new ReviewManager();
        $this->cinemaManager = new CinemaManager();
        $this->seatManager = new SeatManager();
        $this->screeningManager = new ScreeningManager();
    }

    private function convertDayToFrench($englishDays) 
    {
        if (empty($englishDays)) {
            return '';  // 
        }
        
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
        $movies = $this->moviesManager->getMoviesSinceLastWednesday();

        require __DIR__ . '/../views/frontend/home.php';
    }

    public function showFimsPage($movieId)
    {

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page par défaut : 1
        $limit = 8; 
        $offset = ($page - 1) * $limit; // Calcul de l'offset pour SQL

        $movies = $this->moviesManager->getPaginatedMovies($offset, $limit);

        $totalMovies = $this->moviesManager->getTotalMoviesCount();
        $totalPages = ceil($totalMovies / $limit);

       // $movies = $this->moviesManager->getAllMovies();
        $ratings = [];

        foreach ($movies as $movie) {
            $ratings[$movie['id']] = $this->moviesManager->getMovieAverageRating($movie['id']);

            if (isset($movie['screening_days'])) {
                $movie['screening_days'] = $this->convertDayToFrench($movie['screening_days']); 
            }
        }

        
        $cinemaId = isset($_SESSION['cinemaId']) ? $_SESSION['cinemaId'] : null;

        require __DIR__ . '/../views/frontend/films.php';
    }

    public function showRecapCommande()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_SESSION['temp_reservation'])) {
            
            // Si les données sont en POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $selectedSeats = $_POST['seats'];
                $screeningId = $_POST['screeningId'];
                $totalSeats = count(explode(', ', $selectedSeats)); // Calculer le nombre de sièges à partir de la chaîne de sièges
                $totalPrice = $_POST['totalPrice'];  
            }
            else if (isset($_SESSION['temp_reservation'])) {
                $reservationData = $_SESSION['temp_reservation'];
                unset($_SESSION['temp_reservation']); // Supprimer les données temporaires après utilisation

                $selectedSeats = $reservationData['seats'];
                $screeningId = $reservationData['screeningId'];
                $totalSeats = $reservationData['totalSeats'];

                // Calculer le prix total en fonction des sièges
                $screeningDetails = $this->moviesManager->getScreeningDetails($screeningId);
                $projectionQuality = $screeningDetails['projection_quality'];

                $qualityPrices = [
                    "2D" => 10.0,
                    "3D" => 12.5,
                    "IMAX" => 15.0,
                    "4DX" => 18.0,
                    "MX4D" => 20.0,
                    "D-BOX" => 22.0
                ];
                $pricePerSeat = $qualityPrices[$projectionQuality] ?? 10.0;
                $totalPrice = $totalSeats * $pricePerSeat;
            }

            $screeningDetails = $this->moviesManager->getScreeningDetails($screeningId);
            $movieTitle = $screeningDetails['title'];
            $cinema = $screeningDetails['cinema'];
            $startTime = $screeningDetails['start_time'];
            $endTime = $screeningDetails['end_time'];
            $screeningDay = $screeningDetails['screening_day'];
            $formattedDate = $this->convertDayToFrench($screeningDay);

            
            require __DIR__ . '/../views/frontend/reservation-commande-recap.php';
        } else {
            header("Location: index.php?action=home");
            exit();
        }
    }

    public function confirmReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $screeningId = $_POST['screeningId'];
            $seats = $_POST['seats'];  
            $numberOfSeats = count(explode(', ', $seats));
            $totalPrice = $_POST['totalPrice'];

            $screeningDetails = $this->moviesManager->getScreeningDetails($screeningId);
            $movieId = $screeningDetails['movie_id'];
            $movieTitle = $screeningDetails['title'];
            
            // Générer le contenu du QR code
            $qrCodeData = json_encode([
                'id_de_la_seance' => $screeningId,
                'nombre_de_siege' => $numberOfSeats,
            ]);

            // Définir le chemin où enregistrer le QR code
            $qrCodePath = 'qrcodes/' . uniqid() . '.png'; 
            $fullPath = __DIR__ . '/../../public/' . $qrCodePath;

            // Générer le QR code
            \QRcode::png($qrCodeData, $fullPath, QR_ECLEVEL_L, 10);


            $this->moviesManager->createReservation($userId, $movieId, $screeningId, $seats, $totalPrice, $qrCodeData, $qrCodePath);
            $this->reservationMongoManager->addReservation($movieTitle, $userId, $seats, $totalPrice, 'confirmed');

            $_SESSION['reservation_confirmed'] = true;

            unset($_SESSION['temp_reservation']);

            $this->showConfirmPage();
            exit();
        }
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

            if (isset($movie['screening_days'])) {
                $movie['screening_days'] = $this->convertDayToFrench($movie['screening_days']); 
            }
        }
        
        require __DIR__ . '/../views/frontend/reservation.php';
    }

    public function showScreenings($movieId)
    {
        if(isset($_GET['cinema_id']) && !empty($_GET['cinema_id'])) {
            $cinemaId = (int)$_GET['cinema_id'];
            $cinemaName = $this->cinemaManager->getCinemaNameById($cinemaId);
        }
        
        if(isset($_GET['cinemaName']) && !empty($_GET['cinemaName'])) {
            $cinemaName = $_GET['cinemaName'];
            $movies = $this->moviesManager->getMoviesByCinema($cinemaName);
            $cinemaId = !empty($movies) ? $movies[0]['cinema_id'] : null;
        }
        $screenings = $this->moviesManager->getMovieScreeningsByCinema($movieId, $cinemaId);

        $movie  = $this->moviesManager->getFilmById($movieId);
        $ratings = $this->moviesManager->getMovieAverageRating($movieId);
        $approveReviewCount = $this->reviewManager->getApprovedReviewCount($movieId);
        $approvedReviews = $this->reviewManager->getApprovedReviewsByMovieId($movieId);
 
        if (!empty($screenings)) {
            $movieTitle = $screenings[0]['title'];
            $movieDescription = $screenings[0]['description'];
            $moviePoster = $screenings[0]['poster'];
        } else {
            $movieTitle = $movie['title'];
            $movieDescription = $movie['description'];
            $moviePoster = $movie['poster']; 
        }

        //$this->screeningManager->deleteSeatsForCompletedScreenings(); // supprimer les sièges après la date de screening
        
        
        require __DIR__ . '/../views/frontend/seances.php';
    }

    public function handleScreeningsRequest()
    {
        if (isset($_GET['movie_id']) && isset($_GET['cinema_id']) && isset($_GET['date'])) {
            $movieId = (int)$_GET['movie_id'];
            $cinemaId = (int)$_GET['cinema_id'];
            $date = $_GET['date'];

            $screenings = $this->moviesManager->getScreeningsByMovieAndCinemaAndDate($movieId, $cinemaId, $date);

            echo json_encode($screenings);
            exit;
        }
    }

    public function reservationsSeats($screening_id) {
        $screenings = $this->moviesManager->getScreeningDetails($screening_id);
        $usersController = $this->usersController->isAuthenticated();
        

       if (!empty($screenings)) {
            $movieTitle = $screenings['title'];
            $moviePoster = $screenings['poster'];
            $cinema = $screenings['cinema'];
            $cinemaId = $screenings['cinema_id'];
            $room_number = $screenings['room_number'];
            $roomId = $screenings['room_id'];
            $start_time = $screenings['start_time'];
            $end_time = $screenings['end_time'];
            $screening_day = $screenings['screening_day'];
            $seat_capacity = $screenings['seat_capacity'];
            $projection_quality = $screenings['projection_quality'];

            $availableSeats = $this->seatManager->getAvailableSeats($screening_id);

            $dateTime = new \DateTime($screening_day);
            $screening_day = $dateTime->format('d/m');
        }
        require __DIR__ . '/../views/frontend/reservation-siege.php';
    }

    public function handleSeatsRequest($screening_id)
    {
        $seats = $this->moviesManager->getSeatsByScreening($screening_id); 

        // Renvoyer les sièges sous format JSON pour être utilisés par AJAX
        echo json_encode($seats);
        exit;
    }

    public function filterMoviesByCinema()
    {
        $cinemaName = $_GET['cinema_name'] ?? 'all'; // Récupérer la valeur ou 'all' par défaut

        if ($cinemaName === 'all') {
            $movies = $this->moviesManager->getAllMovies(); // Récupérer tous les films
        } else {
            $movies = $this->moviesManager->getMoviesByCinema($cinemaName); // Filtrer par cinéma
        }
            // Retour des données au format JSON
            echo json_encode([
                'success' => true,
                'movies' => $movies,
            ]);
            exit;
        

        echo json_encode(['success' => false, 'message' => 'Aucun cinéma sélectionné.']);
        exit;
    }

    public function showConfirmPage()
    {
        if (isset($_SESSION['reservation_confirmed']) && $_SESSION['reservation_confirmed'] === true) {
            unset($_SESSION['reservation_confirmed']); 
            require __DIR__ . '/../views/frontend/reservation-confirmee.php'; 
        } else {
            header("Location: index.php?action=home");
            exit();
        }
    }

    public function showContact()
    {
        require __DIR__ . '/../views/frontend/contact.php';
    }
}
