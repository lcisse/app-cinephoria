<?php $title = "Cinéphoria - Contact"; ?>
<?php ob_start(); ?>

<section id="contactForm" class="">
    <div class="container">
        <div class="row mt-4">
            <div class="col text-center">
            <h1>Nous contacter</h1>
            </div>
        </div>
    
        <div class="row row-cols-1 form-row mt-5 mb-5">
            <div class="col" id="">
                <form method="POST" action="" class="text-center">
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" name="user_name" class="form-control" placeholder="Nom d'utilisateur (facultatif)" aria-label="User name">
                        </div>
                        <div class="col-12">
                            <input type="text" name="subject" class="form-control" placeholder="Objet" aria-label="Last name" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" id="" rows="3" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout.php';?>