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

    public function showGestionEmployes()
    {
        $employes = $this->usersManager->getEmployees();

        session_start();

        require __DIR__ . '/../../views/backend/gestion-employes.php';
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
                session_start();
                $_SESSION['errorEm'] = "Email invalide.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            if (!$this->usersController->isValidPassword($password)) {
                session_start();
                $_SESSION['errorEm'] = "Le mot de passe doit comporter au moins 8 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            if ($password !== $confirmPassword) {
                session_start();
                $_SESSION['errorEm'] = "Les mots de passe ne correspondent pas.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            $role = 'employee';

            try {
                $this->usersManager->addUser($firstName, $lastName, $username, $email, $password, $role);

                session_start();
                $_SESSION['messageEmploye'] = "Compte employé créé avec succès !";

                header('Location: index.php?action=admin-employes');
                exit();
            } catch (\Exception $e) {
                session_start();
                $_SESSION['errorEm'] = "Erreur lors de la création du compte employé : " . $e->getMessage();
                header('Location: index.php?action=admin-employes');
                exit();
            }
        }
    }

    public function deleteEmployee()
    {
        if (isset($_GET['id'])) {
            $employeeId = (int)$_GET['id'];

            try {
                $this->usersManager->deleteEmployee($employeeId);
                session_start();
                $_SESSION['messageEmploye'] = "Employé supprimé avec succès !";
            } catch (\Exception $e) {
                $_SESSION['errorEm'] = "Erreur lors de la suppression de l'employé : " . $e->getMessage();
            }

            header('Location: index.php?action=admin-employes');
            exit();
        }
    }

    /*public function resetEmployeePassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $employeeId = $data['employee_id'];
        $newPassword = $data['new_password'];

        // Vérification de la force du mot de passe
        if (!$this->usersController->isValidPassword($newPassword)) {
            echo json_encode([
                'success' => false,
                'message' => "Le mot de passe doit comporter au moins 8 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial."
            ]);
            return;
        }

        try {
            $this->usersManager->resetEmployeePassword($employeeId, $newPassword);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }*/

    public function resetEmployeePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = $_POST['employee_id'];
            $newPassword = $_POST['new_password'];

            if (!$this->usersController->isValidPassword($newPassword)) {
                session_start();
                $_SESSION['errorEm'] = "Le mot de passe doit comporter au moins 8 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.";
                header('Location: index.php?action=admin-employes');
                exit();
            }

            try {
                $this->usersManager->resetEmployeePassword($employeeId, $newPassword);
                session_start();
                $_SESSION['messageEmploye'] = "Mot de passe réinitialisé avec succès !";
                header('Location: index.php?action=admin-employes');
                exit();
            } catch (\Exception $e) {
                session_start();
                $_SESSION['errorEm'] = "Erreur lors de la réinitialisation du mot de passe : " . $e->getMessage();
                header('Location: index.php?action=admin-employes');
                exit();
            }
        }
    }

}