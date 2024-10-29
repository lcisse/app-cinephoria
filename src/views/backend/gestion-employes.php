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

    <?php if (isset($_SESSION['messageEmploye'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['messageEmploye']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['messageEmploye']); ?>
    <?php endif; ?> 

    <?php if (isset($_SESSION['errorEm'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['errorEm']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['errorEm']); ?>
    <?php endif; ?>

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
                                <th scope="col">Prénom</th>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employes as $employe): ?>
                                <tr class="room-row">
                                    <td><?= htmlspecialchars($employe['last_name']); ?>
                                        <div class="action-buttons">
                                            <a href="#" data-id="<?= $employe['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalMdp" class="reset-password-link">réinitialiser le mot de passe |</a> 
                                            <a href="index.php?action=deleteEmployee&id=<?= $employe['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">Supprimer</a>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($employe['first_name']); ?></td>
                                    <td><?= htmlspecialchars($employe['username']); ?></td>
                                    <td><?= htmlspecialchars($employe['email']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal pour réinitialiser le mot de passe -->
    <div class="modal fade" id="modalMdp" tabindex="-1" aria-labelledby="modalLabelMdp" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabelMdp">Réinitialiser le mot de passe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--<form id="resetPasswordForm">
                        <input type="hidden" name="employee_id" id="employeeId">
                        <div class="mb-3">
                            <label for="newPassword" class="col-form-label">Nouveau mot de passe :</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                    </form>-->
                    <form method="POST" action="index.php?action=resetEmployeePassword">
                        <input type="hidden" name="employee_id" value="<?= $employe['id']; ?>">
                        <div class="mb-3">
                            <label for="new-password" class="col-form-label">Nouveau mot de passe :</label>
                            <input type="password" class="form-control" name="new_password" id="new-password" required>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn">Réinitialiser</button>
                        </div>
                    </form>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn" id="submitResetPassword">Réinitialiser</button>
                </div>-->
            </div>
        </div>
    </div>


</div>
<?php $content = ob_get_clean(); ?>
<?php require_once ('layout-admin.php');?>