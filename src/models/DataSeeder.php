<?php
namespace App\Models;

require __DIR__ . '/../../vendor/autoload.php';

use App\Models\Manager;
use Faker\Factory;

class DataSeeder
{
    private $pdo;
    private $faker;

    public function __construct()
    {
        $this->pdo = Manager::getInstance()->getConnection();
        $this->faker = Factory::create(); // Initialiser Faker
    }

    // Seeder pour la table movies
   /* public function seedMovies($count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO movies (title, description, age_minimum, favorite, poster, rating) 
                    VALUES (:title, :description, :age_minimum, :favorite, :poster, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => $this->faker->sentence(3),
                ':description' => $this->faker->paragraph,
                ':age_minimum' => $this->faker->numberBetween(7, 18),
                ':favorite' => $this->faker->boolean,
                ':poster' => $this->faker->imageUrl(200, 300, 'movies')
            ]);
        }
        echo "$count films ont été ajoutés avec succès.\n";
    }*/

    // Seeder pour la table cinemas
    /*public function seedCinemas($count = 5)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO cinemas (cinema_name, location) 
                    VALUES (:cinema_name, :location)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':cinema_name' => $this->faker->company,
                ':location' => $this->faker->city
            ]);
        }
        echo "$count cinémas ont été ajoutés avec succès.\n";
    }

    // Seeder pour la table genres
    public function seedGenres($count = 5)
    {
        $genres = ['Action', 'Comédie', 'Drame', 'Thriller', 'Science-fiction', 'Horreur'];
        foreach ($genres as $genre) {
            $sql = "INSERT INTO genres (genre_name) VALUES (:genre_name)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':genre_name' => $genre]);
        }
        echo "Genres ont été ajoutés avec succès.\n";
    }

    // Seeder pour la table movie_genres (relation many-to-many entre movies et genres)
    public function seedMovieGenres($count = 20)
    {

        for ($i = 0; $i < $count; $i++) {
            $movieId = $this->faker->numberBetween(1, 10);
            $genreId = $this->faker->numberBetween(1, 6);
    
            // Vérifier si la combinaison existe déjà
            $sqlCheck = "SELECT COUNT(*) FROM movie_genres WHERE movie_id = :movie_id AND genre_id = :genre_id";
            $stmtCheck = $this->pdo->prepare($sqlCheck);
            $stmtCheck->execute([':movie_id' => $movieId, ':genre_id' => $genreId]);
            $exists = $stmtCheck->fetchColumn();
    
            // Si la combinaison n'existe pas, insérer la nouvelle ligne
            if (!$exists) {
                $sql = "INSERT INTO movie_genres (movie_id, genre_id) VALUES (:movie_id, :genre_id)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':movie_id' => $movieId, ':genre_id' => $genreId]);
            }
        }
        echo "$count relations films-genres ont été ajoutées avec succès.\n";
    }

    // Seeder pour la table movie_schedule
    public function seedMovieSchedule($count = 20)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO movie_schedule (movie_id, cinema_id, screening_day) 
                    VALUES (:movie_id, :cinema_id, :screening_day)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':movie_id' => $this->faker->numberBetween(1, 10),
                ':cinema_id' => $this->faker->numberBetween(1, 5),
                ':screening_day' => $this->faker->date
            ]);
        }
        echo "$count séances de films ont été ajoutées avec succès.\n";
    }

    // Seeder pour la table rooms
    public function seedRooms($count = 5)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO rooms (cinema_id, room_number, seat_capacity, projection_quality, incident_notes) 
                    VALUES (:cinema_id, :room_number, :seat_capacity, :projection_quality, :incident_notes)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':cinema_id' => $this->faker->numberBetween(1, 5),
                ':room_number' => $this->faker->numberBetween(1, 10),
                ':seat_capacity' => $this->faker->numberBetween(50, 200),
                ':projection_quality' => $this->faker->randomElement(['4K', '3D', 'IMAX']),
                ':incident_notes' => $this->faker->sentence
            ]);
        }
        echo "$count salles de cinéma ont été ajoutées avec succès.\n";
    }

    // Seeder pour la table seats
    public function seedSeats($count = 50)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO seats (room_id, seat_number, reserved_for_disabled) 
                    VALUES (:room_id, :seat_number, :reserved_for_disabled)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':room_id' => $this->faker->numberBetween(1, 5),
                ':seat_number' => $this->faker->numberBetween(1, 200),
                ':reserved_for_disabled' => $this->faker->boolean
            ]);
        }
        echo "$count sièges ont été ajoutés avec succès.\n";
    }

    // Seeder pour la table screenings
    public function seedScreenings($count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO screenings (movie_id, room_id, start_time, end_time, projection_quality) 
                    VALUES (:movie_id, :room_id, :start_time, :end_time, :projection_quality)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':movie_id' => $this->faker->numberBetween(1, 10),
                ':room_id' => $this->faker->numberBetween(1, 5),
                ':start_time' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ':end_time' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ':projection_quality' => $this->faker->randomElement(['4K', '3D', 'IMAX'])
            ]);
        }
        echo "$count projections ont été ajoutées avec succès.\n";
    }

    // Seeder pour la table reservations
    public function seedReservations($count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO reservations (screening_id, seat_id, price, reservation_date, customer_id, status) 
                    VALUES (:screening_id, :seat_id, :price, :reservation_date, :customer_id, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':screening_id' => $this->faker->numberBetween(1, 10),
                ':seat_id' => $this->faker->numberBetween(1, 50),
                ':price' => $this->faker->randomFloat(2, 5, 20),
                ':reservation_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ':customer_id' => $this->faker->numberBetween(1, 100),
                ':status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled'])
            ]);
        }
        echo "$count réservations ont été ajoutées avec succès.\n";
    }

    // Seeder pour la table reviews
    public function seedReviews($count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO reviews (movie_id, customer_id, review_text, rating, status, submission_date) 
                    VALUES (:movie_id, :customer_id, :review_text, :rating, :status, :submission_date)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':movie_id' => $this->faker->numberBetween(1, 10),
                ':customer_id' => $this->faker->numberBetween(1, 100),
                ':review_text' => $this->faker->paragraph,
                ':rating' => $this->faker->numberBetween(1, 5),
                ':status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
                ':submission_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s')
            ]);
        }
        echo "$count avis ont été ajoutés avec succès.\n";
    }*/

    public function seedSeats($roomCount = 5, $seatsPerRoom = 20)
    {
        for ($roomId = 1; $roomId <= $roomCount; $roomId++) {
            for ($seatNumber = 1; $seatNumber <= $seatsPerRoom; $seatNumber++) {
                $seatNum = sprintf("%02d", $seatNumber);
                $isAccessible = $this->faker->boolean(10);  // 10% de sièges pour PMR

                $sql = "INSERT INTO seats (room_id, seat_number, reserved, is_accessible) 
                        VALUES (:room_id, :seat_number, :reserved, :is_accessible)";
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':room_id' => $roomId,
                    ':seat_number' => $seatNum,
                    ':reserved' => 0,  // Tous les sièges sont libres initialement
                    ':is_accessible' => $isAccessible
                ]);
            }
        }

        echo "Fausses données insérées dans la table seats.\n";
    }

    // Insérer des fausses données dans la table reservations
    public function seedReservations($reservationCount = 50)
    {
        for ($i = 0; $i < $reservationCount; $i++) {
            $userId = $this->faker->numberBetween(1, 10);  // Supposons 10 utilisateurs
            $movieId = $this->faker->numberBetween(1, 10); // 10 films
            $screeningId = $this->faker->numberBetween(1, 30); // 30 séances
            $seats = $this->faker->numberBetween(1, 5); // Nombre aléatoire de sièges
            $price = $this->faker->randomFloat(2, 8, 50); // Prix aléatoire
            $qrCode = $this->faker->uuid;  // Générer un UUID pour simuler le QR code
            $status = $this->faker->randomElement(['confirmed', 'pending', 'cancelled']);
            $scanned = $this->faker->boolean(10); // 10% de chances que le billet soit scanné

            $sql = "INSERT INTO reservations (user_id, movie_id, screening_id, seats, price, reservation_date, status, qr_code, scanned) 
                    VALUES (:user_id, :movie_id, :screening_id, :seats, :price, NOW(), :status, :qr_code, :scanned)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':movie_id' => $movieId,
                ':screening_id' => $screeningId,
                ':seats' => $seats,
                ':price' => $price,
                ':status' => $status,
                ':qr_code' => $qrCode,
                ':scanned' => $scanned
            ]);
        }

        echo "$reservationCount réservations ont été ajoutées avec succès.\n";
    }

    
}

// Exécuter le seeder avec 10 films
$seeder = new DataSeeder();
//$seeder->seedMovies(10);
//$seeder->seedMovies();
/*$seeder->seedCinemas();
$seeder->seedGenres();
$seeder->seedMovieGenres();
$seeder->seedMovieSchedule();
$seeder->seedRooms();
$seeder->seedSeats();
$seeder->seedScreenings();
$seeder->seedReservations();
$seeder->seedReviews();*/
$seeder->seedSeats(5, 20);  
$seeder->seedReservations(30);