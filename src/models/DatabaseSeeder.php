<?php
// à mettre en place
namespace App\models;

use App\models\RoomManager;
use App\models\SeatManager;
use App\models\ScreeningManager;
use App\models\ReviewManager;

class DatabaseSeeder 
{
    public function createAllTables()
    {
        $roomManager = new RoomManager();
        $roomManager->createRoomsTable();

        $seatManager = new SeatManager();
        $seatManager->createSeatsTable();

        $screeningManager = new ScreeningManager();
        $screeningManager->createScreeningsTable();

        $reservationManager = new ReservationManager();
        $reservationManager->createReservationsTable();

        $reviewManager = new ReviewManager();
        $reviewManager->createReviewsTable();

        
    }
}
