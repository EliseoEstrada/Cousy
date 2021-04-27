<?php
//Incluir el modelo
require_once 'models/usuario.php';

// definir clase controladora
class usuarioController{

    //////////////////////METODOS DE VISTAS//////////////////////
    //Vista de registro
    public function registro() {
        require_once 'views/usuarios/registro.php';
    }
    //Vista de inicio de sesion
    public function iniciarSesion() {
        require_once 'views/usuarios/login.php';
    }
    //Vista de inicio de sesion
    public function perfil() {
        require_once 'views/usuarios/perfil.php';
    }

    //////////////////////METODOS DE CONTROLADORES//////////////////////
    //Método de registro de usuarios
    public function registrar() {
        if(isset($_POST)){

            // Recibo los datos de la imagen
            $nombre_img = $_FILES['image']['name'];
            $tipo = $_FILES['image']['type'];
            $tamano = $_FILES['image']['size'];

            //Si existe imagen y tiene un tamaño correcto
            if (($nombre_img == !NULL) && ($tamano <= 200000))
            {
                //indicamos los formatos que permitimos subir a nuestro servidor
                if (($tipo == "image/jpeg") || ($tipo == "image/jpg")|| ($tipo == "image/png"))
                {

                    $name = isset($_POST['name']) ? $_POST['name'] : false;
                    $username = isset($_POST['username']) ? $_POST['username'] : false;
                    $email = isset($_POST['email']) ? $_POST['email'] : false; 
                    $password = isset($_POST['password']) ? $_POST['password'] : false; 
                    $typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : false; 
                    if($username && $email && $password){

                        $image = $_FILES['image']['tmp_name'];
                        $imgContenido = addslashes(file_get_contents($image));

                        $usuario = new Usuario();
                        $usuario->constructor($name, $username, $email, $password, $typeUser, $imgContenido, $nombre_img, $tipo);
                        $succes = $usuario->registrarse();

                        //header("Location:".base_url);
                        if($succes){
                            $this->login();
                            // Ruta donde se guardarán las imágenes que subamos
                            //$directorio = $_SERVER['DOCUMENT_ROOT'].'/intranet/uploads/';
                            // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
                            //move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
                        }else{
                            $_SESSION['register'] = "failed";
                            header("Location:".base_url."/usuario/registro");
                        }

                        /*if($save2){
                            $_SESSION['register'] = "complete";
                        }else{
                            $_SESSION['register'] = "failed";
                        } */
                    }else{
                        //$_SESSION['register'] = "failed";
                    }


                }
                else{
                    //si no cumple con el formato
                    echo "No se puede subir una imagen con ese formato ";
                }
            }
            else{
                //si existe la variable pero se pasa del tamaño permitido
                if($nombre_img == !NULL) echo "La imagen es demasiado grande ";
            }  
        }else{
            echo "ERRORR";
            //$_SESSION['register'] = "failed";
        }
       
    }
    
    //Método para Login de usuarios
    public function login() {
        // comprobar POST
        if (isset($_POST)) {
        // Identificar al usuario
            //Consulta a la base de datos mediante el modelo y su metodo login
            $usuario = new Usuario();
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);
            
            $identity = $usuario->login();
           
            //Crear una sesión para mantener al usuario identificado
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                header("Location:".base_url); 
            }else{
                $_SESSION['register'] = "failed";
                header("Location:".base_url."/usuario/iniciarSesion");
            }
        }
    }

    //Método para logout de usuarios
    public function logout() {
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        header("Location:".base_url);
    }    
   
    //Método de guardado de usuarios
    public function actualizarDatos() {
        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false; 
            $password = isset($_POST['password']) ? $_POST['password'] : false; 
            if($username && $email && $password){
                $usuario = new Usuario();
                $usuario->setId($_SESSION['identity']->IDUsuario);
                $usuario->setName($name);
                $usuario->setUsername($username);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                
                $succes = $usuario->actualizarDatos();

                //Si actualizo datos, volver a cargar pagina
                if($succes){
                    header("Location:".base_url.'/usuario/perfil');
                }else{
                    echo"ERROR AL ACTUALIZAR DATOS";
                }
            }
     
        }else{
            echo "ERRORR";
            //$_SESSION['register'] = "failed";
        }
    }

    //Método para actualizar imagen de perfil
    public function actualizarImagen() {
        if(isset($_POST)){
            // Recibo los datos de la imagen
            $nombre_img = $_FILES['newImage']['name'];
            $tipo = $_FILES['newImage']['type'];
            $tamano = $_FILES['newImage']['size'];

            //Si existe imagen y tiene un tamaño correcto
            if (($nombre_img == !NULL) && ($tamano <= 200000))
            {
                //indicamos los formatos que permitimos subir a nuestro servidor
                if (($tipo == "image/jpeg") || ($tipo == "image/jpg")|| ($tipo == "image/png"))
                {
                    $image = $_FILES['newImage']['tmp_name'];
                    $imgContenido = addslashes(file_get_contents($image));

                    $usuario = new Usuario();
                    $usuario->setIdImage($_SESSION['identity']->IDImagenFK);
                    $usuario->setImage($imgContenido);
                    $usuario->setNameImage($nombre_img);
                    $usuario->setTypeImage($tipo);

                    $succes = $usuario->actualizarImagen();

                    if($succes){
                        header("Location:".base_url.'/usuario/perfil');

                    }else{
                        echo"ERROR DE REGISTRO";
                    }
                }
                else{
                    //si no cumple con el formato
                    echo "No se puede subir una imagen con ese formato ";
                }
            }
            else{
                //si existe la variable pero se pasa del tamaño permitido
                if($nombre_img == !NULL) echo "La imagen es demasiado grande ";
            }
        }else{
            echo "ERRORR";
            //$_SESSION['register'] = "failed";
        }
       
    }
    
} // Fin de la clase

