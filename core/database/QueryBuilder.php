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
}
