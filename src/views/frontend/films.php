<?php $title = "Cinéphoria - Tous les films"; ?>
<?php ob_start(); ?>

<section id="cine-filter">
<div class="container">

<p class="d-inline-flex gap-1 mt-5">
  <button id="toggleButton" class="btn toggleButton" type="button" data-bs-toggle="collapse" data-bs-target="#filterSection" aria-expanded="false" aria-controls="filterSection">
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
  <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
</svg>Filtrer 
    <span class="toggle-icon">
        <i class="fa-solid fa-chevron-down"></i>
    </span> 
  </button>
</p>
<div class="collapse" id="filterSection">
    <div class="card card-body mt-3">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        
    <div class="col cinemas-genres-jours">
        <h5>Cinémas</h5>
        <div>
            <input type="checkbox" id="nantes" class="cinema-checkbox" value="nantes">
            <label for="nantes">Nantes</label><br>
            <input type="checkbox" id="bordeaux" class="cinema-checkbox" value="bordeaux">
            <label for="bordeaux">Bordeaux</label><br>
            <input type="checkbox" id="paris" class="cinema-checkbox" value="paris">
            <label for="paris">Paris</label><br>
            <input type="checkbox" id="toulpuse" class="cinema-checkbox" value="toulouse">
            <label for="toulouse">Toulouse</label><br>
            <input type="checkbox" id="lille" class="cinema-checkbox" value="lille">
            <label for="lille">Lille</label><br>
            <input type="checkbox" id="charleroi" class="cinema-checkbox" value="charleroi">
            <label for="charleroi">Charleroi</label><br>
            <input type="checkbox" id="liege" class="cinema-checkbox" value="liege">
            <label for="liege">Liège</label><br>

        </div>
        </div>
    
        <div class="col cinemas-genres-jours">
        <h5>Genres</h5>
        <div>
            <input type="checkbox" id="comedie" class="genre-checkbox" value="comédie">
            <label for="comedie">Comédie</label><br>
            <input type="checkbox" id="drame" class="genre-checkbox" value="drame">
            <label for="drame">Drame</label><br>
            <input type="checkbox" id="comedie-dramatique" class="genre-checkbox" value="comédie-dramatique">
            <label for="comedie-dramatique">Comédie dramatique</label><br>
            <input type="checkbox" id="thriller" class="genre-checkbox" value="thriller">
            <label for="thriller">Thriller</label><br>
            <input type="checkbox" id="action" class="genre-checkbox" value="action">
            <label for="action">Action</label><br>
            <input type="checkbox" id="horreur" class="genre-checkbox" value="horreur">
            <label for="horreur">Horreur</label><br>
            <input type="checkbox" id="science-fiction" class="genre-checkbox" value="science-fiction">
            <label for="science-fiction">Science-fiction</label><br>
        </div>
        </div>

        <div class="col cinemas-genres-jours">
        <h5>Jours</h5>
        <div>
            <input type="checkbox" id="lundi" class="day-checkbox" value="lundi">
            <label for="lundi">Lundi</label><br>
            <input type="checkbox" id="mardi" class="day-checkbox" value="mardi">
            <label for="mardi">Mardi</label><br>
            <input type="checkbox" id="mercredi" class="day-checkbox" value="mercredi">
            <label for="mercredi">Mercredi</label><br>
            <input type="checkbox" id="jeudi" class="day-checkbox" value="jeudi">
            <label for="jeudi">Jeudi</label><br>
            <input type="checkbox" id="vendredi" class="day-checkbox" value="vendredi">
            <label for="vendredi">Vendredi</label><br>
            <input type="checkbox" id="samedi" class="day-checkbox" value="samedi">
            <label for="samedi">Samedi</label><br>
            <input type="checkbox" id="Dimanche" class="day-checkbox" value="dimanche">
            <label for="Dimanche">Dimanche</label><br>
        </div>
        </div>

        </div>
        </div>
    </div>
</div>
</div>
</section>

<section id="all-films-list" class="bloc-section">
<div class="container">
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
                    <a type="button" class="btn prim" href="<?= BASE_URL ?>/index.php?action=seances&movie_id=<?= htmlspecialchars($movie['id']) ?>" class="btn btn-prim">Séances</a>
                </div>
                <?= $movie['favorite'] !== 0 ? '<span class="position-absolute top-0 end-0 badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 cine-heart">Coup de coeur ❤️</span>' : '' ?>
            </div>
        </div>

    <?php endforeach; ?>
    </div>
</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout.php';?>