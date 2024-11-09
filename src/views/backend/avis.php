<?php $title = "Cinéphoria - Gestion des avis"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="reviews-container">
    <div class="admin-title">
        <h2>Gestion des avis</h2>
    </div>

    <?php
        if (isset($_SESSION['messageReview'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['messageReview'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['messageReview']); 
        }
    ?>  

    <section id="reviews_list" class="mt-5 table-list">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>La liste de tous les avis</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="width:15%;">Auteur/autrice</th>
                                <th scope="col" >Avis</th>
                                <th scope="col" style="width:20%;">Films</th>
                                <th scope="col" style="width:5%;">Statuts</th>
                                <th scope="col" style="width:10%;">Dates</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reviews as $review): ?>
                            <tr class="room-row">
                                <td><?= htmlspecialchars($review['author_email']); ?>
                                    <div class="action-buttons">
                                        <?php if ($review['status'] === 'approved'): ?>
                                            <span class="disabled-link">Valider |</span>
                                        <?php else: ?>
                                            <a href="index.php?action=approveReview&id=<?= $review['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir valider cet avis ?');">Valider |</a>
                                        <?php endif; ?>
                                        <a href="index.php?action=deleteReview&id=<?= $review['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">Supprimer</a>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars_decode(htmlspecialchars($review['review_text'])) ?></td>
                                <td><?= htmlspecialchars_decode(htmlspecialchars($review['movie_title'])) ?></td>
                                <td>
                                    <?php if ($review['status'] === 'pending'): ?>
                                        <span class="pending">En attente</span>
                                    <?php elseif ($review['status'] === 'approved'): ?>
                                        <span class="approved">Validé</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y \à H\hi', strtotime($review['submission_date'])); ?></td>
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