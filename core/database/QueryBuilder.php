<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $sql = "select * from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $parameters)
    {
        //INSERT INTO `usuarios`(`id`, `nome`, `email`, `senha`, `imagem`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
        $sql = sprintf('INSERT INTO %s (%s) VALUE (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
    );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update($table, $id, $parameters){
        //UPDATE `usuarios` SET `id`='[value-1]',`nome`='[value-2]',`email`='[value-3]',`senha`='[value-4]',`imagem`='[value-5]' WHERE 1
        $sql = sprintf('UPDATE %s SET %s WHERE id=%d',
            $table,
            implode(', ', array_map(function($param) {return $param . ' = :' . $param;}, array_keys($parameters))),
            $id
    );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($table, $id){
        //DELETE FROM `usuarios` WHERE 0
        $sql = sprintf('DELETE FROM %s WHERE id=%s',
            $table, 
            $id
    );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}