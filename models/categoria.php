<?php

//Incluir Clase de base de datos
require_once 'config/db.php';

class Categoria{
    private $id;
    private $categoria;
 
    // Constructor
    public function __construct() {
        //$this->db = Database::connect();

    }

    public function constructor($id, $categoria) {

        $this->id = $id;
        $this->categoria = $categoria;
    }
    

    //Métodos Getter and Setter
    function getId() {
        return $this->id;
    }
    
    function getCategoria() {
        return $this->categoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    //Obtener todas las categorias
    public function getAll() {
        
        $conexion = new Database();
        $sql = "SELECT * FROM Categorias ORDER BY Categoria ASC;";
        
        $resultado = $conexion->Consulta($sql);

        $objeto;
        $categorias = new ArrayObject();

        //Por cada categoria obtenida crear un objeto y guardarlo en $categorias
        while ($fila = mysqli_fetch_array($resultado)) {
            $objeto = new Categoria();
            $objeto->constructor($fila['IDCategoria'], $fila['Categoria']);
            $categorias->append($objeto);
        }
        
        return $categorias;
    }
}