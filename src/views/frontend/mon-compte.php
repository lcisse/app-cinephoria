<?php $title = "Cinéphoria - Mon compte"; ?>
<?php ob_start(); ?>

<section id="logs" class="section-transitions" data-base-url="<?= BASE_URL ?>">
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
            <form action="<?= BASE_URL ?>/index.php?action=myAccount" method="POST">
                <input type="hidden" name="action" value="login"> 
                <div class="mb-3">
                    <input type="email" id="emailLogin" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail*" required>
                </div>
                <div class="mb-3">
                    <input type="password" id="mdpLogin" class="form-control" name="password" placeholder="Mot de passe*" required>
                </div>
                <button type="submit" id="submitLogin"  class="btn mt-3">Je me connecte</button>
            </form>
            </div>
            <div class="col" id="createFormAccount">
                <form method="POST" action="<?= BASE_URL ?>/index.php?action=myAccount" class="text-center">
                    <input type="hidden" name="action" value="createAccount">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" placeholder="Prénom" aria-label="First name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" placeholder="Nom" aria-label="Last name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" aria-label="User name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" id="InputEmail2" placeholder="E-mail*" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Mot de passe*" required>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="confirm_password" class="form-control" id="InputPassword2" placeholder="Confirmer votre mot de passe*" required>
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3">Je m'inscris</button>
                </form>
            </div>
        </div>
    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout.php';?>