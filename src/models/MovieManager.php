<?php
namespace App\Models;

use PDO;
use App\Models\BaseManager;

class MovieManager extends BaseManager
{
    public function createMoviesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            age_minimum INT,
            favorite BOOLEAN DEFAULT 0,
            poster VARCHAR(255) NOT NULL,
            rating FLOAT,
            publication_date DATE
        )";
        $this->executeQuery($sql, 'Table "movies" créée avec succès.');
    }

    public function getAllMovies()
    {
        $sql = "SELECT 
                    movies.id, 
                    movies.title, 
                    movies.description, 
                    movies.age_minimum, 
                    movies.favorite,
                    movies.poster,
                    GROUP_CONCAT(DISTINCT genres.genre_name SEPARATOR ', ') AS genre,  -- Agrégation des genres
                    cinemas.id AS cinema_id, 
                    cinemas.cinema_name AS cinema, 
                    GROUP_CONCAT(DISTINCT DATE_FORMAT(movie_schedule.screening_day, '%W') SEPARATOR ', ') AS screening_days  -- Agrégation des jours de projection
                FROM movies
                LEFT JOIN movie_genres ON movies.id = movie_genres.movie_id
                LEFT JOIN genres ON movie_genres.genre_id = genres.id
                LEFT JOIN movie_schedule ON movies.id = movie_schedule.movie_id
                LEFT JOIN cinemas ON movie_schedule.cinema_id = cinemas.id
                GROUP BY movies.id  
                ORDER BY movies.id DESC";  // Groupement par film

        return $this->fetchAll($sql);
    }

    public function getPaginatedMovies($offset, $limit)
    {
        $sql = "SELECT 
                    movies.id, 
                    movies.title, 
                    movies.description, 
                    movies.age_minimum, 
                    movies.favorite,
                    movies.poster,
                    GROUP_CONCAT(DISTINCT genres.genre_name SEPARATOR ', ') AS genre,
                    cinemas.id AS cinema_id, 
                    cinemas.cinema_name AS cinema,
                    GROUP_CONCAT(DISTINCT DATE_FORMAT(movie_schedule.screening_day, '%W') SEPARATOR ', ') AS screening_days
                FROM movies
                LEFT JOIN movie_genres ON movies.id = movie_genres.movie_id
                LEFT JOIN genres ON movie_genres.genre_id = genres.id
                LEFT JOIN movie_schedule ON movies.id = movie_schedule.movie_id
                LEFT JOIN cinemas ON movie_schedule.cinema_id = cinemas.id
                GROUP BY movies.id
                ORDER BY movies.id DESC
                LIMIT :offset, :limit";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalMoviesCount()
    {
        $sql = "SELECT COUNT(*) AS total FROM movies";
        $result = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getMoviesSinceLastWednesday()
    {
        $lastWednesday = new \DateTime('last Wednesday');
        $formattedDate = $lastWednesday->format('Y-m-d');

        $sql = "SELECT id, title, poster 
                FROM movies 
                WHERE publication_date >= :lastWednesday 
                ORDER BY publication_date DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':lastWednesday' => $formattedDate]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovieAverageRating($movieId)
    {
        $sql = "SELECT AVG(rating) AS average_rating FROM reviews WHERE movie_id = :movie_id AND status = 'approved'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['average_rating'] ?? null;  // Retourner la note moyenne ou null s'il n'y a pas d'avis
    }

    /*public function getMovieScreenings($movieId)
    {
        $sql = "SELECT
                    movies.title,
                    movies.description, 
                    movies.poster,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    screenings.screening_day,
                    cinemas.cinema_name
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id 
                JOIN movie_schedule ON screenings.movie_id = movie_schedule.movie_id 
                JOIN cinemas ON movie_schedule.cinema_id = cinemas.id
                WHERE movies.id = :movie_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function getMovieScreeningsByCinema($movieId, $cinemaId)
    {
        $sql = "SELECT
                    movies.title,
                    movies.description, 
                    movies.poster,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    screenings.id,
                    screenings.screening_day,
                    cinemas.cinema_name
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id 
                JOIN cinemas ON rooms.cinema_id = cinemas.id
                WHERE movies.id = :movie_id AND cinemas.id = :cinema_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->bindParam(':cinema_id', $cinemaId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function getScreeningsByDate($movieId, $date)
    {
        $sql = "SELECT 
                    movies.title,
                    movies.description, 
                    movies.poster,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    screenings.screening_day,
                    screenings.id
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id
                WHERE movies.id = :movie_id
                AND screenings.screening_day = :screening_day";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->bindParam(':screening_day', $date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }*/

    public function getScreeningsByMovieAndCinemaAndDate($movieId, $cinemaId, $date)
    {
        $sql = "SELECT 
                    screenings.id,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality
                FROM screenings
                JOIN rooms ON screenings.room_id = rooms.id
                JOIN cinemas ON rooms.cinema_id = cinemas.id
                WHERE screenings.movie_id = :movie_id
                AND cinemas.id = :cinema_id
                AND screenings.screening_day = :screening_day";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->bindParam(':cinema_id', $cinemaId, PDO::PARAM_INT);
        $stmt->bindParam(':screening_day', $date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getScreeningDetails($screening_id)
    {
        $sql = "SELECT 
                    screenings.id,
                    movies.id AS movie_id,
                    movies.title,
                    movies.description,
                    movies.poster,
                    cinemas.id AS cinema_id,
                    cinemas.cinema_name AS cinema,
                    rooms.id AS room_id,
                    rooms.room_number,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time,
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,
                    screenings.screening_day,
                    rooms.seat_capacity,
                    rooms.projection_quality
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id
                JOIN cinemas ON rooms.cinema_id = cinemas.id
                WHERE screenings.id = :screening_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':screening_id', $screening_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMoviesByCinema($cinema)
    {
        $sql = "SELECT 
                    movies.id, 
                    movies.title, 
                    movies.description, 
                    movies.age_minimum, 
                    movies.favorite,
                    movies.poster,
                    GROUP_CONCAT(DISTINCT genres.genre_name SEPARATOR ', ') AS genre,  -- Agrégation des genres
                    cinemas.id AS cinema_id, 
                    cinemas.cinema_name AS cinema,
                    GROUP_CONCAT(DISTINCT DATE_FORMAT(movie_schedule.screening_day, '%W') SEPARATOR ', ') AS screening_days  -- Agrégation des jours de projection
                FROM movies
                JOIN movie_schedule ON movies.id = movie_schedule.movie_id  -- INNER JOIN pour forcer la relation
                JOIN cinemas ON movie_schedule.cinema_id = cinemas.id
                LEFT JOIN movie_genres ON movies.id = movie_genres.movie_id
                LEFT JOIN genres ON movie_genres.genre_id = genres.id
                WHERE cinemas.cinema_name = :cinema_name  -- Filtrer par cinéma
                GROUP BY movies.id
                ORDER BY movies.id DESC";  // Groupement par film

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cinema_name', $cinema, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function getSeatsByScreening($screening_id)
    {
        $sql = "SELECT seats.id, seats.seat_number, seats.reserved, seats.is_accessible 
                FROM seats 
                JOIN rooms ON seats.room_id = rooms.id
                JOIN screenings ON rooms.id = screenings.room_id
                WHERE screenings.id = :screening_id
                AND seats.room_id = (SELECT room_id FROM screenings WHERE id = :screening_id)
                ORDER BY seat_number ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':screening_id', $screening_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Renvoie les résultats des sièges
    }*/

    public function getSeatsByScreening($screening_id)
    {
        $sql = "SELECT id, seat_number, reserved, is_accessible
                FROM seats
                WHERE screening_id = :screening_id
                ORDER BY seat_number ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':screening_id', $screening_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Renvoie les résultats des sièges
    }

    public function createReservation($userId, $movieId, $screeningId, $seats, $price, $qrCode)
    {
        // Convertir les sièges en tableau
        if (!is_array($seats)) {
            $seats = explode(', ', $seats); 
        }

        //$screeningDetails = $this->getScreeningDetails($screeningId);
        
        //$roomId = $screeningDetails['room_id']; 

        // Commencer la transaction 
        $this->pdo->beginTransaction();

        try {
            $sql = "INSERT INTO reservations (user_id, movie_id, screening_id, seats, price, status, qr_code, scanned) 
                    VALUES (:user_id, :movie_id, :screening_id, :seats, :price, 'confirmed', :qr_code, 0)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':movie_id' => $movieId,
                ':screening_id' => $screeningId,
                ':seats' => implode(', ', $seats), 
                ':price' => $price,
                ':qr_code' => $qrCode
            ]);

            $this->updateSeatsAsReserved($seats, $screeningId);

            // Confirmer la transaction
            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e; 
        }
    }

    public function updateSeatsAsReserved(array $seats, $screeningId)
    {
        // Construire la requête pour mettre à jour plusieurs sièges dans une salle spécifique
        $placeholders = implode(',', array_fill(0, count($seats), '?')); // Crée un nombre de placeholders égaux au nombre de sièges

        $sql = "UPDATE seats SET reserved = 1 WHERE seat_number IN ($placeholders) AND screening_id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(array_merge($seats, [$screeningId]));
    }

    public function getAllCinemas()
    {
        $sql = "SELECT * FROM cinemas";
        return $this->fetchAll($sql);
    }

    public function createMovie($title, $description, $ageMinimum, $favorite, $poster)
    {
        $sql = "INSERT INTO movies (title, description, age_minimum, favorite, poster, publication_date) 
                VALUES (:title, :description, :age_minimum, :favorite, :poster, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':age_minimum' => $ageMinimum,
            ':favorite' => $favorite,
            ':poster' => $poster
        ]);

        return $this->pdo->lastInsertId(); // Retourner l'ID du film créé
    }

    public function deleteFilm($filmId)
    {
        $sql = "DELETE FROM movies WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $filmId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateFilm($filmId, $title, $description, $ageMinimum, $favorite, $publicationDate, $poster = null)
    {
        $sql = "UPDATE movies SET title = :title, description = :description, age_minimum = :age_minimum, favorite = :favorite, publication_date = :publication_date";
        
        if ($poster !== null) {
            $sql .= ", poster = :poster";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':age_minimum' => $ageMinimum,
            ':favorite' => $favorite,
            ':id' => $filmId,
            'publication_date' => $publicationDate
        ];

        if ($poster !== null) {
            $params[':poster'] = $poster;
        }

        $stmt->execute($params);
    }

    public function getFilmById($filmId)
    {
        $sql = "SELECT id, title, description, age_minimum, favorite, poster, publication_date FROM movies WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $filmId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

}