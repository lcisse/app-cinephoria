<?php
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

    public function seedMovies($count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            $sql = "INSERT INTO movies (title, description, age_minimum, favorite, poster, rating) 
                    VALUES (:title, :description, :age_minimum, :favorite, :poster, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => $this->faker->sentence(3), // Titre du film aléatoire
                ':description' => $this->faker->paragraph, // Description aléatoire
                ':age_minimum' => $this->faker->numberBetween(7, 18), // Âge aléatoire
                ':favorite' => $this->faker->boolean, // Coup de cœur aléatoire
                ':poster' => $this->faker->imageUrl(200, 300, 'movies'), // URL d'image aléatoire
                ':rating' => $this->faker->randomFloat(2, 1, 5) // Note aléatoire
            ]);
        }

        echo "$count films ont été ajoutés avec succès.\n";
    }
}

// Exécuter le seeder avec 10 films
$seeder = new DataSeeder();
$seeder->seedMovies(10);