<?php
namespace App\controllers\backend;

use App\Models\UsersManager;
use App\controllers\UsersController;

class BusersController
{
    private $usersManager;
    private $usersController;
    

    public function __construct()
    {
        $this->usersManager = new UsersManager();
        $this->usersController = new UsersController();
     
    }

    public function createEmployeeAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = htmlspecialchars(trim($_POST['first_name']));
            $lastName = htmlspecialchars(trim($_POST['last_name']));
            $username = htmlspecialchars(trim($_POST['username']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Email invalide.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            if (!$this->usersController->isValidPassword($password)) {
                $_SESSION['error'] = "Le mot de passe doit comporter au moins 8 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            $role = 'employee';

            try {
                $this->usersManager->addUser($firstName, $lastName, $username, $email, $password, $role);

                session_start();
                $_SESSION['message'] = "Compte employé créé avec succès !";

                header('Location: index.php?action=admin-employes');
                exit();
            } catch (\Exception $e) {
                $_SESSION['error'] = "Erreur lors de la création du compte employé : " . $e->getMessage();
                header('Location: index.php?action=admin-employes');
                exit();
            }
        }
    }

    public function showGestionEmployes()
    {
        $employes = $this->usersManager->getEmployees();
        require __DIR__ . '/../../views/backend/gestion-employes.php';
    }

}