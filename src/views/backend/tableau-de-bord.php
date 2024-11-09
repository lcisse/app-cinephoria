<?php $title = "Cinéphoria - Tableau de bord"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="dashboard-container">
    <div class="admin-title">
        <h2>Bienvenue sur votre tableaud de bord</h2>
    </div>

    <section id="dashboard_list" class="mt-5 table-list">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>Réservations - vue d'ensemble des 7 derniers jours</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="width:75%;">Films</th>
                                <th scope="col">Nombre de réservation</th>
                                <th scope="col">Nombre de sièges réservées</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr class="room-row">
                                    <td><?= htmlspecialchars($reservation['_id']); ?></td>
                                    <td><?= htmlspecialchars($reservation['reservation_count']); ?></td>
                                    <td><?= htmlspecialchars($reservation['total_seats_reserved']); ?></td>
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