-- Insertion des données de test

-- Utilisateurs
INSERT INTO users (first_name, last_name, username, email, password, role) VALUES
('Admin', 'User', 'admin', 'admin@example.com', 'hashed_password', 'administrator'),
('John', 'Doe', 'johndoe', 'john@example.com', 'hashed_password', 'employee'),
('Jane', 'Smith', 'janesmith', 'jane@example.com', 'hashed_password', 'user');

-- Cinémas
INSERT INTO cinemas (cinema_name, location) VALUES
('Cinema Paris', 'Paris'),
('Cinema Lille', 'Lille'),
('Cinema Nantes', 'Nantes');

-- Salles
INSERT INTO rooms (cinema_id, room_number, seat_capacity, projection_quality) VALUES
(1, '01', 100, '2D'),
(1, '02', 80, '3D'),
(2, '01', 120, 'IMAX'),
(3, '01', 90, '4DX');

-- Genres
INSERT INTO genres (genre_name) VALUES
('Action'),
('Drama'),
('Comedy'),
('Thriller');

-- Films
INSERT INTO movies (title, description, age_minimum, favorite, poster, publication_date) VALUES
('Inception', 'A mind-bending thriller.', 13, 1, 'inception.jpg', '2010-07-16'),
('Avatar', 'An epic sci-fi adventure.', 10, 1, 'avatar.jpg', '2009-12-18');

-- Genres des films
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(1, 4),
(2, 1);

-- Horaires des films
INSERT INTO movie_schedule (movie_id, cinema_id, screening_day) VALUES
(1, 1, '2024-11-07'),
(2, 2, '2024-11-08');

-- Projections
INSERT INTO screenings (movie_id, room_id, screening_day, start_time, end_time) VALUES
(1, 1, '2024-11-07', '14:00:00', '16:30:00'),
(2, 2, '2024-11-08', '18:00:00', '21:00:00');

-- Sièges
INSERT INTO seats (room_id, cinema_id, screening_id, seat_number, is_accessible) VALUES
(1, 1, 1, '01', 1),
(1, 1, 1, '02', 1),
(2, 2, 2, '01', 1);

-- Réservations
INSERT INTO reservations (user_id, movie_id, screening_id, seats, price, status, qr_code) VALUES
(3, 1, 1, '01, 02', 20.00, 'confirmed', 'QR12345');

-- Critiques
INSERT INTO reviews (movie_id, customer_id, review_text, rating, status) VALUES
(1, 3, 'Amazing movie!', 5, 'approved');
