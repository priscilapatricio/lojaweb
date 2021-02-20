<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Clientes{

    // ===========================================================
    public function verificar_email_existe($email){

        // verifica se já existe outra conta com o mesmo email
        $bd = new Database();
        $parametros = [
            ':e' => strtolower(trim($email))
        ];
        $resultados = $bd->select("
            SELECT email FROM clientes WHERE email = :e
        ", $parametros);

        // se o cliente já existe...
        if(count($resultados) != 0){
            return true;
        } else {
            return false;
        }
    }

    // ===========================================================
    public function registar_cliente(){

        // regista o novo cliente na base de dados
        $bd = new Database();

        // cria uma hash para o registo do cliente
        $purl = Store::criarHash();

        // parametros
        $parametros = [
            ':email' => strtolower(trim($_POST['text_email'])),
            ':senha' => password_hash(trim($_POST['text_senha1']), PASSWORD_DEFAULT),
            ':nome_completo' => trim($_POST['text_nome_completo']),
            ':endereco' => trim($_POST['text_endereco']),
            ':cidade' => trim($_POST['text_cidade']),
            ':telefone' => trim($_POST['text_telefone']),
            ':purl' => $purl,
            ':ativo' => 0
        ];
        $bd->insert("
            INSERT INTO clientes VALUES(
                0,
                :email,
                :senha,
                :nome_completo,
                :morada,
                :cidade,
                :telefone,
                :purl,
                :ativo,
                NOW(),
                NOW(),
                NULL
            )
        ", $parametros);

        // retorna o purl criado
        return $purl;
    }

    // ===========================================================
    public function validar_email($purl){

        // validar o email do novo cliente
        $bd = new Database();
        $parametros = [
            ':purl' => $purl
        ];
        $resultados = $bd->select("
            SELECT * FROM clientes 
            WHERE purl = :purl
        ", $parametros);

        // verifica se foi encontrado o cliente
        if(count($resultados) != 1){
            return false;
        }

        // foi encontrado este cliente com o purl indicado
        $id_cliente = $resultados[0]->id_cliente;

        // atualizar os dados do cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
        $bd->update("
            UPDATE clientes SET
            purl = NULL,
            ativo = 1,
            updated_at = NOW()
        ", $parametros);

        return true;
    }

}