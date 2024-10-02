<?php
namespace App\Models;

class UsersManager extends BaseManager
{
    public function createUsersTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('administrator', 'employee', 'user') NOT NULL
        )";
        
        $this->executeQuery($sql, 'Table "users" créée avec succès.');
    }

    public function addUser($firstName, $lastName, $username, $email, $password, $role)
    {
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
        
        echo "Utilisateur ajouté avec succès.";
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, first_name, last_name, username, email, role FROM users";
        return $this->fetchAll($sql);
    }
}