<?php

// coleção de rotas
$rotas = [
    'inicio' => 'main@index', 
    'loja' => 'main@loja',

    // cliente
    'novo_cliente' => 'main@novo_cliente',
    'criar_cliente' => 'main@criar_cliente',

    'carrinho' => 'main@carrinho',
    ];

// define uma ação por defeito
$acao = 'inicio';

// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists( $_GET['a'], $rotas)){
        $acao = 'inicio';
    } else{
        $acao = $_GET['a'];
    }
}

// trata a definição da rota
$partes = explode('@',$rotas[$acao]);
$controlador = ucfirst($partes[0]);
$controlador = 'core\\controladores\\'.ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();
