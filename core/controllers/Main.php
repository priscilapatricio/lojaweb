<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;
use core\models\Clientes;

class Main{

    public function index(){
       
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ====================================================
    public function loja(){

        // apresenta a página da loja
           
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    
    // ====================================================
    public function novo_cliente(){
        
        // verifica se já existe seção aberta
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        // apresenta o layout para criar um novo utilizador

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ====================================================
    public function carrinho(){

        // apresenta a página do carrinho
           
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ====================================================
    public function criar_cliente(){

        // verifica se já existe seção
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        // verifica se houve submissão de um formulário
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        }

        // verifica se senha1 = senha2
        if($_POST['text_senha1'] !== $_POST['text_senha2']){

            // as senhas são diferentes
            $_SESSION['erro'] = 'As senhas não são iguais.';
            $this->novo_cliente();
            return;
        }

        // verifica na base de dados se já existe o cliente com mesmo e-mail

        $cliente = new Clientes();
            if($cliente->verificar_email_existe($_POST['text_email'])){
                
                $_SESSION['erro'] = 'Já existe um cliente com o mesmo e-mail.';
                $this->novo_cliente();
                return;
            }
      
        // cliente pronto para ser inserido na base de dados
        $purl = $cliente->registrar_cliente();    


        // criar um link purl para enviar por e-mail
        $link_purl = "http://localhost/lojaweb/public/?a=confirmar_email&purl=$purl";
 
    }

}

        /*
        3.registro

        criar um purl - personal URL
        guardar os dados na tabela clientes
        enviar um e-mail com o purl para o cliente
        apresentar uma mensagem indicando que deve validar o seu e-mail
        */