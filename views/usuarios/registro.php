
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4 p-0 mt-2" id="">
        <form action="<?=base_url?>/usuario/registrar" class="form-signin " method="POST" onsubmit="return validarContraseña()" enctype="multipart/form-data">
            <h2 class="form-signin-heading text-center">Crear cuenta</h2>
            <div class=" form-group">
                <label class=" label-image-user">
                    <img for="image" src="<?=base_url?>/assets/img/static/subirImagen.png" id="image-field" class="image-field rounded" accept="image/*">
                    <input type="file"  id="image-user" name="image" onchange="previewImage(event)" required/>   
                </label> 
            </div>
            <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
                <div class="alert alert-danger" role="alert">
                <?php 
                    if(isset($_SESSION['alert'])){ 
                        echo $_SESSION['alert'];
                    };
                ?>
                </div>
            <?php endif;?>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Correo" required>
            </div>
            
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                <div class="invalid"></div>
            </div>
            

            <div class="form-group">
                <label for="tipoUsuario">Tipo de usuario</label>
                <select class="form-control" id="tipoUsuario" name="typeUser">
                    <option value="0">Alumno</option>
                    <option value="1">Profesor</option>
                </select>
            </div>
    
            <button type="submit" class="btn btn-lg btn-primary btn-block">Registrarse</button>

        </form>
    </div>
</div>

<?php Utils::deleteSession('register');?>