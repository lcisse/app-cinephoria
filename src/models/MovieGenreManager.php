<?php
namespace App\Models;

class MovieGenreManager extends BaseManager
{
    public function createMovieGenresTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movie_genres (
            movie_id INT,
            genre_id INT,
            PRIMARY KEY (movie_id, genre_id),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "movie_genres" créée avec succès.');
    }

    public function getAllMovieGenres()
    {
        $sql = "SELECT * FROM movie_genres";
        return $this->fetchAll($sql);
    }
}