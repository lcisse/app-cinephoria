<?php
namespace App\models;

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

    public function getAllReviews()
    {
        $sql = "
            SELECT 
                reviews.id, 
                reviews.review_text, 
                reviews.status,
                reviews.submission_date,
                movies.title AS movie_title,
                users.email AS author_email
            FROM reviews
            JOIN movies ON reviews.movie_id = movies.id
            JOIN users ON reviews.customer_id = users.id
        ";
        return $this->fetchAll($sql);
    }

    public function updateReviewStatus($reviewId, $status)
    {
        $sql = "UPDATE reviews SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':id' => $reviewId
        ]);
    }

    public function deleteReview($reviewId)
    {
        $sql = "DELETE FROM reviews WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $reviewId]);
    }
}