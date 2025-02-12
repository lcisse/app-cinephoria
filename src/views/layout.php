<?php 
//session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Extra+Condensed:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">

    <!-- PWA Manifest -->
    <link rel="manifest" href="<?= BASE_URL ?>/manifest.json">
    <link rel="apple-touch-icon" href="<?= BASE_URL ?>/public/assets/icons/icon-96x96.png">
    <meta name="apple-mobile-web-app-status-bar" content="white">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#0F3C44">

</head>
<body>
    <?php require('navbar.php') ?>

    <?= $content ?>
    
    <?php require('footer.php') ?>

    <script src="<?= BASE_URL ?>/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/filmsFilter.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/screenings.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/myAccount.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/roomSeats.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/appMobile.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/serviceWorker.js"></script>
</body>
</html>