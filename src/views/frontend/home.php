<?php 
//require_once __DIR__ . '/../../../config.php'; 
?>
<?php $title = "Accueil - Cinéphoria"; ?>

<?php ob_start(); ?>

    <header id="header-home">
      <div class="container">
        <div class="row text-hero d-flex align-items-center">
          <div class="col-lg-6 col-md-8 mx-auto text-center">
            <h1>Cinéphoria, le cinéma responsable</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. A voluptate sit, illum facere tempore dicta facilis assumenda quod, non voluptatum corporis repellendus eaque. Accusamus voluptatem consectetur doloribus dolorem magni voluptatum.</p>
          </div>
        </div>
      </div>
    </header>

    <section id="section-home-card" class="bloc-section">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                <?php 
                $counter = 0; 

                foreach ($movies as $movie): 
                    if ($counter >= 8) break; 
                ?>
                <div class="col">
                    <div class="card">
                    <img src="<?= BASE_URL ?>/public/<?= htmlspecialchars($movie['poster']) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                    </div>
                    <div class="btn-session">
                        <a href="<?= BASE_URL ?>/index.php?action=seances&movie_id=<?= htmlspecialchars($movie['id']) ?>" type="button" class="btn prim">Séances</a>
                    </div>
                    </div>
                </div>

                <?php 
                $counter++; 
                endforeach; 
                ?>
        
      </div> 
    </section>

<?php $content = ob_get_clean(); ?>

<?php require_once __DIR__ . '/../layout.php';?>