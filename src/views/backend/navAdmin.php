<?php 
$userRole = $_SESSION['role'] ?? null;
?>

<ul class="nav flex-column" id="navAdmin">
    <?php if ($userRole === 'administrator'): ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= BASE_URL ?>/index.php?action=espace-admin">Tableau de bord</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=admin-film">Gestion films</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=salles">Gestion salles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=admin-employes">Employés</a>
        </li>
    <?php endif; ?>

    <?php if ($userRole === 'employee'): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=admin-film">Gestion films</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=salles">Gestion salles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=avis">Avis utilisateurs</a>
        </li>
    <?php endif; ?>

    <?php if ($userRole === 'user'): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=espace-utilisateur">Mes commandes</a>
        </li>
    <?php endif; ?>
</ul>