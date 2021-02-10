<?php
/*
carregar bibliotecas/classes: 
carregar o config.
carregar classes
carregar o sistema de rotas
    - mostrar loja
    - mostrar o carrinho
    - mostrar o backoffice, etc.
*/

// abrir a seção
session_start();

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

// carrega o sistema de rotas
require_once('../core/rotas.php');



?>