<?php $title = "Cinéphoria - Réservation sièges"; ?>

<?php ob_start(); ?>

<section id="seats-section">
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h1>Sélectionner vos places</h1>
                <p><span id="seatCapacity"><?= $seat_capacity ?></span> places libres</p>
            </div>
        </div>

        <!-- Affichage du nombre de sièges réservés et des numéros 
        <div class="row">
            <div class="col text-center">
                <div id="reservedSeats">
                    <strong>Places réservées :</strong> <span id="reservedCount">0</span>
                </div>
                <div id="reservedSeatNumbers">
                    <strong>Numéro des places réservées :</strong> <span id="reservedSeatNumbersList">Aucun</span>
                </div>
            </div>
        </div>-->

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
        <div class="row mt-4">
            <div class="col text-center">
                <div id="seatCounter">
                    <strong>Sièges sélectionnés :</strong> <span id="selectedCount">0</span>
                </div>
                <div id="selectedSeats">
                    <strong>Numéros des sièges sélectionnés :</strong> <span id="selectedSeatNumbers">Aucun</span>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout-funnel.php';?>