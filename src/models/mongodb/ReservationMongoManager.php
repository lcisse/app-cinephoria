<?php
namespace App\models\mongodb;

//require __DIR__ . '/../../../vendor/autoload.php'; 
use MongoDB\BSON\UTCDateTime;
use MongoDB\Database;
use App\models\mongodb\MongoDBConnection;


class ReservationMongoManager extends MongoDBConnection {
    private $collection;

    public function __construct($dbName = "cinephoriadb") {
        $mongoDBConnection = MongoDBConnection::getInstance($dbName);
        $this->collection = $mongoDBConnection->getCollection('reservations'); // Accède à la collection `reservations`
    }

    // Ajouter une nouvelle réservation
    public function addReservation($movieTitle, $userId, $seats, $price, $status) {
        
        $document = [
            'movie_title' => $movieTitle,
            'reservation_date' => new UTCDateTime(),  // Date actuelle
            'user_id' => $userId,
            'seats_reserved' => $seats,
            'total_price' => $price,
            'status' => $status
        ];
        $this->collection->insertOne($document);
    }
    
    // Récupérer les réservations des 7 derniers jours par film
    public function getReservationsLast7Days() {
        $oneWeekAgo = new UTCDateTime((new \DateTime('-7 days'))->getTimestamp() * 1000);
        
        $pipeline = [
            ['$match' => ['reservation_date' => ['$gte' => $oneWeekAgo]]],
            ['$group' => [
                '_id' => '$movie_title',
                'reservation_count' => ['$sum' => 1]
            ]],
            ['$sort' => ['reservation_count' => -1]]
        ];

        return $this->collection->aggregate($pipeline)->toArray();
    }
}