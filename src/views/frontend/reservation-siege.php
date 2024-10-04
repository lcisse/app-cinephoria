<?php $title = "Cinéphoria - Réservation sièges"; ?>
<?php $body_reserv = "body-seat"; ?>

<?php ob_start(); ?>

<section id="seats-section" class="section-transition active">
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h1>Sélectionner vos places</h1>
                <p><span id="seatCapacity"><?= $seat_capacity ?></span> places libres</p>
            </div>
        </div>

        <!-- Plan de salle généré par JavaScript -->
        <div class="row">
            <div class="col rooms-seats text-center" data-seat-capacity="<?= $seat_capacity ?>" data-screening-id="<?= $screening_id ?>">
                <div>
                    <h5>Ecran</h5>
                </div>

                <div id="seatPlanContainer" class="seat-plan">
                    <!-- Les sièges seront insérés ici par JavaScript -->
                </div>
            </div>
        </div>

        <!-- Sélection dynamique des sièges -->
        <div class="row mt-4 " id="counter-selected-btn">
            <div class="col text-center">
                <div id="seatCounter">
                    <p><strong>Sièges sélectionnés :</strong> <span id="selectedCount">0</span></p>
                </div>
                <div id="selectedSeats">
                    <p><strong>Numéros des sièges sélectionnés :</strong> <span id="selectedSeatNumbers">Aucun</span></p>               
                </div>
                <button type="button" class="btn prim mt-4" id="reserveBtn">Réserver ma place</button>
            </div>
        </div>
    </div>
</section>

<?php //if (!$usersController): ?>
<section id="log" class="section-transition">
    <div class="container">
        <div class="row mt-4 btn-row">
            <div class="col text-end"><button id="loginBtn" class="btn group active">Je m'identifie</button></div>
            <div class="col"><button id="createAccountBtn" class="btn group">Je crée un compte</button></div>
        </div>
        <div class="row row-cols-1 form-row mt-5 mb-5">
            <div class="col text-center" id="loginForm">
                <form action="<?= BASE_URL ?>/index.php?action=reservationLogin" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail*" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe*" required>
                        </div>
                        <button type="submit" class="btn mt-3">Je me connecte</button>
                </form>
            </div>
            <div class="col" id="createAccountForm">
                <form method="POST" action="<?= BASE_URL ?>/index.php?action=reservationCreateAccount" class="text-center">
                        <input type="hidden" name="action" value="createAccount">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control" placeholder="Prénom" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Nom" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="E-mail*" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe*" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer votre mot de passe*" required>
                            </div>
                        </div>
                        <button type="submit" class="btn mt-3">Je m'inscris</button>
                </form>
            </div>
        </div>
    </div>

</section>
<?php  //else: ?>
    <script>
        //window.location.href = "<?= BASE_URL ?>/index.php?action=recapCommande";
    </script>
<?php //endif; ?>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout-funnel.php';?>