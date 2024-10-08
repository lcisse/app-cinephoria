<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinéphoria - Réservation confirmée</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Extra+Condensed:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
</head>
<body>
    <header class="heauder-funnel">
        <div class="container">
            <div class="row d-flex justify-content-center mt-4 mb-4 positon-relative">
                <a class="logo-funnel" href="<?= BASE_URL ?>/index.php?action=home"><img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="Logo de Cinéphoria" class="mb-2"></a>
            </div>
        </div>
    </header>

    <section id="section-confirm">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2>Votre réservation a bien été prise en compte</h2>
                    <a href="<?= BASE_URL ?>/index.php?action=home">Revenir sur le site</a>
                </div>
            </div>
        </div>
    </section>
    

    <script src="<?= BASE_URL ?>/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/filmsFilter"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/screenings"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/roomSeats"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/reservationForm"></script>
</body>
</html>