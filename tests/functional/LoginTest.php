<?php
use PHPUnit\Framework\TestCase;
use App\controllers\UsersController;
use App\models\UsersManager;

define('PHPUNIT_RUNNING', true);

class LoginTest extends TestCase
{
    private $usersManager;
    private $usersController;
    private $testEmail = 'jane@example.com';
    private $testPassword = 'Password123!';
    private $testUser = [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'username' => 'jane_doe',
        'email' => 'jane@example.com',
        'password' => 'Password123!',
        'role' => 'user'
    ];

    protected function setUp(): void
    {
        $this->usersManager = new UsersManager();
        $this->usersController = new UsersController();

        // Vérifie si l'utilisateur existe déjà et le supprime avant le test
        if ($this->usersManager->getUserByEmail($this->testEmail)) {
            $this->usersManager->deleteUserByEmail($this->testEmail);
        }

        // Ajoute un utilisateur de test
        $this->usersManager->addUser(
            $this->testUser['first_name'],
            $this->testUser['last_name'],
            $this->testUser['username'],
            $this->testUser['email'],
            $this->testUser['password'],
            $this->testUser['role']
        );

        print_r("✅ Utilisateur de test ajouté avec succès.\n");
    }

    protected function tearDown(): void
    {
        // Supprime l'utilisateur après chaque test 
        $this->usersManager->deleteUserByEmail($this->testEmail);
        print_r("🗑️ Utilisateur de test supprimé après exécution du test.\n");
    }

    public function testLoginSuccess()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $this->testEmail;
        $_POST['password'] = $this->testPassword;

        ob_start();
        $this->usersController->login();
        $output = ob_get_clean();

        // Vérifier que l'utilisateur est connecté
        $this->assertArrayHasKey('user_id', $_SESSION, "❌ Échec : L'utilisateur n'est pas authentifié !");
        print_r("✅ Succès : L'utilisateur est bien connecté.\n");

        // Vérifier que la redirection est bien simulée
        $this->assertStringContainsString("Redirect: index.php?action=myAccount", $output, "❌ Échec : Aucune redirection détectée.");
    }

    /** @test */
    public function testLoginWithInvalidEmail()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = 'fake@example.com';
        $_POST['password'] = $this->testPassword;

        ob_start();
        $this->usersController->login();
        $output = ob_get_clean();

        $this->assertStringContainsString("Email ou mot de passe incorrect.", $output, "❌ Échec : L'email inexistant a été accepté !");
        print_r("✅ Succès : Tentative de connexion avec un email inexistant rejetée.\n");
    }

    /** @test */
    public function testLoginWithWrongPassword()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['email'] = $this->testEmail;
        $_POST['password'] = 'WrongPassword!';

        ob_start();
        $this->usersController->login();
        $output = ob_get_clean();

        $this->assertStringContainsString("Email ou mot de passe incorrect.", $output, "❌ Échec : Un mauvais mot de passe a été accepté !");
        print_r("✅ Succès : Tentative de connexion avec un mot de passe incorrect rejetée.\n");
    }
}



