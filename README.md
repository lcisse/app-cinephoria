# app-cinephoria

ECF (évaluation en cours de formation) Studi - CDA (concepteur développeur d'application)

# Cinéphoria - Guide de déploiement en local

# Description

Cinéphoria est une application de gestion de cinéma qui combine une base de données relationnelle (MySQL) pour la gestion des films, séances, salles, utilisateurs, etc., et une base de données non relationnelle (MongoDB) pour visualiser le nombre de réservations par film sur une période de 7 jours via un Dashboard.

# Processus d'Installation et Configuration

L’environnement de développement est basé sur Docker afin d’assurer une portabilité et une uniformité sur différents environnements.

# Installation des outils

Avant de lancer le projet, il est nécessaire d’installer certains outils :

    1. Installer Docker Desktop
    2. Installer Git
    3. Installer Visual Studio Code

# Cloner ou télécharger le projet :

    . git clone https://github.com/lcisse/app-cinephoria.git

# Lancer les conteneurs Docker

Le projet utilise un fichier docker-compose.yml pour lancer tous les services nécessaires :
. docker-compose up -d --build

Ce que fait cette commande :

    . web : Démarre l’application PHP avec Apache
    . db : Lance MySQL avec la base de données lc_cinephoria
    . mongodb : Lance le service MongoDB
    . phpmyadmin : Fournit une interface graphique pour MySQL

# Vérification des services

Vérifier que les conteneurs sont bien démarrés : docker ps

    . cinephoria_web → Serveur Apache/PHP
    . cinephoria_db → Base de données MySQL
    . cinephoria_mongodb → Base de données NoSQL
    . cinephoria_phpmyadmin → Interface pour MySQL

# Accéder à l'application

    . Interface principale : http://localhost:8080
    . Accès à phpMyAdmin : http://localhost:8081
    . Accès MongoDB Compass : Connexion à mongodb://localhost:27017

# Gestion de la Base de Données

Importation automatique via Docker
Lors du premier démarrage, Docker importe automatiquement la base lc_cinephoria.sql

# Tests et Vérifications

Le projet utilise PHPUnit pour les tests unitaires et fonctionnels :

    . Lancer les tests : vendor/bin/phpunit tests/
    . Exécuter un test spécifique : vendor/bin/phpunit tests/functional/LoginTest.php

# Page d'accueil (films récents)

Par défaut, seuls les films publiés depuis le mercredi dernier sont affichés.

# Ajout de données

    1. Ajout de films :
        . Connectez-vous en tant qu'administrateur ou employé.
        . Ajoutez des films depuis l'espace d'administration pour qu'ils apparaissent sur la page d'accueil.
    2. Ajout de séances :
        . Ajoutez des séances pour lier des films à des salles et cinémas.
