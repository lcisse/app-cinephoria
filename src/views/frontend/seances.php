<?php $title = "Cinéphoria - Tous les films"; ?>
<?php ob_start(); ?>

<section id="screenings-section">
    <div class="container">
        <h1>Séances disponibles</h1>
    </div>

    <div class="btn-group d-flex flex-wrap" id="day-buttons">
        <!-- Les boutons sont générés dynamiquement par JavaScript -->
         <div class="container" id="day-buttons-container"></div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-4">

            <div class="col">
                <div class="card mb-3 movie-title-desc">
                    <div class="row g-0">
                        <div class="col-md-4" style="height: 350px;">
                        <img src="<?= htmlspecialchars($moviePoster) ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= htmlspecialchars($movieTitle) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($movieDescription) ?></p>
                            <!--<p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>-->
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteneur des séances (rempli via AJAX) -->
            <div class="col screenings">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4" id="screenings-container">
                    <!-- Les séances injectées via JavaScript -->
                </div>
            </div>          
      </div>

    </div>
    <div id="screenings-data" data-movie-id="<?= $movieId ?>" data-today="<?= date('Y-m-d') ?>"></div> <!--div disabled-->
</section>

<section id="quality-price">
    <div class="container">
        <h2>Prix et qualités</h2>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-6 row-cols-lg-6 g-4 text-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">2D : 10€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">3D : 12€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">IMAX : 13€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">4DX : 15€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">MX4D : 17€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">D-BOX : 18€</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout.php';?>