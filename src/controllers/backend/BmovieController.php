<?php
namespace App\controllers\backend;
require_once __DIR__ . '/../../../config/session.php';
use App\models\DataSeeder;
use App\controllers\UsersController;
use App\models\MovieManager;
use App\models\RoomManager;
use App\models\GenreManager;
use App\models\MovieGenreManager;
use App\models\ScreeningManager;
use App\models\MovieScheduleManager;
use App\models\mongodb\ReservationMongoManager;
use App\models\ReviewManager;
use App\models\ReservationManager;
use App\models\SeatManager;



class BmovieController
{
    private $moviesManager;
    private $usersController;
    private $roomManager;
    private $genresManager;
    private $moviesGenresManager;
    private $screeningManager;
    private $movieScheduleManager;
    private $reservationMongoManager;
    private $reviewManager;
    private $reservationManager;
    private $seatManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
        $this->usersController = new UsersController();
        $this->roomManager = new RoomManager();
        $this->genresManager = new GenreManager();
        $this->moviesGenresManager = new MovieGenreManager();
        $this->screeningManager = new ScreeningManager();
        $this->movieScheduleManager = new MovieScheduleManager();
        $this->reservationMongoManager = new ReservationMongoManager();
        $this->reviewManager = new ReviewManager();
        $this->reservationManager = new ReservationManager();
        $this->seatManager = new SeatManager();
    }

    public function showDasboard()
    {
        //session_start(); 
        
        $reservations = $this->reservationMongoManager->getReservationsLast7Days();
        $userRole = $_SESSION['role'] ?? null; 

        if ($userRole !== 'administrator') {
            header("Location: index.php?action=home");
            exit();
        }
        
        require __DIR__ . '/../../views/backend/tableau-de-bord.php';
    }

    public function showRooms()
    {
        //session_start();
        $rooms = $this->roomManager->getAllRoomsWithCinemas();
        $cinemas = $this->moviesManager->getAllCinemas();
        $userRole = $_SESSION['role'] ?? null; 

        if ($userRole !== 'administrator' && $userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 

        require __DIR__ . '/../../views/backend/salles.php';
    }

    public function createRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cinemaId = $_POST['cinema_id'];
            $roomNumber = $_POST['room_number'];
            $seatCapacity = $_POST['seat_capacity'];
            $projectionQuality = $_POST['projection_quality'];

            //$this->roomManager->createRoom($cinemaId, $roomNumber, $seatCapacity, $projectionQuality);
            $roomId = $this->roomManager->createRoom($cinemaId, $roomNumber, $seatCapacity, $projectionQuality);

            // Vérifier et créer les sièges pour cette salle
            //$this->seatManager->createSeatsForRoom($roomId, $cinemaId, $seatCapacity);

            //session_start();
            $_SESSION['message'] = "Salle créée avec succès !";
            
            header('Location: index.php?action=salles'); 
            exit();
        }
    }

    public function deleteRoom()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $roomId = (int)$_GET['id'];
            $this->roomManager->deleteRoom($roomId);

            //session_start();
            $_SESSION['message'] = "Salle supprimée avec succès !";

            header("Location: index.php?action=salles");
            exit();
        }
    }

    public function showRoomEdit($roomId)
    {
        //session_start();
        $room = $this->roomManager->getRoomById($roomId); 
        $cinemas = $this->moviesManager->getAllCinemas(); 
        $userRole = $_SESSION['role'] ?? null; 

        $successMessage = '';
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
        }


        if ($userRole !== 'administrator' && $userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 

        require __DIR__ . '/../../views/backend/salle-edit.php';
    }

    public function updateRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $roomId = $_POST['room_id']; 
            $cinemaId = $_POST['cinema_id'];
            $roomNumber = $_POST['room_number'];
            $seatCapacity = $_POST['seat_capacity'];
            $projectionQuality = $_POST['projection_quality'];
            $incidentNotes = $_POST['incident_notes'] ?? '';

            $this->roomManager->updateRoom($roomId, $cinemaId, $roomNumber, $seatCapacity, $projectionQuality, $incidentNotes);

            //session_start();
            $_SESSION['success_message'] = 'La salle a été mise à jour avec succès.';

            header("Location: index.php?action=salles&id=$roomId");
            exit();
        } else {
            header('Location: index.php?action=salles');
            exit();
        }
    }


    public function showGestionFilms()
    {
        //session_start();
        $genres = $this->genresManager->getAllGenres();
        $films = $this->moviesManager->getAllMovies();
        $userRole = $_SESSION['role'] ?? null; 

        $successMessage = '';
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
        }


        if ($userRole !== 'administrator' && $userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 

        require __DIR__ . '/../../views/backend/gestion-films.php';
    }

    public function createMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieTitle = $_POST['movie_title'];
            $description = $_POST['movie_description'];
            $ageMinimum = $_POST['age_minimum'];
            $favorite = isset($_POST['favorite']) ? 1 : 0;
            //$cinemaId = $_POST['cinema_id'];
            $genres = $_POST['genres'];

            $uploadDir = __DIR__ . '/../../../public/uploads/';
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $posterPath = null;
            $uploadError = '';

            if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $maxFileSize = 5000000; 

                $fileExtension = strtolower(pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedExtensions)) {
                    $uploadError = "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, PNG ou GIF.";
                }

                if ($_FILES['poster']['size'] > $maxFileSize) {
                    $uploadError = "Le fichier est trop volumineux. Limite de 5MB.";
                }

                if (empty($uploadError)) {
                    // Générer un nom unique pour le fichier (utilisation de uniqid avec l'extension d'origine)
                    $newFileName = uniqid() . '.' . $fileExtension;

                    // Chemin complet du fichier dans le répertoire "uploads"
                    $posterPath = $uploadDir . $newFileName;

                    if (!move_uploaded_file($_FILES['poster']['tmp_name'], $posterPath)) {
                        $uploadError = "Erreur lors du téléchargement de l'affiche.";
                    } else {
                        // Si nécessaire, ajuster le chemin pour l'utiliser dans la base de données (URL relative)
                        $posterPath = 'uploads/' .  $newFileName;
                    }
                }
            } elseif (isset($_FILES['poster']) && $_FILES['poster']['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploadError = "Erreur lors du téléchargement de l'affiche.";
            }

            if (!empty($uploadError)) {
                //session_start();
                $_SESSION['error'] = $uploadError;
                header('Location: index.php?action=admin-film');
                exit();
            }

            $movieId = $this->moviesManager->createMovie($movieTitle, $description, $ageMinimum, $favorite, $posterPath);

            $this->moviesGenresManager->addGenresToMovie($movieId, $genres);

            //session_start();
            $_SESSION['message'] = "Film créé avec succès !";
            header('Location: index.php?action=admin-film');
            exit();
        }
    }

    public function deleteFilm()
    {
        if (isset($_GET['id'])) {
            $filmId = (int)$_GET['id'];

            $this->moviesGenresManager->deleteGenresByMovieId($filmId);
            $this->moviesManager->deleteFilm($filmId);

            //session_start();
            $_SESSION['message'] = "Film supprimé avec succès !";
            header('Location: index.php?action=admin-film');
            exit();
        }
    }

    public function showEditFilm($filmId)
    {
        //session_start();
        $film = $this->moviesManager->getFilmById($filmId); 
        $genres = $this->genresManager->getAllGenres(); 
        $userRole = $_SESSION['role'] ?? null; 

        $filmGenres = $this->moviesGenresManager->getGenresByMovieId($filmId);

        $successMessage = '';
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
        }


        if ($userRole !== 'administrator' && $userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 

        require __DIR__ . '/../../views/backend/film-edit.php';
    }

    public function updateFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filmId = $_POST['film_id'];
            $movieTitle = $_POST['movie_title'];
            $description = $_POST['movie_description'];
            $ageMinimum = $_POST['age_minimum'];
            $favorite = isset($_POST['favorite']) ? 1 : 0;
            $genres = $_POST['genres'];
            $publicationDate = $_POST['publication_date'];

            // Gestion de l'upload de l'affiche (optionnel)
            $posterPath = null;
            if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/uploads/';
                $fileExtension = strtolower(pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION));
                $newFileName = uniqid() . '.' . $fileExtension;
                $posterPath = $uploadDir . $newFileName;
                move_uploaded_file($_FILES['poster']['tmp_name'], $posterPath);
                $posterPath = 'uploads/' . $newFileName; // Pour la base de données
            }

            // Mise à jour du film
            $this->moviesManager->updateFilm($filmId, $movieTitle, $description, $ageMinimum, $favorite, $publicationDate, $posterPath);

            // Mise à jour des genres associés
            $this->moviesGenresManager->updateGenresForMovie($filmId, $genres);

            //session_start();
            $_SESSION['message'] = "Film a été mise à jour avec succès.";
            header("Location: index.php?action=admin-film&id=$filmId");
            exit();
        }
    }

    public function showGestionSeances($filmId)
    {
        //session_start();
        $screenings = $this->screeningManager->getScreeningsByMovie($filmId);
        $cinemas = $this->roomManager->getAllCinemasWithRooms();
        $userRole = $_SESSION['role'] ?? null; 

        if($_GET['filmId-seance']) {
            $movieId = $_GET['filmId-seance'];  
        }

        $cinemaRooms = [];
        foreach ($cinemas as $cinemaId => $cinema) {
            $cinemaRooms[$cinemaId] = [];
            foreach ($cinema['rooms'] as $room) {
                $cinemaRooms[$cinemaId][] = [
                    'id' => $room['id'],
                    'number' => $room['room_number'],
                    'capacity' => $room['seat_capacity']
                ];
            }
        }
        if(isset($_SESSION['messageScreenings'])){

            $_SESSION['messageScreenings'] = $_SESSION['messageScreenings'];
        }


        if ($userRole !== 'administrator' && $userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 

        require __DIR__ . '/../../views/backend/gestion-seances.php';
    }

    public function createScreening()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieId = $_GET['filmId-seance']; 
            $cinemaId = $_POST['cinema_id'];
            $roomIdAndCapacity =  explode(",", $_POST['roomIdAndCapacity']);
            $roomId = $roomIdAndCapacity[0];
            $screeningDate = $_POST['screening_date'];
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];
            $seatCapacity = $roomIdAndCapacity[1];

            $screeningId = $this->screeningManager->createScreening($movieId, $roomId, $screeningDate, $startTime, $endTime, $cinemaId, $seatCapacity);
            $this->seatManager->createSeatsForScreening($screeningId, $roomId, $cinemaId, $seatCapacity);

            $this->movieScheduleManager->addMovieSchedule($movieId, $cinemaId, $screeningDate);

            //session_start();
            $_SESSION['messageScreenings'] = "Séance créée avec succès !";
            header("Location: index.php?action=admin-film&filmId-seance=$movieId");
            exit();
        }
    }

    public function deleteScreening()
    {
        if (isset($_GET['screening_id'])) {
            $screeningId = (int)$_GET['screening_id'];
            $filmId = $_GET['filmId-seance'];

            $this->screeningManager->deleteScreening($screeningId);

            //session_start();
            $_SESSION['messageScreenings'] = "Séance supprimée avec succès !";

            header("Location: index.php?action=admin-film&filmId-seance=$filmId");
            //var_dump($_GET['filmId-seance']);
            exit();
        }
    }

    public function showEditScreening()
    {
        //session_start();
        $screeningId = isset($_GET['screening_id']) ? (int)$_GET['screening_id'] : null;
        $userRole = $_SESSION['role'] ?? null; 

        if ($screeningId) {
            $screeningDetails = $this->moviesManager->getScreeningDetails($screeningId);
          
            $cinemas = $this->roomManager->getAllCinemasWithRooms();
          
            $cinemaRooms = [];
            foreach ($cinemas as $cinemaId => $cinema) {
                $cinemaRooms[$cinemaId] = [];
                foreach ($cinema['rooms'] as $room) {
                    $cinemaRooms[$cinemaId][] = [
                        'id' => $room['id'],
                        'number' => $room['room_number']
                    ];
                }
            }


            if ($userRole !== 'administrator' && $userRole !== 'employee') {
                header("Location: index.php?action=home");
                exit();
            } 

            require __DIR__ . '/../../views/backend/seance-edit.php';
        }
    }

    public function updateScreening()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $screeningId = (int)$_GET['screening_id'];
            $movieId = (int)$_GET['filmId-seance'];
            $cinemaId = $_POST['cinema_id'];
            $roomId = $_POST['room_id'];
            $screeningDate = $_POST['screening_date'];
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];

           /* var_dump($_POST['room_id']);
            exit;*/


            $this->screeningManager->updateScreening($screeningId, $movieId, $roomId, $screeningDate, $startTime, $endTime);
            $this->movieScheduleManager->updateMovieSchedule($movieId, $cinemaId, $screeningDate);

            //session_start();
            $_SESSION['messageScreenings'] = "Séance mise à jour avec succès !";
            header("Location: index.php?action=admin-film&filmId-seance=$movieId");
            exit();
        }
    }

    public function showReviews()
    {
        //session_start();
        $reviews = $this->reviewManager->getAllReviews();
        $userRole = $_SESSION['role'] ?? null; 

        if ($userRole !== 'employee') {
            header("Location: index.php?action=home");
            exit();
        } 
        require __DIR__ . '/../../views/backend/avis.php';
    }

    public function approveReview($reviewId)
    {
        $this->reviewManager->updateReviewStatus($reviewId, 'approved');
        //session_start();
        $_SESSION['messageReview'] = "Avis validé avec succès !";
        header('Location: index.php?action=avis');
        exit();
    }

    public function deleteReview($reviewId)
    {
        $this->reviewManager->deleteReview($reviewId);
        //session_start();
        $_SESSION['messageReview'] = "Avis supprimé avec succès !";
        header('Location: index.php?action=avis'); 
        exit();
    }

    public function showUserSpace()
    {
        //session_start();
        $userId = $_SESSION['user_id'] ?? null;
        $userRole = $_SESSION['role'] ?? null; 

        if ($userRole !== 'user') {
            header("Location: index.php?action=home");
            exit();
        }

        if ($userId) {
            $orders = $this->reservationManager->getUserReservations($userId); 
        } else {
            $orders = [];
        }
       
        require __DIR__ . '/../../views/backend/espace-utilisateur.php';
    }

    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //session_start();
            $userId = $_SESSION['user_id'];
            $movieId = $_POST['movie_id'];
            $rating = $_POST['rating'];
            $reviewText = htmlspecialchars($_POST['text_review']);

            $this->reviewManager->addReview($userId, $movieId, $reviewText, $rating);

            $_SESSION['messageNote'] = "Votre avis a été enregistré avec succès et est en attente de validation.";
            header('Location: index.php?action=espace-utilisateur');
            exit();
        }
    }

    public function getQrCode()
    {
        if (isset($_GET['reservationId'])) {
            $reservationId = $_GET['reservationId'];
            $qrCodePath = $this->reservationManager->getQrCodeByReservationId($reservationId);

            echo json_encode(['qrCode' => $qrCodePath]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID de réservation manquant.']);
        }
    }

}