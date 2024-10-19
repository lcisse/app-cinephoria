<?php $title = "Cinéphoria - Modifier une salle"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="rooms-container">
    <div class=" admin-title">
        <h2>Gestion des salles</h2>
    </div>
    
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $successMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <section id="edit-room" class="mt-3">
        <div class="">
            <div class="row">
                <div class="col">
                <h4>Modifier la salle</h4>
                    <div class="" id="formRoom-Edit">
                        <div class="card card-body">
                            <form method="POST" action="index.php?action=updateRoom" class="text-start">
                                <input type="hidden" name="room_id" value="<?= $room['id']; ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="cinema-name" class="form-label">Cinéma</label>
                                        <select class="form-select" id="cinema-name" name="cinema_id" aria-label="Select cinema" required>
                                            <?php foreach ($cinemas as $cinema): ?>
                                                <option value="<?= $cinema['id']; ?>" <?= $room['cinema_id'] == $cinema['id'] ? 'selected' : ''; ?>>
                                                    <?= $cinema['cinema_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="room-number" class="form-label">Numéro de la salle</label>
                                        <input type="number" name="room_number" id="room-number" class="form-control" value="<?= $room['room_number']; ?>" min="1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="seat-capacity" class="form-label">Nombre de places</label>
                                        <input type="number" name="seat_capacity" id="seat-capacity" class="form-control" value="<?= $room['seat_capacity']; ?>" min="1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="projection-quality" class="form-label">Qualité de projection</label>
                                        <input type="text" name="projection_quality" id="projection-quality" class="form-control" value="<?= $room['projection_quality']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="incident-notes" class="form-label">Incidents</label>
                                        <textarea class="form-control" id="incident-notes" name="incident_notes" rows="3"><?= $room['incident_notes']; ?></textarea>
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