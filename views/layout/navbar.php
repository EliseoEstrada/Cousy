<?php $categorias = Utils::showCategorias(); 
ob_start();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <!--MENU EN PANTALLA PEQUEÑA-->
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Titulo-->
    <a class="navbar-brand d-none d-block d-md-none" href="principal.html">
        <img class="logo-nav" src="img/static/logo.png" alt="logo" >
    </a>
    <!--Icono de buscar-->
    <div class="input-group-append d-none d-block d-md-none">
        <button class="btn btn-outline-secondary " type="button" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></button>
    </div>
    <!--MENU EN PANTALLA GRANDE-->
    <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">
        <div class="w-100 d-md-flex justify-content-between d-none d-md-block">
            <!--Titulo-->
            <a class="navbar-brand" href="<?=base_url?>">
                <img class="logo-nav" src="<?=base_url?>/assets/img/static/Logo.png" alt="logo">
            </a>
            <!--Form de buscar-->
            <form method="GET" action="principal.html" class="form-inline" >
                <div class="input-group ">
                    <input type="text" class="form-control border-dark" placeholder="¿Que estas buscando?">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <?php if(isset($_SESSION['identity'])): ?>
            <!--Menu de usuario en pantalla grande-->
            <ul class=" mt-2 m-md-0 p-0 pr-2 " >
                <li class="nav-item dropdown navbar-brand ">
                    <a class="nav-link dropdown-toggle p-0 text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php 
                        $tipo_imagen = $_SESSION['identity']->Extension;
                        $imagen = $_SESSION['identity']->Imagen;
                    ?>
                      <img src="data:<?=$tipo_imagen?>;base64,<?php echo base64_encode($imagen);?>" width="40" height="40" class="rounded-circle mr-2">
                      <b ><?=$_SESSION['identity']->Usuario?></b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="<?=base_url?>usuario/perfil"">Perfil</a>
                      <a class="dropdown-item" href="myCourses.html">Mis cursos</a>
                      <?php if($_SESSION['identity']->Rol == 1) {?>
                      <a class="dropdown-item" href="<?=base_url?>curso/gestion">Agregar curso</a>
                      <?php }?>
                      <a class="dropdown-item" href="chat.html">Mensajes</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?=base_url?>usuario/logout">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
            <?php else: ?>
            <!--Menu de registrase-->
            <div class="my-auto ">
                <a class="btn  btn-outline-primary text-white my-auto " href="<?=base_url?>usuario/iniciarSesion"  >Iniciar sesión</a>
                <!--<a class="btn  btn-outline-primary text-white my-auto " role="button" data-toggle="modal" data-target="#loginModal"  >Iniciar sesión</a>-->
                <!--<a class="btn btn-outline-secondary text-white my-auto " role="button" data-toggle="modal" data-target="#siginModal"  >Registrarse</a>-->
                <a class="btn btn-outline-secondary text-white my-auto " href="<?=base_url?>usuario/registro" >Registrarse</a>
            </div>
            <?php endif; ?>
            
        </div>
        <!--MENU DE CATEGORIAS-->
        <div class="w-100 ">
            <!--Menu de usuario en pantalla pequeña-->
            <div class="d-none d-md-none" >
                <a class="nav-link pt-3 pr-0 pb-0 pl-1 text-white" >
                    <img src="<?=base_url?>img/users/Ornn.jpg" width="30" height="30" class="rounded-circle mr-2">
                  <b >Eliseo</b> 
                </a>
                <ul class="navbar-nav d-flex justify-content-around small mb-2 mb-md-0 ml-5 mr-3 mt-0 m-md-0" >
                    <li class="nav-item">
                        <a class="nav-link py-1" href="<?=base_url?>usuario/perfil">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1" href="myCourses.html">Mis cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1" href="<?=base_url?>curso/gestion">Agregar curso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1" href="chat.html">Mensajes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1" href="index.html">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
            <!--Menu de registrase-->
            <div class="d-block d-md-none mt-3">
                <a class="btn btn-outline-primary w-100 text-white"  role="button"  data-toggle="modal" data-target="#loginModal"  >Iniciar sesión</a>
                
                <a class="btn  btn-outline-secondary w-100 text-white mt-3" href="index.html" role="button">Registrarse</a>
            </div>
            
            <!--Categorias-->
            <span class=" d-block d-md-none mt-3 ml-3 text-white"><b>Categorias</b></span>
            <ol class="navbar-nav d-flex justify-content-around small mb-2 mb-md-0 ml-5 mr-3 mt-0 m-md-0">

            <?php foreach ($categorias as &$categoria) { ?>
                <li class="nav-item ">
                    <a class="nav-link py-1 " href="principal.html"><?=$categoria->getCategoria()?></a>
                </li>
            <?php } ?>
            </ol>
        </div>
    </div>

    <!-- Modal de boton buscar -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Buscar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="principal.html" class="form-inline " >
                        <div class="input-group w-100 ">
                            <input type="text" class="form-control border-dark" placeholder="¿Que estas buscando?">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="">Bienvenido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url?>usuario/login" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Usuario o Correo</label>
                            <input type="text" class="form-control" placeholder="" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control"  placeholder="" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
</nav>
