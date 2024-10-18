<?php
namespace App\controllers\backend;

use App\Models\DataSeeder;
use App\controllers\UsersController;
use App\models\MovieManager;
use App\models\RoomManager;
use App\models\GenreManager;
use App\models\MovieGenreManager;



class BmovieController
{
    private $moviesManager;
    private $usersController;
    private $roomManager;
    private $genresManager;
    private $moviesGenresManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
        $this->usersController = new UsersController();
        $this->roomManager = new RoomManager();
        $this->genresManager = new GenreManager();
        $this->moviesGenresManager = new MovieGenreManager();
    }

    public function showDasboard()
    {
        //$movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../../views/backend/salles.php';
    }

    public function showRooms()
    {
        $rooms = $this->roomManager->getAllRoomsWithCinemas();
        $cinemas = $this->moviesManager->getAllCinemas();

        require __DIR__ . '/../../views/backend/salles.php';
    }

    public function createRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cinemaId = $_POST['cinema_id'];
            $roomNumber = $_POST['room_number'];
            $seatCapacity = $_POST['seat_capacity'];
            $projectionQuality = $_POST['projection_quality'];

            $this->roomManager->createRoom($cinemaId, $roomNumber, $seatCapacity, $projectionQuality);

            session_start();
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

            session_start();
            $_SESSION['message'] = "Salle supprimée avec succès !";

            header("Location: index.php?action=salles");
            exit();
        }
    }

    public function showRoomEdit($roomId)
    {
        $room = $this->roomManager->getRoomById($roomId); 
        $cinemas = $this->moviesManager->getAllCinemas(); 

        session_start();
        $successMessage = '';
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
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

            session_start();
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
        $genres = $this->genresManager->getAllGenres();

        session_start();
        $successMessage = '';
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']);
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
                session_start();
                $_SESSION['error'] = $uploadError;
                header('Location: index.php?action=admin-film');
                exit();
            }

            $movieId = $this->moviesManager->createMovie($movieTitle, $description, $ageMinimum, $favorite, $posterPath);

            $this->moviesGenresManager->addGenresToMovie($movieId, $genres);

            session_start();
            $_SESSION['message'] = "Film créé avec succès !";
            header('Location: index.php?action=admin-film');
            exit();
        }
    }

}