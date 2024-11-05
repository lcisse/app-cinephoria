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
        $this->collection = $mongoDBConnection->getCollection('reservations'); 
    }

    public function addReservation($movieTitle, $userId, $seats, $price, $status) {
        $dateTime = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

        // Ajuste la date au format UTC pour MongoDB, en tenant compte de l'heure locale
        $utcTimestamp = ($dateTime->getTimestamp() + $dateTime->getOffset()) * 1000;
        $utcDateTime = new UTCDateTime($utcTimestamp);

        $document = [
            'movie_title' => $movieTitle,
            'reservation_date' => $utcDateTime,  
            'user_id' => $userId,
            'seats_reserved' => $seats,
            'total_price' => $price,
            'status' => $status
        ];
        $this->collection->insertOne($document);
    }
    
    public function getReservationsLast7Days() {
        $oneWeekAgo = new UTCDateTime((new \DateTime('-7 days'))->getTimestamp() * 1000);
        
        $pipeline = [
            ['$match' => ['reservation_date' => ['$gte' => $oneWeekAgo]]],
            [
                '$addFields' => [
                    'seats_reserved_array' => [
                        '$split' => ['$seats_reserved', ', ']  // Divise le champ seats_reserved en un tableau
                    ]
                ]
            ],
            [
                '$group' => [
                    '_id' => '$movie_title',
                    'reservation_count' => ['$sum' => 1],  // Compte le nombre de réservations
                    'total_seats_reserved' => ['$sum' => ['$size' => '$seats_reserved_array']]  // Somme du nombre de sièges réservés
                ]
            ],
            ['$sort' => ['reservation_count' => -1]]
        ];

        return $this->collection->aggregate($pipeline)->toArray();
    }
}