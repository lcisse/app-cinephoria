<?php

require __DIR__ . '/vendor/autoload.php';

use App\controllers\MoviesController;


$controller = new MoviesController();
$controller->showHome();