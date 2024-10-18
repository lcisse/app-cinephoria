<?php $title = "Cinéphoria - Gestion des salles"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="rooms-container">
    <div class=" admin-title">
        <h2>Gestion des salles</h2>
        <p class="d-inline-flex">
                <button id="toggleRoomBtn" class="btn toggleButton toggleAdminBtn" type="button" data-bs-toggle="collapse" data-bs-target="#formRoomCollapse" aria-expanded="false" aria-controls="formRoomCollapse">Ajouter un film
                    <span class="toggle-icon">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span> 
                </button>
            </p>
    </div>
    <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['message'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['message']); 
        }
    ?>   

    <section class="create-form">
        <div class="">
            <div class="row">
                <div class="col">
                    <div class="collapse" id="formRoomCollapse">
                        <div class="card card-body">
                            <form method="POST" action="index.php?action=createRoom" class="text-center">
                                <!-- <input type="hidden" name="action" value="createRoom"> -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <select class="form-select" name="cinema_id" aria-label="Select cinema" required>
                                            <?php foreach ($cinemas as $cinema): ?>
                                                <option value="<?= $cinema['id']; ?>"><?= $cinema['cinema_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="room_number" class="form-control" placeholder="Numéro de la salle" aria-label="Room number" min="1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="seat_capacity" class="form-control" placeholder="Nombre de places" aria-label="Seat capacity" min="1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="projection_quality" class="form-control" placeholder="Qualité de projection" required>
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

    <section id="cinemas_list" class="mt-5">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>Liste des salles</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Cinéma</th>
                                <th scope="col">Salle</th>
                                <th scope="col">Nombre de places</th>
                                <th scope="col">Qualité de projection</th>
                                <th scope="col">Incidents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room): ?>
                                <tr class="room-row">
                                    <td><?= $room['cinema_name']; ?>
                                        <div class=" action-buttons" >
                                            <a href="index.php?action=salles&id=<?= $room['id']; ?>" class="">Modifier |</a> 
                                            <a href="index.php?action=deleteRoom&id=<?= $room['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?');">Supprimer</a>
                                        </div>
                                    </td>
                                    <td><?= $room['room_number']; ?></td>
                                    <td><?= $room['seat_capacity']; ?></td>
                                    <td><?= $room['projection_quality']; ?></td>
                                    <td><?= empty($room['incident_notes']) ? 'Aucun' : $room['incident_notes']; ?></td>
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