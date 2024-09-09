<?php

require __DIR__ . '/vendor/autoload.php';

use App\controllers\MovieController;


$controller = new MovieController();
$controller->showHome();
