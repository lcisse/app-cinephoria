<?php
use PHPUnit\Framework\TestCase;

use App\models\UsersManager;

class UsersManagerTest extends TestCase
{
    private $pdo;
    private $usersManager;

    protected function setUp(): void
    {
        // Connexion à une base de test SQLite en mémoire
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Création de la table users pour le test
        $this->pdo->exec("CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            first_name TEXT,
            last_name TEXT,
            username TEXT UNIQUE,
            email TEXT UNIQUE,
            password TEXT,
            role TEXT
        )");

        $this->usersManager = new UsersManager();
        $this->usersManager->setPdo($this->pdo);
    }

    /** @test */
   public function testAjoutUtilisateur()
    {
        $this->usersManager->addUser("John", "Doe", "johndoe", "john@example.com", "Password123!", "user");

        $user = $this->usersManager->getUserByEmail("john@example.com");

        // Vérification des données enregistrées
        $this->assertNotEmpty($user, "❌ Échec : l'utilisateur n'a pas été inséré !");
        print_r("✅ Succès : L'utilisateur a bien été inséré avec l'email " . $user['email'] . PHP_EOL);

        $this->assertEquals("johndoe", $user['username'], "❌ Échec : Le username ne correspond pas !");
        print_r("✅ Succès : Le username correspond bien à johndoe." . PHP_EOL);
    }

    /** @test */
    public function testConnexionUtilisateur()
    {
        $this->usersManager->addUser("Jane", "Doe", "janedoe", "jane@example.com", "Password123!", "user");
        
        $user = $this->usersManager->getUserByEmail("jane@example.com");
        $this->assertNotEmpty($user, "❌ Échec : Utilisateur non trouvé !");
        print_r("✅ Succès : Utilisateur jane@example.com trouvé." . PHP_EOL);

        // Vérification du mot de passe (hashé)
        $passwordCorrect = password_verify("Password123!", $user['password']);
        $this->assertTrue($passwordCorrect, "❌ Échec : Le mot de passe ne correspond pas !");
        print_r("✅ Succès : Connexion réussie pour l'utilisateur jane@example.com." . PHP_EOL);

        // Email incorrect
        $userInvalidEmail = $this->usersManager->getUserByEmail("fake@example.com");
        $this->assertEmpty($userInvalidEmail, "❌ Échec : L'email inexistant retourne un utilisateur !");
        print_r("✅ Succès : Aucune connexion possible avec un email inexistant." . PHP_EOL);

        // Mot de passe incorrect
        $wrongPassword = password_verify("WrongPassword!", $user['password']);
        $this->assertFalse($wrongPassword, "❌ Échec : Le mot de passe incorrect fonctionne !");
        print_r("✅ Succès : Le mot de passe incorrect empêche la connexion." . PHP_EOL);
    }

}
