<?php
namespace App\controllers;

use App\Models\DataSeeder;
use App\models\MovieManager;
use App\models\ScreeningManager;
use App\Models\ReservationManager;
use App\Models\SeatManager;
use App\Models\UsersManager;

class UsersController
{
    private $usersManager;

    public function __construct()
    {
        $this->usersManager = new UsersManager();
    }

    public function showAccountPage()
    {
        //$movies = $this->moviesManager->getAllMovies();

        require __DIR__ . '/../views/frontend/mon-compte.php';
    }
}