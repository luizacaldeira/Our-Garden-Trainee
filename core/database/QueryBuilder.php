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
}