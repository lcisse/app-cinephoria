<?php
namespace App\Models;

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
}