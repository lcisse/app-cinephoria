<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

            case 'reservation':
                if(isset($_GET['cinema']) && !empty($_GET['cinema'])) {
                    $cinema = $_GET['cinema']; 
                    $this->controller->showMoviesByCinema($cinema);
                }
                break;    

            case 'seances':
                if (isset($_GET['movie_id'])) {
                    $movieId = (int)$_GET['movie_id']; 
                    $this->controller->showScreenings($movieId);
                }
                break;
                
            case 'getScreenings':  // Requête Ajax pour les séances par jour
                if (isset($_GET['movie_id']) && isset($_GET['date'])) {
                    $this->controller->handleScreeningsRequest();
                }
                break;

            case 'reservationsSeats':
                if (isset($_GET['screening_id'])) {
                    $this->controller->reservationsSeats($_GET['screening_id']);
                }
                break;

            case 'getSeats':
                if (isset($_GET['screening_id'])) {
                    $this->controller->handleSeatsRequest($_GET['screening_id']);
                }
                break; 
                       
            case 'recapCommande':
                    $this->controller->showRecapCommande();
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
