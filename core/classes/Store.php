<?php

namespace core\classes;

use Exception;

class Store{

    // =============================================================

    public static function Layout($estruturas, $dados = null){

        // verifica se estruturas é um array
        if(!is_array($estruturas)){
            throw new Exception("Coleção de estruturas inválida");
        }

        // variáveis
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }

        // apresentar as viwes da aplicação
        foreach($estruturas as $estrutura){
            include("../core/views/$estrutura.php");
        }

    }

    // =============================================================

    public static function clienteLogado() {
        
        // verifica se existe um cliente logado.
        return isset($_SESSION['cliente']);
    }

    // =============================================================

    public static function criarHash($num_caracteres = 12){

        // criar hashes
        $chars = '01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);

        

    }

}

