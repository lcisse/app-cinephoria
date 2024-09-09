<?php
namespace App\Models;

class ReviewManager extends BaseManager
{
    // Méthode pour créer la table "reviews" (avis sur les films)
    public function createReviewsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS reviews (
            id INT PRIMARY KEY AUTO_INCREMENT,
            movie_id INT,
            customer_id INT,
            review_text TEXT,
            rating INT,
            status ENUM('pending', 'approved', 'rejected'),
            submission_date DATETIME,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "reviews" créée avec succès.');
    }

    // Méthode pour récupérer tous les avis
    public function getAllReviews()
    {
        $sql = "SELECT * FROM reviews";
        return $this->fetchAll($sql);
    }
}