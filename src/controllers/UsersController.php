<?php
namespace App\controllers;

use App\Models\DataSeeder;
use App\models\MovieManager;
use App\models\ScreeningManager;
use App\Models\ReservationManager;
use App\Models\SeatManager;
use App\Models\UsersManager;
use App\Services\EmailService;
use Exception;

class UsersController
{
    private $usersManager;

    public function __construct()
    {
        $this->usersManager = new UsersManager();
    }

    public function showAccountPage()
    {
        require __DIR__ . '/../views/frontend/mon-compte.php';
    }

    public function createAccount($redirectPage = 'myAccount')
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $username = htmlspecialchars(trim($_POST['username']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email invalide.";
                return;
            }

            if (!$this->isValidPassword($password)) {
                echo "Le mot de passe doit comporter au moins 8 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.";
                return;
            }

            if ($password !== $confirmPassword) {
                echo "Les mots de passe ne correspondent pas.";
                return;
            }

            try {
                $this->usersManager->addUser($firstName, $lastName, $username, $email, $password, 'user');

                $user = $this->usersManager->getUserByEmail($email);
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php?action=$redirectPage");
                exit();
            } catch (Exception $e) {
                echo "Erreur lors de la création du compte : " . $e->getMessage();
            }
        }
    }

    public function login($redirectPage = 'myAccount')
    {
        var_dump('biennnnnnnnnnnnnnnn');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email invalide.";
                return;
            }

            $user = $this->usersManager->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

            // Vérifier s'il y a des données de réservation en session
            if (isset($_SESSION['temp_reservation'])) {
                // Rediriger vers la page de récapitulatif des commandes
                header("Location: index.php?action=recapCommande");
                exit();
            }

                header("Location: index.php?action=$redirectPage");
                exit();
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }

    private function isValidPassword($password)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($pattern, $password);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?action=myAccount");
        exit();
    }

    public function isAuthenticated()
    {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public function checkAuthentication()
    {
        session_start();
        $isAuthenticated = isset($_SESSION['user_id']);
        echo json_encode(['isAuthenticated' => $isAuthenticated]);
    }
}