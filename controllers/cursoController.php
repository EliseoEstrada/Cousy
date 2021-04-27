<?php

//Cargar el modelo 
require_once 'models/curso.php';

// definir clase controladora
class cursoController{
    public function index() {
        
        //Creo objeto del producto 
        $curso = new Curso();
        //Llamo el método para mostrar productos
        $cursos = $curso->getAll();
        
        //var_dump($cursos->fetch_object());
        
        // se renderizar la vista que se va ejecutar en este controlador
        require_once 'views/cursos/cursos.php';
    }

    //Método para la gestión de cursos
    public function gestion() {

        // incluyendo vista para la gestión de los productos
        require_once 'views/cursos/agregarCurso.php';
    }
}