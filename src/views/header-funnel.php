<header class="heauder-funnel">
    <div class="container">
        <div class="row d-flex justify-content-center mt-4 mb-4 positon-relative">
            <a class="logo-funnel" href="<?= BASE_URL ?>/index.php?action=home"><img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="Logo de Cinéphoria" class="mb-2"></a>
            <span class="position-absolute badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 b-back">
                <a class="" href="javascript:void(0);" onclick="history.back();"><img src="<?= BASE_URL ?>/public/assets/images/retour.png" alt="icon retour" class="mb-2"></a>
            </span>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 g-4 hero-funnel">
            <div class="col">
                <div class="card mb-3 text-center d-flex align-item-center">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 g-0">
                        <div class="col-md-3">
                            <img src="<?= $moviePoster ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-5 infos-screening">
                            <div class="card-body">
                                <h3 class="card-title"><?= $movieTitle ?></h3>
                                <p class="card-text"><?= $cinema ?></p>
                                <p class="card-text">Salle <?= $room_number ?></p>
                            </div>
                        </div>
                        <div class="col-md-4 infos-screening">
                            <div class="card-body">
                                <h5 class="card-title mb-2"><?= $screening_day ?></h5>
                                <h4 class="card-title"><?= $start_time ?></h4>
                                <h6 class="card-subtitle">(fin <?= $end_time ?>)</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
      </div>
</header>