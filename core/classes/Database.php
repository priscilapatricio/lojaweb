<?php

namespace core\classes;

use PDO;
use PDOException;

class Database{
    
    private $ligacao;

    private function ligar(){
        // ligar a base de dados
        $this->ligacao = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // debug - apresentação de informações de erro
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function desligar(){
        // desliga-se da base de dados dados
        $this->ligacao = null;
    }

    public function select($sql, $parametros = null){
        // executa função de pesquisa de SQL
        $this->ligar();

        $resultados = null;

        // comunicar
        try {

            //comunicação com a bd
            if(!empty($parametros)){
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else{
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }

        } catch (PDOException $e) {
            
            // caso exista erro
            return false;

        }

        // desligar da db
        $this->desligar();

        // devolver os resultados obtidos
        return $resultados;
    }

}
