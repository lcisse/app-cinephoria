<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php'; 

use App\controllers\MovieController;
use App\Models\DatabaseSeeder;


/*$controller = new MovieController();
$controller->showHome();
$controller->showFimsPage(2);*/


/*$seeder = new DatabaseSeeder();
$seeder->createAllTables();*/

class App
{
    private $controller;

    public function __construct()
    {
        $this->controller = new MovieController();
    }

    public function run($action)
    {
        switch ($action) {
            case 'home':
                $this->controller->showHome();
                break;

            case 'films':
                // Si vous souhaitez passer un paramètre (par exemple l'ID du film)
                $movieId = isset($_GET['id']) ? (int)$_GET['id'] : null;
                $this->controller->showFimsPage($movieId);
                break;

            case 'films':
                // Si vous souhaitez passer un paramètre (par exemple l'ID du film)
                $movieId = isset($_GET['id']) ? (int)$_GET['id'] : null;
                $this->controller->showFimsPage($movieId);
                break;

            case 'seances':
                $movieId = isset($_GET['movie_id']);
                if ($movieId) {
                    $this->controller->showScreenings($movieId);
                }
                break;    

            default:
                // Par défaut, afficher la page d'accueil
                $this->controller->showHome();
                break;
        }
    }
}

//use App\App;

$app = new App();
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$app->run($action);
