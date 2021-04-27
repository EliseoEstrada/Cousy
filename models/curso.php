<?php
//Definiendo la clase modelo para usuario, lo que tiene que ver con acciones de 
// usuario en la base de datos se relaciona aquí en el modelo

class Curso{
    //Definiendo propiedades del usuario = Campos de la base de datos
    private $id;
    private $nombre;
    private $precio;
    private $db;

    
    // Constructor
    
    public function __construct() {
        //$this->db = Database::connect();

    }

    public function constructor($id_, $nombre_, $precio_) {

        $this->id = $id_;
        $this->nombre = $nombre_;
        $this->precio = $precio_;
    }
    

    //Métodos Getter and Setter
    function getId() {
        return $this->id;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setNombre($nombre) {
        // se pasa función para comprobar texto en los inputs de inserción de productos
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setPrecio($precio) {
        //$this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll() {
        //Consulta a la base de datos
        //$this->db = Database::connect();
        $resultado;

        $cursos = new ArrayObject();
        if(!empty($resultado)){
            $objeto;
            while ($fila = mysqli_fetch_array($resultado)) {
                $objeto = new curso();
                $objeto->constructor($fila['IdCurso'], $fila['Nombre'], $fila['Precio']);
                $cursos->append($objeto);
            }
        }

        return $cursos;
    }
}
