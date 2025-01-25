-- Supprimer la base de données existante et créer une nouvelle
DROP DATABASE IF EXISTS lc_cinephoria;
CREATE DATABASE lc_cinephoria;
USE lc_cinephoria;

-- Désactiver les contraintes pour permettre la suppression et la création des tables
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables existantes
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS seats;
DROP TABLE IF EXISTS screenings;
DROP TABLE IF EXISTS movie_schedule;
DROP TABLE IF EXISTS movie_genres;
DROP TABLE IF EXISTS genres;
DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS cinemas;
DROP TABLE IF EXISTS users;

-- Réactiver les contraintes
SET FOREIGN_KEY_CHECKS = 1;

-- Création de la table `users`
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('administrator', 'employee', 'user') NOT NULL
);

-- Création de la table `cinemas`
CREATE TABLE cinemas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cinema_name VARCHAR(255) NOT NULL,
    location VARCHAR(255)
);

-- Création de la table `rooms`
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cinema_id INT,
    room_number VARCHAR(10),
    seat_capacity INT,
    projection_quality VARCHAR(50),
    incident_notes TEXT,
    FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE
);

-- Création de la table `genres`
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(255) NOT NULL
);

-- Création de la table `movies`
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    age_minimum INT,
    favorite BOOLEAN DEFAULT 0,
    poster VARCHAR(255),
    rating FLOAT,
    publication_date DATE
);

-- Création de la table `movie_genres`
CREATE TABLE movie_genres (
    movie_id INT,
    genre_id INT,
    PRIMARY KEY (movie_id, genre_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);

-- Création de la table `movie_schedule`
CREATE TABLE movie_schedule (
    movie_id INT,
    cinema_id INT,
    screening_day DATE,
    PRIMARY KEY (movie_id, cinema_id, screening_day),
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE
);

-- Création de la table `screenings`
CREATE TABLE screenings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    room_id INT,
    screening_day DATE,
    start_time TIME,
    end_time TIME,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- Création de la table `seats`
CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT,
    cinema_id INT,
    screening_id INT,
    seat_number VARCHAR(10),
    reserved TINYINT DEFAULT 0,
    is_accessible TINYINT DEFAULT 0,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,
    FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE,
    FOREIGN KEY (screening_id) REFERENCES screenings(id) ON DELETE CASCADE
);

-- Création de la table `reservations`
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    screening_id INT,
    seats VARCHAR(255),
    price DECIMAL(10, 2),
    reservation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('confirmed', 'pending', 'cancelled') DEFAULT 'pending',
    qr_code VARCHAR(255),
    scanned TINYINT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (screening_id) REFERENCES screenings(id) ON DELETE CASCADE
);

-- Création de la table `reviews`
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    customer_id INT,
    review_text TEXT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    submission_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE
);

