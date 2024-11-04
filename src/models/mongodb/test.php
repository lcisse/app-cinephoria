<?php
namespace App\models\mongodb;

use App\models\mongodb\MongoDBConnection;
require __DIR__ . '/../../../vendor/autoload.php';  

$mongo = MongoDBConnection::getInstance();
$collection = $mongo->getCollection('reservations');
echo "Connexion réussie à MongoDB !";