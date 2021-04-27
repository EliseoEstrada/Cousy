<?php
//Definiendo la clase modelo para usuario, lo que tiene que ver con acciones de 
// usuario en la base de datos se relaciona aquí en el modelo

//Incluir Clase de base de datos
require_once 'config/db.php';

class Usuario{
    private $id;
    private $name;
    private $username;
    private $email;
    private $password;
    private $typeUser;
    
    private $idImage;
    private $image;
    private $nameImage;
    private $typeImage;

    
    // Constructor
    
    public function __construct() {
        //$this->db = Database::connect();

    }

    public function constructor($pName, $pUsername, $pEmail, $pPassword, $pTypeUser, $image, $nameImage, $typeImage) {
        $this->name = $pName;
        $this->username = $pUsername;
        $this->email = $pEmail;
        $this->password = $pPassword;
        $this->typeUser = $pTypeUser;
        $this->image = $image;
        $this->nameImage = $nameImage;
        $this->typeImage = $typeImage;
    }
    

    //Métodos Getter and Setter
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }

    function getUsername() {
        return $this->username;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getTypeUser() {
        return $this->typeUser;
    }

    function getIdImage() {
        return $this->idImage;
    }

    function getImage() {
        return $this->image;
    }

    function getNameImage() {
        return $this->nameImage;
    }

    function getTypeImage() {
        return $this->typeImage;
    }

    function setId($id) {
        // se pasa función para comprobar texto en los inputs de inserción de productos
        $this->id = $id;
    }

    function setName($nombre) {
        $this->name = $nombre;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setTypeUser($typeUser) {
        $this->typeUser = $typeUser;
    }

    function setIdImage($idImage) {
        $this->idImage = $idImage;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setNameImage($nameImage) {
        $this->nameImage = $nameImage;
    }

    function setTypeImage($typeImage) {
        $this->typeImage = $typeImage;
    }
    
    // método para insertar usuarios
    public function registrarse(){
        $result = false;
        $conexion = new Database();

        $sql1 = "CALL SP_UsuarioRepetido(
            '{$this->getUsername()}');";

        $repetido = $conexion->Consulta($sql1);

        if($repetido && $repetido->num_rows == 0){

            $sql = "CALL SP_AgregarUsuario(
                '{$this->getImage()}',
                '{$this->getNameImage()}',
                '{$this->getTypeImage()}',
                '{$this->getName()}',
                '{$this->getUsername()}',
                '{$this->getEmail()}', 
                '{$this->getPassword()}', 
                {$this->getTypeUser()});";

            $succes = $conexion->Consulta($sql);
    
            if($succes){
                $result = true; 
            }else{
                $_SESSION['alert'] = 'Error de registro';
            }
        }else{
            $_SESSION['alert'] = 'Usuario repetido';
        }

        return $result;
    }

    //Método para iniciar sesion
    public function login() {
        $conexion = new Database();

        $result = false;
        $username = $this->username;
        $password = $this->password;

        //Query
        $sql = "CALL SP_IniciarSesion('$username','$password');";
        $resultado = $conexion->Consulta($sql);
        
        if($resultado && $resultado->num_rows > 0){
            //recoger el objeto de la base de datos
            $usuario = $resultado->fetch_object();
            $result = $usuario;
        }
        return $result;
    }

    // método para insertar usuarios
    public function actualizarDatos(){
        $conexion = new Database();
        $sql = "CALL SP_ActualizarUsuario(
            {$this->getId()},
            '{$this->getName()}',
            '{$this->getUsername()}',
            '{$this->getEmail()}', 
            '{$this->getPassword()}');";

        $succes = $conexion->Consulta($sql);
    
        $result = false;
        if($succes && $succes->num_rows > 0){
            $_SESSION['identity'] = $succes->fetch_object();
            $result = true; 
        }

        return $result;
    }

    // método para insertar usuarios
    public function actualizarImagen(){
        $conexion = new Database();
        $sql = "CALL SP_ActualizarImagenUsuario(
            {$this->getIdImage()},
            '{$this->getImage()}',
            '{$this->getNameImage()}',
            '{$this->getTypeImage()}');";

        $succes = $conexion->Consulta($sql);
        $result = false;
        if($succes && $succes->num_rows > 0){
            //Actualizar valores en la SESION
            $aux = $succes->fetch_object();
            $_SESSION['identity']->Imagen = $aux->Imagen;
            $_SESSION['identity']->NombreImagen = $aux->Nombre;
            $_SESSION['identity']->Extension = $aux->Extension;
            $result = true; 
        }

        return $result;
    }
}
