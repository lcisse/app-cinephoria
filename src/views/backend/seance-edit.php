<?php $title = "Cinéphoria - Modifier une séance"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="seances-container">
    <div class=" admin-title">
        <h2>Gestion des séances</h2>
    </div>

    <?php if (isset($_SESSION['messageScreenings'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['messageScreenings']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['messageScreenings']); ?>
    <?php endif; ?> 

    <section id="edit-screening" class="mt-3">
        <div class="">
            <div class="row">
                <div class="col">
                <h4>Modifier la séancre</h4>
                    <div class="" id="formScreening-Edit">
                        <div class="card card-body">
                            <form method="POST" action="index.php?action=updateScreening&screening_id=<?= $screeningDetails['id'] ?>&filmId-seance=<?= $_GET['filmId-seance'] ?>" class="text-start" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="cinema">Cinéma</label>
                                        <select id="cinema" class="form-select" name="cinema_id" aria-label="Select cinema" data-cinemas='<?= htmlspecialchars(json_encode($cinemaRooms), ENT_QUOTES, 'UTF-8'); ?>' required>
                                            <option value="">Sélectionnez un cinéma</option>
                                            <?php foreach ($cinemas as $cinemaId => $cinema): ?>
                                                <option value="<?= $cinemaId; ?>" <?= $cinemaId == $screeningDetails['cinema_id'] ? 'selected' : ''; ?>>
                                                    <?= $cinema['cinema_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                   
                                    <div class="col-md-6">
                                        <label for="room-number">Salle</label>
                                        <select id="room-number" class="form-select" name="room_id" data-selected-room="<?= $screeningDetails['room_id']; ?>" required>
                                            <option value="">Sélectionnez une salle</option>
                                            <?php if (isset($cinemaRooms[$screeningDetails['room_id']])): ?>
                                                <?php foreach ($cinemaRooms[$screeningDetails['room_id']] as $room): ?>
                                                    <option value="<?= $room['id']; ?>" <?= $room['id'] == $screeningDetails['room_id'] ? 'selected' : ''; ?>>
                                                        Salle <?= $room['number']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <!-- Gestion du cas où la salle n'est pas trouvée -->
                                                <option value="" disabled>Aucune salle disponible pour ce cinéma</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>           
                                    <div class="col-md-6">
                                        <label for="screening-date" class="form-label">Date de projection</label>
                                        <input type="date" name="screening_date" id="screening-date" class="form-control" value="<?= $screeningDetails['screening_day']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="start-time" class="form-label">Heure de début</label>
                                        <input type="time" id="start-time" name="start_time" class="form-control" value="<?= $screeningDetails['start_time']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end-time" class="form-label">Heure de fin</label>
                                        <input type="time" id="end-time" name="end_time" class="form-control" value="<?= $screeningDetails['end_time']; ?>" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn mt-3">Mettre à jour</button>
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