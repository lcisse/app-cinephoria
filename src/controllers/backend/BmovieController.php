<?php
namespace App\controllers\backend;

use App\Models\DataSeeder;
use App\controllers\UsersController;
use App\models\MovieManager;
use App\models\RoomManager;



class BmovieController
{
    private $moviesManager;
    private $usersController;
    private $roomManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
        $this->usersController = new UsersController();
        $this->roomManager = new RoomManager();
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

    /*public function editRoom()
    {
        if (isset($_GET['id'])) {
            $roomId = (int)$_GET['id'];
            $room = $this->roomManager->getRoomById($roomId);
            // Vous pouvez rediriger vers une vue pour modifier la salle avec un formulaire.
            require __DIR__ . '/../../views/backend/editRoom.php';
        }
    }*/

}