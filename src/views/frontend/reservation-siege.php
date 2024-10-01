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
                <button type="button" class="btn primary mt-4" id="reserveBtn">Réserver ma place</button>
            </div>
        </div>
    </div>
</section>

<section id="log" class="section-transition">
    <div class="container">
        <div class="row mt-4 btn-row">
            <div class="col text-end"><button id="loginBtn" class="btn group active">Je m'identifie</button></div>
            <div class="col"><button id="createAccountBtn" class="btn group">Je crée un compte</button></div>
        </div>
        <div class="row row-cols-1 form-row mt-5 mb-5">
            <div class="col text-center" id="loginForm">
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="E-mail*">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe*">
                    </div>
                    <button type="submit" class="btn mt-3">Je me connecte</button>
                </form>
            </div>
            <div class="col" id="createAccountForm">
                <form class="text-center">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Prénom" aria-label="First name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nom" aria-label="Last name">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nom d'utilisateur" aria-label="User name">
                        </div>
                        <div class="col-md-6">
                        <input type="email" class="form-control" id="InputEmail2" aria-describedby="emailHelp" placeholder="E-mail*">
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe*">
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmer votre mot de passe*">
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3">Je me connecte</button>
                </form>
            </div>
        </div>
    </div>

</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout-funnel.php';?>