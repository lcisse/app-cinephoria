<?php
namespace App\controllers;

use App\models\MovieManager;

class MovieController
{
    private $moviesManager;

    public function __construct()
    {
        $this->moviesManager = new MovieManager();
    }

    public function showHome()
    {
        $movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/home.php';
    }

    public function showFimsPage($movieId)
    {
        $movies = $this->moviesManager->getAllMovies();
        
        /*if ($movieId !== null) {
            $filmRating = $this->moviesManager->getMovieAverageRating($movieId);
        } else {
            $filmRating = null; // Si aucun film n'est sélectionné, aucune note n'est calculée
        }*/

        $ratings = [];

        foreach ($movies as $movie) {
            $ratings[$movie['id']] = $this->moviesManager->getMovieAverageRating($movie['id']);
        }

        require __DIR__ . '/../views/frontend/films.php';
    }
}
