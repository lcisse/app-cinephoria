<?php
namespace App\Models;

require __DIR__ . '/../../vendor/autoload.php';

use App\Models\Manager;

class MoviesManager
{
    private $pdo;

    // Constructeur : utiliser la connexion via le Singleton
    public function __construct()
    {
        // Obtenir la connexion via la classe Singleton
        $this->pdo = Manager::getInstance()->getConnection();
        echo "Connexion réussie à la base de données via le Singleton.\n";
    }

    // Méthode pour créer la table "movies"
    public function createMoviesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            age_minimum INT,
            favorite BOOLEAN DEFAULT 0,
            poster VARCHAR(255),
            rating FLOAT
        )";
        $this->executeQuery($sql, 'Table "movies" créée avec succès.');
    }

    // Méthode pour créer la table "genres"
    public function createGenresTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS genres (
            id INT PRIMARY KEY AUTO_INCREMENT,
            genre_name VARCHAR(255) NOT NULL
        )";
        $this->executeQuery($sql, 'Table "genres" créée avec succès.');
    }

    // Méthode pour créer la table "movie_genres"
    public function createMovieGenresTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movie_genres (
            movie_id INT,
            genre_id INT,
            PRIMARY KEY (movie_id, genre_id),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "movie_genres" créée avec succès.');
    }

    // Méthode pour créer la table "cinemas"
    public function createCinemasTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS cinemas (
            id INT PRIMARY KEY AUTO_INCREMENT,
            cinema_name VARCHAR(255) NOT NULL,
            location VARCHAR(255)
        )";
        $this->executeQuery($sql, 'Table "cinemas" créée avec succès.');
    }

    // Méthode pour créer la table "movie_schedule"
    public function createMovieScheduleTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movie_schedule (
            movie_id INT,
            cinema_id INT,
            screening_day DATE,
            PRIMARY KEY (movie_id, cinema_id, screening_day),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "movie_schedule" créée avec succès.');
    }

    // Méthode pour exécuter une requête SQL et afficher un message
    private function executeQuery($sql, $successMessage)
    {
        try {
            $this->pdo->exec($sql);
            echo $successMessage . "\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la table : " . $e->getMessage() . "\n";
        }
    }
}

// Utilisation de la classe pour créer les tables en passant par le Singleton
$moviesManager = new MoviesManager();
$moviesManager->createMoviesTable();
$moviesManager->createGenresTable();
$moviesManager->createMovieGenresTable();
$moviesManager->createCinemasTable();
$moviesManager->createMovieScheduleTable();