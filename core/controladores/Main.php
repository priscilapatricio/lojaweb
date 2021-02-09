<?php

namespace core\controladores;

use core\classes\Functions;

class Main{

    public function index(){
       
        $dados =[
            'titulo' =>  'Este é o título',
            'clientes' => ['priscila', 'ana', 'carlos']
        ];

        Functions::Layout([
            'layouts/html_header',
            'pagina_inicial',
            'layouts/html_footer',
        ], $dados);
    }

    public function loja(){
        echo 'Loja!!!!!!';
    }

}