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

    /**
     * Função que vai pegar todos os dados da tabela, juntamente com o nome do usuário que fez a publicação.
     */
    public function selectPostsWithUser()
    {
        $sql = "
            SELECT 
            p.*,
            u.nome AS nome_usuario
            FROM publicacoes AS p
            INNER JOIN usuarios AS u
            ON p.usuarios_id = u.id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $parameters) {
        var_dump($parameters);

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", 
        $table, 
        implode(', ', array_keys($parameters)), 
        ":" . implode(', :', array_keys($parameters))
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectOne($table,$id){
        // SELECT * FROM `publicacoes` WHERE 1
        $sql = "SELECT * FROM {$table} WHERE id = :id LIMIT 1";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
