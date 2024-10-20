<?php $title = "Cinéphoria - Gestion des séances"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="screenings-container">
    <div class="admin-title">
        <h2>Gestion des séances</h2>
        <p class="d-inline-flex">
            <button id="toggleScreenindBtn" class="btn toggleButton toggleAdminBtn" type="button" data-bs-toggle="collapse" data-bs-target="#formScreeninglCollapse" aria-expanded="false" aria-controls="formScreeninglCollapse">Ajouter un film
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
                    <div class="collapse multi-collapse" id="formScreeninglCollapse">
                        <div class="card card-body">
                            <form method="POST" action="index.php?action=createScreening&filmId-seance=<?= $filmId ?>" class="text-start" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="cinema">Cinéma</label>
                                        <select id="cinema" class="form-select" name="cinema_id" aria-label="Select cinema" data-cinemas='<?= htmlspecialchars(json_encode($cinemaRooms), ENT_QUOTES, 'UTF-8'); ?>' required>
                                            <option value="">Sélectionnez un cinéma</option>
                                            <?php foreach ($cinemas as $cinemaId => $cinema): ?>
                                                <option value="<?= $cinemaId; ?>"><?= $cinema['cinema_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <label for="room-number">Salle</label>
                                        <select id="room-number" class="form-select" name="room_id" required>
                                            <option value="">Sélectionnez d'abord un cinéma</option>
                                        </select>
                                    </div>           
                                    <div class="col-md-6">
                                        <label for="screening-date" class="form-label">Date de projection</label>
                                        <input type="date" name="screening_date" id="screening-date" class="form-control"aria-label="Screening date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="start-time" class="form-label">Heure de début</label>
                                        <input type="time" id="start-time" name="start_time" class="form-control" aria-label="Start time">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end-time" class="form-label">Heure de fin</label>
                                        <input type="time" id="end-time" name="end_time" class="form-control" aria-label="End time">
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



</div>
<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>