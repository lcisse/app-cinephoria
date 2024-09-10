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

    public function showFimsPage()
    {
        $movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/films.php';
    }
}
