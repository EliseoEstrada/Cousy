
<div class="row justify-content-center ">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4 p-0 mt-5 " id="logIn">
        <form action="<?=base_url?>usuario/login" method="POST" class="form-signin">

            <h2 class="form-signin-heading text-center">Bienvenido</h2>
            <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
                <div class="alert alert-danger" role="alert">
                Datos incorrectos
                </div>
            <?php endif;?>
            <?php Utils::deleteSession('register');?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Correo" required>
            </div>
            
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Iniciar sesión</button>
        </form>
    </div>
</div>