<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php'; 

use App\controllers\MovieController;
use App\controllers\UsersController;
use App\Models\DatabaseSeeder;


/*$controller = new MovieController();
$controller->showHome();
$controller->showFimsPage(2);*/


/*$seeder = new DatabaseSeeder();
$seeder->createAllTables();*/

class App
{
    private $controller;
    private $UsersController;

    public function __construct()
    {
        $this->controller = new MovieController();
        $this->UsersController = new UsersController();
    }

    public function run($action)
    {
        switch ($action) {
            case 'home':
                $this->controller->showHome();
                //$this->UsersController->logout();
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
                if ($this->UsersController->isAuthenticated()) {
                    $this->controller->showRecapCommande();
                } else {
                    header("Location: index.php?action=myAccount");
                }
                break; 

            case 'myAccount':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['action'])) {
                        if ($_POST['action'] === 'createAccount') {
                            $this->UsersController->createAccount();  
                        } elseif ($_POST['action'] === 'login') {
                            $this->UsersController->login(); 
                        }
                    }
                } else {
                    $this->UsersController->showAccountPage();  
                }
                break;

            case 'reservationCreateAccount':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->UsersController->createAccount('recapCommande');
                }
                break;

            case 'reservationLogin':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->UsersController->login('recapCommande');
                }
                break;    
                
            case 'logout':
                $this->UsersController->logout();
                break;  

            case 'checkAuthentication':
                $this->UsersController->checkAuthentication();
                break; 
                
            case 'storeTempReservation':
                // Récupérer les données POST envoyées via fetch en JSON
                $input = json_decode(file_get_contents("php://input"), true);

                if ($input && isset($input['seats'], $input['screeningId'], $input['totalSeats'])) {
                    session_start();
                    $_SESSION['temp_reservation'] = [
                        'seats' => $input['seats'],
                        'screeningId' => $input['screeningId'],
                        'totalSeats' => $input['totalSeats']
                    ];
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Données invalides']);
                }
            break;
            
            case 'confirmReservation':
                if ($this->UsersController->isAuthenticated()) {
                    // Appeler la méthode confirmReservation du MovieController
                    $this->controller->confirmReservation();
                } else {
                    // Si l'utilisateur n'est pas authentifié, rediriger vers la page de connexion
                    header("Location: index.php?action=myAccount");
                }
                break;

            /*case 'confirmPage':
                $this->controller->showConfirmPage();
                break;*/

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
