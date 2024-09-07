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

    <section id="section-home-card">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover1.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover2.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover3.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover4.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover5.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover6.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover7.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="../../../public/assets/images/cover8.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
              </div>
              <div class="btn-session">
                <button type="button" class="btn primary">Séance</button>
              </div>
            </div>
          </div>
      </div> 
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('../layout.php') ?>