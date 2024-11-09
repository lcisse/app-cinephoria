<?php 
//session_start();
$userRole = $_SESSION['role'] ?? null;
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary" id="navbarTop">
        <div class="container-fluid justify-content-between" id="container-nav"> 
          <a class="navbar-brand" href="<?= BASE_URL ?>/index.php?action=home"><img src="<?= BASE_URL ?>/public/assets/images/logo.png" alt="Logo de Cinéphoria" class="mb-2"></a> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> <!-- Changement de me-auto à ms-auto pour aligner à droite -->
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>/index.php?action=films">FILM</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  RESERVATION
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=nantes">Nantes</a></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=bordeaux">Bordeaux</a></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=paris">Paris</a></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=toulouse">Toulouse</a></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=lille">Lille</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=charleroi">Charleroi</a></li>
                  <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=reservation&cinema=liege">Liège</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
              </li>
              <?php if ($userRole == null) :?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>/index.php?action=myAccount">MON COMPTE</a>
                </li>
              <?php endif; ?>

              <?php if ($userRole !== null) :?> 
                <li class="nav-item dropdown profile">
                  <a class="nav-link dropdown-toggle" title="Mon compte" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/></svg>
                  </a>
                  <ul class="dropdown-menu">
                    <?php if ($userRole == 'administrator') :?> 
                      <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=espace-admin">Administration</a></li>
                    <?php endif; ?>
                    <?php if ($userRole == 'employee') :?>
                      <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=admin-film">Intranet</a></li>
                    <?php endif; ?>   
                    <?php if ($userRole == 'user') :?>
                      <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=espace-utilisateur">Mon espace</a></li>
                    <?php endif; ?>   
                      <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?action=logout">Se déconncter</a></li>
                  </ul>
                </li>
              <?php endif; ?>

            </ul>
          </div>
        </div>
      </nav>