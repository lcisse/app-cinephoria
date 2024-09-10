<?php $title = "Cinéphoria - Tous les films"; ?>
<?php ob_start(); ?>

<section id="cine-filter">
<div class="container">

<p class="d-inline-flex gap-1 mt-5">
  <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#filterSection" aria-expanded="false" aria-controls="filterSection">
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
  <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
</svg>Filtrer
  </button>
</p>
<div class="collapse" id="filterSection">
    <div class="card card-body mt-3">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        
    <div class="col cinemas-genres-jours">
        <h5>Cinémas</h5>
        <div>
            <input type="checkbox" id="nantes" name="nantes" value="nantes">
            <label for="nantes">Nantes</label><br>
            <input type="checkbox" id="bordeaux" name="bordeaux" value="bordeaux">
            <label for="bordeaux">Bordeaux</label><br>
            <input type="checkbox" id="paris" name="paris" value="paris">
            <label for="paris">Paris</label><br>
            <input type="checkbox" id="toulpuse" name="toulouse" value="toulouse">
            <label for="toulouse">Toulouse</label><br>
            <input type="checkbox" id="lille" name="lille" value="lille">
            <label for="lille">Lille</label><br>
            <input type="checkbox" id="charleroi" name="charleroi" value="charleroi">
            <label for="charleroi">Charleroi</label><br>
            <input type="checkbox" id="liege" name="liege" value="liege">
            <label for="liege">Liège</label><br>

        </div>
        </div>
    
        <div class="col cinemas-genres-jours">
        <h5>Genres</h5>
        <div>
            <input type="checkbox" id="comedie" name="comedie" value="comedie">
            <label for="comedie">Comédie</label><br>
            <input type="checkbox" id="drame" name="drame" value="drame">
            <label for="drame">Drame</label><br>
            <input type="checkbox" id="comedie-dramatique" name="comedie-dramatique" value="comedie-dramatique">
            <label for="comedie-dramatique">Comédie dramatique</label><br>
            <input type="checkbox" id="thriller" name="thriller" value="thriller">
            <label for="thriller">Thriller</label><br>
            <input type="checkbox" id="action" name="action" value="action">
            <label for="action">Action</label><br>
            <input type="checkbox" id="horreur" name="horreur" value="horreur">
            <label for="horreur">Horreur</label><br>
            <input type="checkbox" id="science-fiction" name="science-fiction" value="science-fiction">
            <label for="science-fiction">Science-fiction</label><br>
        </div>
        </div>

        <div class="col cinemas-genres-jours">
        <h5>Jours</h5>
        <div>
            <input type="checkbox" id="lundi" name="lundi" value="lundi">
            <label for="lundi">Lundi</label><br>
            <input type="checkbox" id="mardi" name="mardi" value="mardi">
            <label for="mardi">Mardi</label><br>
            <input type="checkbox" id="mercredi" name="mercredi" value="mercredi">
            <label for="mercredi">Mercredi</label><br>
            <input type="checkbox" id="jeudi" name="jeudi" value="jeudi">
            <label for="jeudi">Jeudi</label><br>
            <input type="checkbox" id="vendredi" name="vendredi" value="vendredi">
            <label for="vendredi">Vendredi</label><br>
            <input type="checkbox" id="samedi" name="samedi" value="samedi">
            <label for="samedi">Samedi</label><br>
            <input type="checkbox" id="Dimanche" name="Dimanche" value="Dimanche">
            <label for="Dimanche">Dimanche</label><br>
        </div>
        </div>

        </div>
        </div>
        <!--<div class="text-center mt-4">
            <button type="reset" class="btn">Réinitialiser</button>
            <button type="submit" class="btn">Valider</button>
        </div>-->
    </div>
</div>
</div>
</section>

<section id="all-films-list" class="bloc-section">
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 d-flex align-items-center">


    <?php foreach ($movies as $movie): ?>
                <div class="col">
            <div class="card">
                <img src="<?= htmlspecialchars($movie['poster']) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($movie['description']) ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?= htmlspecialchars($movie['age_minimum']) ?></li>
                    <li class="list-group-item"><?= htmlspecialchars($movie['favorite']) ?></li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>




        <div class="col">
            <div class="card">
                <img src="https://fr.web.img3.acsta.net/img/cf/d2/cfd22f75f5cc0c1c1becf4f2be075958.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="https://www.hachette.fr/sites/default/files/images/livres/couv/9782016265468-001-T.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="https://img.over-blog-kiwi.com/0/49/61/14/20141006/ob_679964_affiche-labyrinthe.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
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