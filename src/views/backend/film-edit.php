<?php $title = "Cinéphoria - Modifier une salle"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="films-container">
    <div class=" admin-title">
        <h2>Gestion des salles</h2>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?> 

    <section id="edit-film" class="mt-3">
        <div class="">
            <div class="row">
                <div class="col">
                <h4>Modifier le film</h4>
                    <div class="" id="formFilm-Edit">
                        <div class="card card-body">
                        <form method="POST" action="index.php?action=updateFilm" enctype="multipart/form-data">
                            <input type="hidden" name="film_id" value="<?= $film['id']; ?>">
                            
                            <!-- Titre du film -->
                            <div class="mb-3">
                                <label for="movie_title">Titre du film</label>
                                <input type="text" id="movie_title" name="movie_title" class="form-control" value="<?= htmlspecialchars($film['title']); ?>" required>
                            </div>
                            
                            <!-- Description du film -->
                            <div class="mb-3">
                                <label for="movie_description">Description du film</label>
                                <textarea id="movie_description" name="movie_description" class="form-control" rows="3"><?= htmlspecialchars($film['description']); ?></textarea>
                            </div>

                            <!-- Âge minimum -->
                            <div class="mb-3">
                                <label for="age_minimum">Âge minimum</label>
                                <input type="number" id="age_minimum" name="age_minimum" class="form-control" value="<?= $film['age_minimum']; ?>">
                            </div>
                            
                            <!-- Favori -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="favorite" name="favorite" class="form-check-input" <?= $film['favorite'] ? 'checked' : ''; ?>>
                                <label for="favorite">Favori</label>
                            </div>

                            <!-- Genres -->
                            <div class="mb-3">
                                <label for="genres">Genres</label>
                                <select class="form-select" name="genres[]" aria-label="Select genres" multiple required>
                                    <?php foreach ($genres as $genre): ?>
                                        <option value="<?= $genre['id']; ?>" <?= in_array($genre['id'], $filmGenres) ? 'selected' : ''; ?>>
                                            <?= $genre['genre_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-text text-muted">Vous pouvez sélectionner plusieurs genres en maintenant la touche Ctrl.</small>
                            </div>

                            <div class="mb-3">
                                <label for="publication-date">Date de publication</label>
                                <input type="date" id="publication-date" name="publication_date" class="form-control" value="<?= $film['publication_date']; ?>" required>
                            </div>

                            <!-- Affiche du film -->
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Affiche du film</label>
                                <input class="form-control" type="file" id="formFile" name="poster">
                                <?php if (!empty($film['poster'])): ?>
                                    <img src="<?= BASE_URL ?>/public/<?= htmlspecialchars($film['poster']); ?>" alt="Affiche actuelle" class="img-thumbnail mt-2" width="200">
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn ">Mettre à jour</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>