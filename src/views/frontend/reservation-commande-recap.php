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
            <h1>Récapitulatif de ma commande</h1>
        </div>
        <div class="row mt-5 pt-5 order-infos">
            <div class="col-md-6 pe-5 text-end recap-img-container">
                <div class="recap-img text-end">
                    <img src="<?= BASE_URL ?>/public/<?= $screeningDetails['poster']; ?>" class="img-fluid rounded-start" alt="Poster du film">
                </div>
            </div>
            <div class="col-md-6 ps-5 mt-2">
                <h2><?= $movieTitle; ?></h2>
                <p><?= $cinema; ?></p>
                <p><?= $formattedDate; ?></p>
                <p><span class="h-start"><?= $startTime; ?></span> <small>(fin <span class="h-end"><?= $endTime; ?></span>)</small></p>
            </div>
            <div class="col-md-12 places mt-4 mb-3 pt-3">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h3>Mes places</h3>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <p><span><?= count(explode(',', $selectedSeats)); ?></span> places</p>
                        </div>
                        <div class="col text-center">
                            <p><?= number_format($totalPrice, 2); ?> €</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <h2>Total à régler : <span><?= number_format($totalPrice, 2); ?> €</span></h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center mt-5 mb-5">
                <form action="index.php?action=confirmReservation" method="POST">
                    <input type="hidden" name="screeningId" value="<?= $screeningId; ?>">
                    <input type="hidden" name="seats" value="<?= $selectedSeats; ?>">
                    <input type="hidden" name="totalPrice" value="<?= $totalPrice; ?>">
                    <button type="submit" class="btn">Valider ma commande</button>
                </form>
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