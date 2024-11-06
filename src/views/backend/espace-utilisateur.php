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
                    <h2>La liste de tous mes commandes</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Films</th>
                                <th scope="col" style="width:10%;">Dates</th>
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
                                                <button title="Noter ce film après votre séance" class="btn note" data-bs-toggle="modal" data-bs-target="#modalReview" data-movie-id="<?= $order['movie_id']; ?>">Noter ce film</button>
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
<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>