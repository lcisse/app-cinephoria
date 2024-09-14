<?php
namespace App\Models;

use PDO;
use App\Models\BaseManager;

class ScreeningManager extends BaseManager
{
    public function createScreeningsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS screenings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            movie_id INT,
            room_id INT,
            start_time DATETIME,
            end_time DATETIME,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "screenings" créée avec succès.');
    }

    /*public function dropProjectionQualityColumn()
    {
        $sql = "ALTER TABLE screenings DROP COLUMN projection_quality";
        $this->executeQuery($sql, 'Colonne "projection_quality" supprimée avec succès de la table "screenings".');
    }*/

    public function getAllScreenings()
    {
        $sql = "SELECT * FROM screenings";
        return $this->fetchAll($sql);
    }
}
