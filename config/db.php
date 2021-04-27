<?php
// Clase estática para conectar con la base de datos.
class Database{
    private $HOST = 'localhost';
    private $USER = 'root';
    private $PASSWORD = '';
    private $DATABASE = 'CousyDB';
    private $PORT = 3307;
    private $DB;

    public static function connect1(){
        $conexion = new mysqli('localhost', 'root', '', 'CousyDB', 3307);
        
        if($conexion->connect_errno){
            echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
            exit();
        }else{

            $conexion->query("SET NAMES 'utf8'");
        }
        return $conexion;


        //https://www.php.net/manual/es/mysqli-result.fetch-object.php
    }

    //Funcion para conectarse a la base de datos
    public function Connect(){
        $conexion = new mysqli($this->HOST, $this->USER, $this->PASSWORD, $this->DATABASE, $this->PORT);
        if($conexion->connect_errno){
            echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
            exit();
        }else{
            $conexion->query("SET NAMES 'utf8'");
        }
        $this->DB = $conexion;
    }

    //Funcion para desconectarse
    public function Disconnect(){
        mysqli_close($this->DB);
    }

    //Funcion para ejecutar query
    public function Consulta($sql){
        $this->Connect();
        $result = $this->DB->query($sql);
        $this->Disconnect();
        return $result;
    }

}