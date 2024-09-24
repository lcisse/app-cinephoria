<?php $title = "Cinéphoria - Réservation"; ?>
<?php ob_start(); ?>

<section id="film-list-by-cinema" class="bloc-section">
<div class="container">
        <h1><span><?= htmlspecialchars($cinemaName) ?> : </span>Tous les films</h1>
    </div>
<div class="container">
<?php if (!empty($movies)): ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 d-flex align-items-stretch">

    <?php foreach ($movies as $movie): ?>
        <?php $movie['screening_days'] = $this->convertDayToFrench($movie['screening_days']);?>
                <div class="col movie-card" data-cinema="<?= htmlspecialchars($movie['cinema']) ?>" data-genre="<?= htmlspecialchars($movie['genre']) ?>" data-day="<?= isset($movie['screening_days']) ? htmlspecialchars($movie['screening_days']) : '' ?>">
            <div class="card h-100 d-flex flex-column position-relative">
                <img src="<?= htmlspecialchars($movie['poster']) ?>" class="card-img-top" alt="...">
                <div class="card-body flex-grow-1 position-relative">
                    <h3 class="card-title"><?= htmlspecialchars($movie['title']) ?> </h3>
                    <p class="card-text"><?= htmlspecialchars($movie['description']) ?></p> 
                    <?= $movie['age_minimum'] !== 0 ? '<span class="position-absolute top-0 end-0 badge rounded-pill bg-dark mt-1 me-1 p-2 fs-6 age-min">-' . htmlspecialchars($movie['age_minimum']) . '</span>' : '' ?>
                </div>
                <ul class="list-group list-group-flush flex-grow-5">
                    <li class="list-group-item">
                        Notes : 
                        <span class="star-rating">
                            <?php if (isset($ratings[$movie['id']])): ?>
                                <?php 
                                $rating = $ratings[$movie['id']]; // La note moyenne
                                $fullStars = floor($rating);  // Nombre d'étoiles pleines (arrondi à l'entier inférieur)
                                $hasHalfStar = ($rating - $fullStars) >= 0.5; // Vérifier s'il y a une demi-étoile
                                $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0)); // Calculer les étoiles vides
                                ?>

                                <!-- Afficher les étoiles pleines -->
                                <?php for ($i = 1; $i <= $fullStars; $i++): ?>
                                    <i class="fas fa-star text-warning"></i> <!-- Étoile pleine -->
                                <?php endfor; ?>

                                <!-- Afficher la demi-étoile si nécessaire -->
                                <?php if ($hasHalfStar): ?>
                                    <i class="fas fa-star-half-alt text-warning"></i> <!-- Demi-étoile -->
                                <?php endif; ?>

                                <!-- Afficher les étoiles vides -->
                                <?php for ($i = 1; $i <= $emptyStars; $i++): ?>
                                    <i class="far fa-star text-warning"></i> <!-- Étoile vide -->
                                <?php endfor; ?>

                            <?php else: ?>
                                Pas de note pour ce film
                            <?php endif; ?>
                        </span>
                    </li>
                </ul>
                <div class="card-body mt-auto flex-grow-0">
                <button type="button" class="btn primary">
                <a href="<?= BASE_URL ?>/index.php?action=seances&movie_id=<?= htmlspecialchars($movie['id']) ?>" class="btn btn-primary">Séances</a>

                </button>
                </div>
                <?= $movie['favorite'] !== 0 ? '<span class="position-absolute top-0 end-0 badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 cine-heart">Coup de coeur ❤️</span>' : '' ?>
            </div>
        </div>

    <?php endforeach; ?>
    </div>
    <?php else: ?>
        <p class="text-center no-movie-available mt-5 mb-5">Pas de film disponible pour ce cinéma.</p>
    <?php endif; ?>
</div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout.php';?>