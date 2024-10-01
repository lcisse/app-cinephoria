<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinéphoria - Récapitulatif commande</title>
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
                <span class="position-absolute badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 b-back">
                    <a class="" href="javascript:void(0);" onclick="history.back();"><img src="<?= BASE_URL ?>/public/assets/images/retour.png" alt="icon retour" class="mb-2"></a>
                </span>
            </div>
        </div>
    </header>

    <section id="section-recap">
        <div class="container">
            <div class="row text-center title1">
                <h1>Récapitulatif de ma commade</h1>
            </div>
            <div class="row">
                <div class="col-md-6" style="height: 350px;">
                    <img src="https://m.media-amazon.com/images/M/MV5BMzNiMGViZGQtNTliNS00MjE5LWE5N2EtZDQwMmQwOTVkYjA3XkEyXkFqcGc@._V1_.jpg" class="img-fluid rounded-start" alt="..." width="70%">
                </div>
                <div class="col-md-6">
                    <h2>Titre du film</h2>
                    <p>Paris</p>
                    <p>Lundi 30 septembre</p>
                    <p>20:10 (fin 22:22)</p>
                </div>
                <div class="col"></div>
                <div class="col"></div>
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