<main class="pt-2">
    <div class="row ">
      <div class="col-lg-9 offset-lg-3 text-center text-white pb-2">
        <h2 class="mb-0">Todos los cursos</h2>
        <small >Mas buscados</small>
      </div>
    </div>

    <div class="row">
        <!--MENU LATERAL-->
        <div class="col-lg-3">
            <div class="d-block d-lg-none">
            <div class="dropdown pb-2 ">
                <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ordenar elementos por
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Mas recientes</a>
                <a class="dropdown-item" href="#">Mas vendidos</a>
                <a class="dropdown-item" href="#">Mejor calificados</a>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <br>
            </div>
            

            <div class="dropdown bg-white rounded box-shadow pt-2 pb-3 d-none d-lg-block">
            <h4 class="dropdown-header text-center">Ordenar elementos por</h4>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Mas recientes</a>
            <a class="dropdown-item" href="#">Mas vendidos</a>
            <a class="dropdown-item" href="#">Mejor calificados</a>
            </div>
        </div>

        <div class="col 12 col-lg-9  pr-0 pl-0 pr-md-2 pl-md-2">

        <?php foreach ($cursos as &$course) { ?>
            <div class="card mb-2">
                <a href="detailsCourse.html" class="a-course">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-4 col-md-4">
                            <img src="img/blender.jpg" alt="" width="100%" height="200" class="rounded">
                        </div>
                        <div class="col-12 col-sm-8 col-md-8">
                            <div class="card-body pb-0">
                            
                                <h5 class="card-title"><?=$course->getNombre()?></h5>
                                <p><span><strong><?=$course->getPrecio()?> MXN$</strong></span></p>
                                <p class="card-text"> Impartido por: <em>Daniel Mallada Rodriguez</em></p>
                                <p class="card-text">
                                    <label class="orange-color">★</label>
                                    <label class="orange-color">★</label>
                                    <label class="orange-color">★</label>
                                    <label class="orange-color">★</label>
                                    <label class="orange-color">★</label>
                                    <label class="text-secondary">(10)</label>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</main>