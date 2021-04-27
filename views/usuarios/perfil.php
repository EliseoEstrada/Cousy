<main class="">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 bg-white rounded mb-3 mb-md-0">
            <div class=" text-center m-4">
                <?php 
                //OBTENER DATOS DE USUARIO LOGUEADO 
                $usuario = $_SESSION['identity'];
                ?>
                <img src="data:<?=$usuario->Extension?>;base64,<?php echo base64_encode($usuario->Imagen);?>" alt="user-image" class="rounded-circle user-image-profile">
                <p class="font-weight-bold"><?=$usuario->Nombre?></p>
            </div>
            <div class="list-group pb-3" id="myList" role="tablist">
                <!--MENU DE OPCIONES DE USUARIO-->
                <a class="list-group-item list-group-item-action active" data-toggle="list" href="#MyPerfil" role="tab">Mi perfil</a>
                <a class="list-group-item list-group-item-action" data-toggle="list" href="#Photography" role="tab">Fotografia</a>
                <a class="list-group-item list-group-item-action" href="chat.html" >Mensajes</a>
                <?php 
                //Ocultar menu de Profesor para usuario estudiante
                if($usuario->Rol == 0){
                ?>
                <a class="list-group-item list-group-item-action "  href="myCourses.html">Mis cursos</a>
                <?php 
                }else{
                ?>
                <a class="list-group-item list-group-item-action "  data-toggle="list" href="#publishedLessons" role="tab" >Mis lecciones</a>
                <a class="list-group-item list-group-item-action"  data-toggle="list" href="#erasers" role="tab" >Borradores</a>
                <?php } ?>
                <a class="list-group-item list-group-item-action"  href="<?=base_url?>usuario/logout" >Cerrar sesion</a>
            </div>
        </div>

        <!--VENTANAS DE CADA OPCION DEL MENU-->
        <div class="col-12 col-md-8 col-lg-9 pr-0 pl-0  pl-md-1 mb-3 mb-md-0">
            <div class="tab-content bg-white rounded  p-3 p-md-5">
                <div class="tab-pane active" id="MyPerfil" role="tabpanel">
                    <form action="<?=base_url?>usuario/actualizarDatos" method="POST" onsubmit="return validarContraseña()" class="m-auto p-0 pr-md-5 pl-md-5" >
                        <h4 class="text-center">Actualizar datos </h4>
                        <h6 class=" mb-2 text-muted">Ultimo cambio realizado el: <?=$usuario->UltimaActualizacion?></h6>
                        <div class="form-group">
                            <label for="mame">Nombre completo</label>
                            <input type="text" class="form-control" name="name" id="name" required value="<?=$usuario->Nombre?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="username" class="form-control"  name="username"id="username" required value="<?=$usuario->Usuario?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control"  name="email"id="email" required value="<?=$usuario->Correo?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" required value="<?=$usuario->Contraseña?>">
                            <div class="invalid"></div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="Photography" role="tabpanel">
                    <form action="<?=base_url?>usuario/actualizarImagen" method="POST" enctype="multipart/form-data">
                        <h4 class="text-center">Actualizar imagen de perfil</h4>
                        <div class="text-center mb-4 mt-4">
                            <img src="data:<?=$usuario->Extension?>;base64,<?php echo base64_encode($usuario->Imagen);?>" alt="" id="image-field" class="rounded-circle new-user-image-profile">
                        </div>
                        <div class="custom-file">
                            <input type="file"  class="custom-file-input " name="newImage" lang="es" onchange="previewImage(event)" accept="image/*" required />  
                            <label class="custom-file-label" for="newImage">Seleccionar Archivo</label>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
                        </div>
                        
                    </form>
                </div>

                <div class="tab-pane" id="publishedLessons" role="tabpanel">
                    <h4 class="text-center mb-3">Reseumen de cursos publicados </h4>
                    <h6 class="card-subtitle ">Total de alumnos inscritos</h6>
                    <p class="card-text mb-2">24 alumnos</p>
                    <h6 class="card-subtitle ">Total de ingresos obtenidos</h6>
                    <p class="card-text mb-2">2300.00 MXN$</p>
                    <div class="text-right mb-3">
                        <a href="addCourse.html" class="btn btn-primary text-white" role="button" >Agregar nuevo curso</a>
                    </div>
                    <div class="card mb-2" >
                        <div class="card-header">
                            <a href="detailsLesson.html">
                                <h5 class="card-title">Modelado en 3D con Blender</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted">Categoria</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                    
                                    <h6 class="card-subtitle text-muted">Precio</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                </div>
                                <div class="col">
                                    <h6 class="card-subtitle text-muted">Monto recaudado</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                    <h6 class="card-subtitle text-muted">Alumnos inscritos</h6>
                                    <p class="card-text mb-2">12</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="addChapter.html" class="btn btn-secondary text-white" role="button" >Suspender</a>
                                <a href="" class="btn btn-danger text-white" role="button" >Eliminar</a>
                            </div> 
                        </div>
                        
                    </div>
                    <div class="card mb-2" >
                        <div class="card-header">
                            <a href="detailsLesson.html">
                                <h5 class="card-title">Modelado en 3D con Blender</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted">Categoria</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                    
                                    <h6 class="card-subtitle text-muted">Precio</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                </div>
                                <div class="col">
                                    <h6 class="card-subtitle text-muted">Monto recaudado</h6>
                                    <p class="card-text mb-2">1300.00 MXN$</p>
                                    <h6 class="card-subtitle text-muted">Alumnos inscritos</h6>
                                    <p class="card-text mb-2">12</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="addChapter.html" class="btn btn-secondary text-white" role="button" >Suspender</a>
                                <a href="" class="btn btn-danger text-white" role="button" >Eliminar</a>
                            </div> 
                        </div>
                        
                    </div>
                </div>
                <!--BORRADORES-->
                <div class="tab-pane" id="erasers" role="tabpanel">
                    <h4 class="text-center mb-3">Borradores</h4>
                    <div class="text-right mb-3">
                        <a href="addCourse.html" class="btn btn-primary text-white" role="button" >Agregar nuevo curso</a>
                    </div>
                    
                    <div class="card mb-3" >
                        <div class="card-header">
                            <h5 class="card-title">Modelado en 3D con Blender</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle text-muted">Categoria</h6>
                            <p class="card-text ">Modelado 3D</p>
                            <h6 class="card-subtitle text-muted">Descripcion</h6>
                            <p class="card-text text-truncate">Descripcion: Some quick example text to build on the card title and make up the bulk of the card's content. sdsdsdsd sdsdsdsds sdsdsdsds sdsdsdsds sdsdsdsds sdsdsdsd</p>
                            <h6 class="card-subtitle text-muted">Precio</h6>
                            <p class="card-text ">1300.00 MXN$</p>
                            <div class="text-right">
                                <a href="addChapter.html" class="btn btn-primary text-white" role="button" >Editar</a>
                                <a href="" class="btn btn-danger text-white" role="button" >Eliminar</a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card mb-3" >
                        <div class="card-header">
                            <h5 class="card-title">Modelado en 3D con Blender</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle text-muted">Categoria</h6>
                            <p class="card-text ">Modelado 3D</p>
                            <h6 class="card-subtitle text-muted">Descripcion</h6>
                            <p class="card-text text-truncate">Descripcion: Some quick example text to build on the card title and make up the bulk of the card's content. sdsdsdsd sdsdsdsds sdsdsdsds sdsdsdsds sdsdsdsds sdsdsdsd</p>
                            <h6 class="card-subtitle text-muted">Precio</h6>
                            <p class="card-text ">1300.00 MXN$</p>
                            <div class="text-right">
                                <a href="addChapter.html" class="btn btn-primary text-white" role="button" >Editar</a>
                                <a href="" class="btn btn-danger text-white" role="button" >Eliminar</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>