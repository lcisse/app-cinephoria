<?php $title = "Cinéphoria - Mon compte"; ?>
<?php ob_start(); ?>

<section id="logs" class="section-transitions">
    <div class="container">
        <div class="row mt-4">
            <div class="col text-center">
            <h1>Connexion</h1>
            </div>
        </div>
        <div class="row mt-4 btn-row">
            <div class="col text-end"><button id="loginBtn1" class="btn group active">Je m'identifie</button></div>
            <div class="col"><button id="createAccountBtn1" class="btn group">Je crée un compte</button></div>
        </div>
        <div class="row row-cols-1 form-row mt-5 mb-5">
            <div class="col text-center" id="loginFormAccount">
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="E-mail*">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe*">
                    </div>
                    <button type="submit" class="btn mt-3"><a class="" href="<?= BASE_URL ?>/index.php?action=recapCommande">Je me connecte</a></button>
                </form>
            </div>
            <div class="col" id="createFormAccount">
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
                    <button type="submit" class="btn mt-3"><a class="" href="<?= BASE_URL ?>/index.php?action=recapCommande">Je m'inscris</a></button>
                </form>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout.php';?>