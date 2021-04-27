<?php
// definir clase controladora de errores 404
class errorController{
    
    public function index() {
        echo '
        <div class="text-center text-white">
        <h1>La página que buscas no existe</h1>
        </div>
        ';
    }
    
}
