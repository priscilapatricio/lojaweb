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

use core\classes\Database;

session_start();

// carregar o config 
require_once('../config.php');

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

$bd = new Database();
$clientes = $bd->select("SELECT * FROM clientes");
echo '<pre>';
print_r($clientes);

?>