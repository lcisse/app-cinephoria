USE lc_cinephoria;

-- Début de la transaction
START TRANSACTION;

-- Étape 1 : Insérer la réservation
INSERT INTO reservations (user_id, movie_id, screening_id, seats, price, status, qr_code, scanned)
VALUES 
    (:user_id, :movie_id, :screening_id, :seats, :price, 'confirmed', :qr_code, 0);

-- Étape 2 : Mettre à jour les sièges réservés
UPDATE seats
SET reserved = 1
WHERE seat_number IN (:seat_1, :seat_2, :seat_3) -- Remplacez par les numéros réels de sièges
  AND screening_id = :screening_id;

-- Si tout est OK, valider la transaction
COMMIT;

-- En cas de problème, annuler les modifications
-- ROLLBACK; -- Cette commande doit être utilisée dans un gestionnaire d'erreurs en SQL interactif
