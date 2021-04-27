<?php

//Cargar el modelo 
require_once 'models/categoria.php';

// definir clase controladora
class categoriaController{
    public function index() {
        
        //Creo objeto del producto 
        $categoria = new Categoria();
        //Llamo el método para mostrar productos
        $categorias = $categoria->getAll();
        
        // se renderizar la vista que se va ejecutar en este controlador
        //require_once 'views/cursos/cursos.php';
    }
}