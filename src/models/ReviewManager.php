<?php
namespace App\models;

use PDO;

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
            ORDER BY reviews.submission_date DESC
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

    public function addReview($userId, $movieId, $reviewText, $rating)
    {
        $sql = "INSERT INTO reviews (movie_id, customer_id, review_text, rating, status, submission_date)
                VALUES (:movie_id, :customer_id, :review_text, :rating, 'pending', NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':movie_id' => $movieId,
            ':customer_id' => $userId,
            ':review_text' => $reviewText,
            ':rating' => $rating
        ]);
    }

    public function getApprovedReviewCount($movieId)
    {
        $sql = "SELECT COUNT(*) AS approved_review_count 
                FROM reviews 
                WHERE movie_id = :movie_id 
                AND status = 'approved'";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['approved_review_count'] ?? NULL;  // Retourner le nombre d'avis approuvés ou 0 s'il n'y en a pas
    }
}