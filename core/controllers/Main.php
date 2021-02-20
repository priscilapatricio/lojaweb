<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;

class Main{
    
    // ====================================================
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
      
        // inserir novo cliente na base de dados e devolver o purl
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registrar_cliente();    

        // envio do e-mail para o cliente 
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
        
        if($resultado){
            echo 'E-mail enviado';
        }else{
            echo 'Aconteceu um erro';
        }
 
    }

    // ====================================================
    public function confirmar_email(){

        // verifica se já existe seção
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        // verificar se existe na query string um purl
        if(!isset($_GET['purl'])){
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        // verifica se o purl é válido
        if(strlen($purl) != 12){
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if($resultado){
            echo 'Conta validada com sucesso.';
        }else{
            echo 'A conta não foi validada.';
        }
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
}    