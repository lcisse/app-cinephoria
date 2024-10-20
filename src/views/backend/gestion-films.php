<?php $title = "Cinéphoria - Gestion des films"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="movies-container">
    <div class="admin-title">
        <h2>Gestion des salles</h2>
        <p class="d-inline-flex">
            <button id="toggleMovieBtn" class="btn toggleButton toggleAdminBtn" type="button" data-bs-toggle="collapse" data-bs-target="#formFimlCollapse" aria-expanded="false" aria-controls="formFimlCollapse">Ajouter un film
                <span class="toggle-icon">
                    <i class="fa-solid fa-chevron-down"></i>
                </span> 
            </button>
        </p>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?> 

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <section class="create-form">
        <div class="">
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="formFimlCollapse">
                        <div class="card card-body">
                            <form method="POST" action="index.php?action=createMovie" class="text-start" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="">
                                        <input type="text" name="movie_title" class="form-control" placeholder="Titre du film" aria-label="Movie title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="movie-description" class="form-label">Description du film</label>
                                        <textarea class="form-control" id="movie-description" name="movie_description" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="age_minimum" class="form-control" placeholder="Âge minimum requis" aria-label="Age minimum" min="1">
                                    </div>
                                    <div class="col-md-6 form-check">
                                        <label class="form-check-label" for="favorite">Favori</label>
                                        <input class="form-check-input" type="checkbox" name="favorite" id="favorite" value="1">
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" name="genres[]" aria-label="Select genres" multiple required>
                                            <?php foreach ($genres as $genre): ?>
                                                <option value="<?= $genre['id']; ?>"><?= $genre['genre_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-muted">Vous pouvez sélectionner plusieurs genres en maintenant la touche Ctrl.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Affiche du film</label>
                                        <input class="form-control" type="file" id="formFile" name="poster" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn mt-3">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cinemas_list" class="mt-5 table-list">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>Liste des films</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Titres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($films as $film): ?>
                                <tr class="room-row">
                                    <td><?= htmlspecialchars($film['title']); ?>
                                        <div class=" action-buttons" >
                                            <a href="index.php?action=admin-film&filmId-seance=<?= $film['id']; ?>" class="">Séances |</a> 
                                            <a href="index.php?action=admin-film&id=<?= $film['id']; ?>" class="">Modifier |</a> 
                                            <a href="index.php?action=deleteFilm&id=<?= $film['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?');">Supprimer</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    

</div>
<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>
