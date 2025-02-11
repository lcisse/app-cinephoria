// mongodb-init.js

db = db.getSiblingDB('cinephoriadb'); // Sélectionner ou créer la base cinephoriadb
db.createCollection('reservations'); // Créer la collection reservations

print('✅ Base cinephoriadb et collection reservations créées avec succès');
