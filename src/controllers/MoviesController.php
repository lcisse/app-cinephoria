<?php
namespace App\controllers;

require __DIR__ . '/../../vendor/autoload.php';

use App\models\MoviesManager;

class MoviesController
{
    private $moviesManager;

    public function __construct()
    {
        $this->moviesManager = new MoviesManager();
    }

    public function showHome()
    {
        $movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/home.php';
    }
}