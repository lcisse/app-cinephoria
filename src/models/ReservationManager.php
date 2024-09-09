<?php
namespace App\Models;

class ReservationManager extends BaseManager
{
    // Méthode pour créer la table "reservations"
    public function createReservationsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS reservations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            screening_id INT,
            seat_id INT,
            price DECIMAL(8, 2),
            reservation_date DATETIME,
            customer_id INT,
            status ENUM('confirmed', 'pending', 'cancelled'),
            FOREIGN KEY (screening_id) REFERENCES screenings(id) ON DELETE CASCADE,
            FOREIGN KEY (seat_id) REFERENCES seats(id) ON DELETE CASCADE,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "reservations" créée avec succès.');
    }

    // Méthode pour récupérer toutes les réservations
    public function getAllReservations()
    {
        $sql = "SELECT * FROM reservations";
        return $this->fetchAll($sql);
    }
}