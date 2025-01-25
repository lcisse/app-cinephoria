<?php
namespace App\Models;

use PDO;

class ReservationManager extends BaseManager
{
    public function createReservationsTable()
    {
        $sql = "DROP TABLE IF EXISTS reservations";
        $this->executeQuery($sql, 'Table "reservations" supprimée avec succès.');

        $sql = "CREATE TABLE IF NOT EXISTS reservations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT,  
            movie_id INT, 
            screening_id INT, 
            seats VARCHAR(255),  
            price DECIMAL(10, 2), -- Le prix total
            reservation_date DATETIME DEFAULT CURRENT_TIMESTAMP, 
            status ENUM('confirmed', 'pending', 'cancelled') DEFAULT 'pending', 
            qr_code VARCHAR(255), -- Stocker l'URL ou la donnée du QR code
            scanned TINYINT DEFAULT 0, 
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (screening_id) REFERENCES screenings(id) ON DELETE CASCADE
        )";
        
        $this->executeQuery($sql, 'Table "reservations" créée avec succès.');
    }


    public function getAllReservations()
    {
        $sql = "SELECT * FROM reservations";
        return $this->fetchAll($sql);
    }

    public function getUserReservations($userId)
    {
        $sql = "SELECT 
                movies.id AS movie_id,
                movies.poster AS movie_poster, 
                movies.title AS movie_title, 
                screenings.screening_day, 
                screenings.start_time, 
                screenings.end_time, 
                reservations.id, 
                reservations.price, 
                reservations.seats,
                rooms.room_number AS room_number 
                FROM reservations
                JOIN screenings ON reservations.screening_id = screenings.id
                JOIN movies ON reservations.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id
                WHERE reservations.user_id = :user_id
                ORDER BY reservations.reservation_date DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQrCodeByReservationId($reservationId)
    {
        $sql = "SELECT qr_code FROM reservations WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $reservationId]);
        return $stmt->fetchColumn();
    }
}