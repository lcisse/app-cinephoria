<?php $title = "Cinéphoria - Tous les films"; ?>
<?php ob_start(); ?>

<section id="screenings-section">
    <div class="container">
        <h1>Séances disponibles</h1>

    </div>
    <div class="btn-group d-flex flex-wrap">
        <a href="#" class="btn  active" aria-current="page">Aujourd'hui</a>
        <a href="#" class="btn btn-primary">DEMAIN</a>
        <a href="#" class="btn btn-primary">SAM. 21 SEPT</a>
        <a href="#" class="btn btn-primary">DIM. 22 SEPT</a>
        <a href="#" class="btn btn-primary">LUN. 23 SEPT</a>
        <a href="#" class="btn btn-primary">MAR. 24 SEPT</a>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-4">

            <div class="col">
                <div class="card mb-3" >
                    <div class="row g-0">
                        <div class="col-md-4" style="height: 350px;">
                        <img src="<?= __DIR__ ?>/public/assets/images/cover1.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col screenings">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">

                    <?php foreach ($screenings as $screening): ?>
                        <div class="col">
                            <div class="card position-relative">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= htmlspecialchars($screening['start_time']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">(fin <?= htmlspecialchars($screening['end_time']) ?>)</h6>
                                    <p class="card-text">Salle <?= htmlspecialchars($screening['room_number']) ?></p>
                                </div>
                                <span class="position-absolute top-0 start-0 badge rounded-0 mt-1 me-1 ps-2 p-1 fs-6 b-quality"><?= htmlspecialchars($screening['projection_quality']) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>


                    <!--<div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                <p class="card-text">Some quick example</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                <p class="card-text">Some quick example</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                <p class="card-text">Some quick example</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                <p class="card-text">Some quick example</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                                <p class="card-text">Some quick example</p>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
      </div>

    </div>
</section>

<section id="quality-price">
    <div class="container">
        <h2>Prix et qualités</h2>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-6 row-cols-lg-6 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require_once __DIR__ . '/../layout.php';?>