<?php

require __DIR__ . '/vendor/autoload.php';

use App\controllers\MovieController;
use App\Models\DatabaseSeeder;


$controller = new MovieController();
$controller->showHome();


/*$seeder = new DatabaseSeeder();
$seeder->createAllTables();*/
