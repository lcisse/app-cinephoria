# app-cinephoria
ECF (évaluation en cours de formation) Studi - CDA (concepteur développeur d'application)

# Cinéphoria - Guide de déploiement en local

# Description
Cinéphoria est une application de gestion de cinéma qui combine une base de données relationnelle (MySQL) pour la gestion des films, séances, salles, utilisateurs, etc., et une base de données non relationnelle (MongoDB) pour visualiser le nombre de réservations par film sur une période de 7 jours via un Dashboard.

Ce guide vous aide à déployer l'application localement en utilisant WAMP pour MySQL et MongoDB Compass pour MongoDB.

# Prérequis
WAMP Server :
PHP version ≥ 7.4
MySQL version ≥ 5.7
MongoDB :
Version ≥ 4.4
Navigateur Web :
Un navigateur récent comme Google Chrome, Firefox ou Edge.
Git (optionnel) :
Pour cloner le projet depuis un dépôt Git.

# Étape 1 : Configuration du projet
1. Cloner ou télécharger le projet : git clone https://github.com/lcisse/app-cinephoria.git 
cd cinephoria

2. Placer le projet dans le répertoire de WAMP :
    . Copiez le dossier du projet dans le répertoire www de WAMP :
   C:\wamp64\www\cinephoria
3. Démarrer WAMP :
   . Lancez WAMP Server et assurez-vous que Apache et MySQL sont actifs

# Étape 2 : Importation des bases de données

1. Base de données relationnelle (MySQL)
   . Ouvrir phpMyAdmin :
      . Rendez-vous sur http://localhost/phpmyadmin.
   . Créer la base de données :
      . Créez une nouvelle base nommée lc_cinephoria.
   . Importer les données :
      . Allez dans l'onglet Importer de phpMyAdmin, sélectionnez le fichier SQL suivant : /db/lc_cinephoria.sql
      . Cliquez sur Exécuter pour importer les données.
   
2. Base de données non relationnelle (MongoDB)
    . Démarrer MongoDB :
        . Lancez MongoDB Compass ou assurez-vous que le service MongoDB est actif.
    . Importer la base de données :
        . Utilisez l'outil mongorestore ou MongoDB Compass pour importer la base cinephoriadb : mongorestore --db cinephoriadb /db/cinephoriadb
     . (Adaptez le chemin selon votre système et emplacement du dossier db).
   
Étape 3 : Configurer l'application
    1. Fichier de configuration :
        . Vérifiez les fichiers Manager.php et MongoDBConnection.php, et assurez-vous que les paramètres de connexion à MySQL et MongoDB sont corrects :

        private function __construct() 
        {
            try {
                $this->bdd = new PDO('mysql:host=localhost;dbname=lc_cinephoria;charset=utf8', 'root', '');
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        . Assurez-vous que $dbName = "cinephoriadb" dans MongoDBConnection.php et dans ReservationMongoManager.php

    2. Accéder au site :
        . Ouvrez un navigateur et rendez-vous sur : http://localhost/cinephoria

# Page d'accueil (films récents)
Par défaut, seuls les films publiés depuis le mercredi dernier sont affichés.

# Ajout de données
    1. Ajout de films :
        . Connectez-vous en tant qu'administrateur ou employé.
        . Ajoutez des films depuis l'espace d'administration pour qu'ils apparaissent sur la page d'accueil.
    2. Ajout de séances :
        . Ajoutez des séances pour lier des films à des salles et cinémas.



