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
                        <div class="col-md-4 col-sm-12" >
                        <img src="<?= BASE_URL ?>/public/<?= htmlspecialchars($moviePoster) ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="card-body pt-0">
                                <span class="star-rating">
                                    <?php if (isset($ratings)): ?>
                                        <?php 
                                        $fullStars = floor($ratings); 
                                        $hasHalfStar = ($ratings - $fullStars) >= 0.5; // Vérifier s'il y a une demi-étoile
                                        $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0)); // Calculer les étoiles vides
                                        ?>

                                        <!-- Afficher les étoiles pleines -->
                                        <?php for ($i = 1; $i <= $fullStars; $i++): ?>
                                            <i class="fas fa-star"></i> <!-- Étoile pleine -->
                                        <?php endfor; ?>

                                        <!-- Afficher la demi-étoile si nécessaire -->
                                        <?php if ($hasHalfStar): ?>
                                            <i class="fas fa-star-half-alt"></i> <!-- Demi-étoile -->
                                        <?php endif; ?>

                                        <!-- Afficher les étoiles vides -->
                                        <?php for ($i = 1; $i <= $emptyStars; $i++): ?>
                                            <i class="far fa-star"></i> <!-- Étoile vide -->
                                        <?php endfor; ?>

                                        <span class="reviewCount" data-bs-toggle="modal" data-bs-target="#modalReview"><?= $approveReviewCount ?> avis</span>
                                    <?php endif; ?>
                                </span>
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
    <div id="screenings-data" data-movie-id="<?= $movieId ?>" data-today="<?= date('Y-m-d') ?>" data-base-url="<?= BASE_URL ?>"></div> <!--div disabled-->

    <!-- Modal review-->
    <div class="modal fade" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalReviewLabel">Avis vérifié</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php if (!empty($approvedReviews)): ?>
                        <?php foreach ($approvedReviews as $review): ?>
                            <div class="card text-bg-light mb-3 mx-auto" style="max-width: 90%;">
                                <div class="card-header">
                                    <i class="fa-solid fa-circle-user"></i> <?= htmlspecialchars($review['username']) ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= htmlspecialchars($review['review_text']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun avis pour le moment.</p>
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
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
                        <h5 class="card-title">3D : 12,5€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">IMAX : 15€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">4DX : 18€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">MX4D : 20€</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">D-BOX : 22€</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout.php';?>