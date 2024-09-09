<?php
// à mettre en place
namespace App\Models;

use App\Models\RoomManager;
use App\Models\SeatManager;
use App\Models\ScreeningManager;
use App\Models\ReviewManager;

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
