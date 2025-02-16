<?php
namespace App\models;

use PDO;
use PDOException;

class UsersManager extends BaseManager
{
    public function createUsersTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            username VARCHAR(100) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('administrator', 'employee', 'user') NOT NULL
        )";
        
        $this->executeQuery($sql, 'Table "users" créée avec succès.');
    }

    public function addUser($firstName, $lastName, $username, $email, $password, $role)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (first_name, last_name, username, email, password, role) 
                    VALUES (:first_name, :last_name, :username, :email, :password, :role)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':role' => $role
            ]);

            //echo "Utilisateur ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Renvoie l'utilisateur correspondant
    }

    public function getEmployees()
    {
        $sql = "SELECT id, first_name, last_name, username, email FROM users WHERE role = 'employee'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, first_name, last_name, username, email, role FROM users";
        return $this->fetchAll($sql);
    }

    public function deleteEmployee($employeeId)
    {
        $sql = "DELETE FROM users WHERE id = :id AND role = 'employee'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $employeeId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function resetEmployeePassword($employeeId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password = :password WHERE id = :id AND role = 'employee'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $employeeId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteUserByEmail($email)
    {
        try {
            $sql = "DELETE FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0; // Retourne true si un utilisateur a été supprimé
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }

}