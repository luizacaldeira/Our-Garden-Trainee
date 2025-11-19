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

    public function insert($table, $parameters)
    {
        var_dump($parameters);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
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

    public function selectOne($table, $id)
    {
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

    public function update($table, $id, $parameters)
    {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $table,
            implode(', ', array_map(function ($column) {
                return $column . ' = :' . $column;
            }, array_keys($parameters)))
        );

        $parameters['id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // $records = ["1,2" "1,3" "2,4"];
    public function insertPivot($records)
    {
        foreach ($records as $record) {
            $id_publicacao = (int)$record['id_publicacao'];
            $id_classificacao = (int)$record['id_classificacao'];
            $values[] = "($id_publicacao, $id_classificacao)";
        }

        $sql = "INSERT INTO publicacoes_classificacoes (id_publicacao, id_classificacao) VALUES" . implode(", ", $values);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function lastInsertID()
    {
        return $this->pdo->lastInsertID();
    }

    public function selectPostsWithClassification($id_post)
    {
        $sql = "
            SELECT c.*
            FROM classificacoes c
            INNER JOIN publicacoes_classificacoes pc 
            ON c.id = pc.id_classificacao
            WHERE pc.id_publicacao = :id_publicacao";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id_publicacao" => $id_post]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * $value = id do post
     */
    public function deletePivot($column, $value)
    {
        $sql = "DELETE FROM publicacoes_classificacoes WHERE {$column} = :value";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["value" => $value]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($table, $id){
        $sql = sprintf('DELETE FROM %s WHERE id = :id', 
            $table,
            'id = :id'
    );
    try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
    }
}
