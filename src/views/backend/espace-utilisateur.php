<?php $title = "Cinéphoria - Espace utilisateur"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="order-container">
    <div class="admin-title">
        <h2>Bienvenue sur votre espace personnel</h2>
    </div>

    <?php
        if (isset($_SESSION['messageNote'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['messageNote'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['messageNote']); 
        }
    ?>  

    <section id="order_list" class="mt-5 table-list">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>La liste de toutes mes commandes</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Films</th>
                                <th scope="col" style="width:10%;">Dates de diffusion</th>
                                <th scope="col" style="width:10%;">Séances</th>
                                <th scope="col" style="width:10%;">Prix</th>
                                <th scope="col" style="width:10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) : ?>
                                <?php foreach ($orders as $order): ?>
                                    <?php 
                                        // Conversion des dates et heures
                                        $endDateTime = strtotime($order['screening_day'] . ' ' . $order['end_time']);
                                        $currentDateTime = time();
                                        $isPastScreening = $currentDateTime > $endDateTime;
                                    ?>
                                    <tr class="room-row">
                                        <td><?= htmlspecialchars($order['movie_title']); ?></td>
                                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($order['screening_day']))); ?></td>
                                        <td><?= htmlspecialchars(date('H\hi', strtotime($order['start_time'])) . '-' . date('H\hi', strtotime($order['end_time']))); ?></td>
                                        <td><?= htmlspecialchars($order['price']) . '€ pour ' . count(explode(', ', $order['seats'])) . ' place(s)'; ?></td>
                                        <td>
                                            <?php if ($isPastScreening): ?>
                                                <button class="btn note" data-bs-toggle="modal" data-bs-target="#modalReview" data-movie-id="<?= $order['movie_id']; ?>">Noter ce film</button>
                                            <?php else: ?>
                                                <button class="btn note unclick" title="Noter ce film après votre séance">Noter ce film</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">Aucune commande trouvée</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal pour ajouter un avis -->
    <div class="modal fade" id="modalReview" tabindex="-1" aria-labelledby="modalLabelReview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabelReview">Que pensez-vous de ce film ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php?action=AddReview">
                    <input type="hidden" name="movie_id" id="review-movie-id">
                        <div class="mb-3">
                            <select class="form-select" name="rating" aria-label="Select rating" required>
                                <option value="">Choisir la note</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="text-review" class="col-form-label">Commentaire :</label>
                            <textarea id="text-review" name="text_review" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Affichage web-App -->
<section id="web-app" data-base-url="<?= BASE_URL ?>">
        <div class="container d-sm-none">
            <div class="admin-title">
                <h2>Mes séances</h2>
            </div>
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 d-flex align-items-stretch d-block d-sm-none">

            <?php foreach ($orders as $order): ?>
                <a href="#" data-id="<?= $order['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalQr" class="show-qr">
                <div class="col movie-card">
                    <div class="card h-100 d-flex flex-column position-relative">
                        <div class="img-dateTime-room position-relative">
                            <img src="<?= BASE_URL ?>/public/<?= htmlspecialchars($order['movie_poster']); ?>" class="card-img-top" alt="...">
                            <span class="position-absolute bottom-0 start-0 badge rounded-pill  mt-1 me-1 p-2 fs-6 age-min"> 
                                <?= htmlspecialchars(date('d/m', strtotime($order['screening_day']))); ?>
                            </span>
                            <span class="position-absolute bottom-0 end-0 badge rounded-pill  mt-1 me-1 p-2 fs-6 age-min">
                                <?= htmlspecialchars(date('H\hi', strtotime($order['start_time'])) . '-' . date('H\hi', strtotime($order['end_time']))); ?>
                                Salle <?= htmlspecialchars($order['room_number']); ?>
                            </span>
                        </div>
                        <h6 class="card-title"><?= htmlspecialchars($order['movie_title']); ?></h6>
                    </div>
                </div>
                </a> 

            <?php endforeach; ?>
            </div>
            <div class="user-logout mt-3 mb-3">
                <a class="btn" href="<?= BASE_URL ?>/index.php?action=logout">Se déconncter</a>
            </div>
        </div>
        
        <!-- Modal pour réinitialiser le mot de passe -->
        <div class="modal fade" id="modalQr" tabindex="-1" aria-labelledby="modalLabelQr" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabelQr">Mon billet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="qrCodeImage" src="" alt="QR Code">
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    document.querySelectorAll('.show-qr').forEach((element) => {
        element.addEventListener('click', (event) => {
            event.preventDefault();
            const reservationId = event.currentTarget.getAttribute('data-id');

            fetch(`index.php?action=getQrCode&reservationId=${reservationId}`)
                .then((response) => response.json())
                .then((data) => {
                    const qrCodeImage = document.getElementById('qrCodeImage');
                    qrCodeImage.src = `<?= BASE_URL ?>/public/${data.qrCode}`;
                })
                .catch((error) => {
                    console.error('Erreur lors du chargement du QR code:', error);
                });
        });
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>