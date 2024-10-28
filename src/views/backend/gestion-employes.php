<?php $title = "Cinéphoria - Gestion des employés"; ?>
<?php ob_start(); ?>
<div class="admin-right-container" id="employes-container">
    <div class="admin-title">
        <h2>Gestion des employés</h2>
        <p class="d-inline-flex">
            <button id="toggleEmployeBtn" class="btn toggleButton toggleAdminBtn" type="button" data-bs-toggle="collapse" data-bs-target="#formEmployeCollapse" aria-expanded="false" aria-controls="formEmployeCollapse">Ajouter un employé
                <span class="toggle-icon">
                    <i class="fa-solid fa-chevron-down"></i>
                </span> 
            </button>
        </p>
    </div>

    <section class="create-form">
        <div class="">
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="formEmployeCollapse">
                        <div class="card card-body">
                        <form method="POST" action="index.php?action=createEmployeeAccount" class="text-center">
                            <input type="hidden" name="action" value="createAccountEmployee">
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
                            <button type="submit" class="btn mt-3">Je crée un compte</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="employes_list" class="mt-5 table-list">
        <div class="">
            <div class="row">
                <div class="col">
                    <h2>Liste des employés</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mot de passe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employes as $employe): ?>
                                <tr class="room-row">
                                    <td><?= htmlspecialchars($employe['first_name']); ?> <?= htmlspecialchars($employe['last_name']); ?></td>
                                    <td><?= htmlspecialchars($employe['email']); ?></td>
                                    <td><button class="btn">réunitialiser le mot de passe</button></td>
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