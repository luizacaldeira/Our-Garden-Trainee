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

    public function selectAll($table, $inicio = null, $rows_count = null)
    {
        $sql = "select * from {$table} order by id DESC";
        if ($inicio >= 0 && $rows_count > 0) {
            $sql .= " LIMIT {$inicio}, {$rows_count}";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Função que vai pegar todos os dados da tabela publicacoes, juntamente com o nome do usuário que fez a publicação.
     */
    public function selectPostsWithUser($inicio = null, $rows_count = null)
    {
        $sql = "
            SELECT 
            p.*,
            u.nome AS nome_usuario,
            u.imagem AS imagem_usuario
            FROM publicacoes AS p
            INNER JOIN usuarios AS u
            ON p.usuarios_id = u.id
            ORDER BY p.id DESC
            LIMIT {$inicio}, {$rows_count}";

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

    public function delete($table, $id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE id = :id',
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

    public function countAll($table)
    {
        $sql = "select COUNT(*) from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return intval($stmt->fetch(PDO::FETCH_NUM)[0]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function verificarLogin($email, $senha)
    {
        //SELECT * FROM `usuarios` WHERE 1
        $sql = sprintf('SELECT * FROM usuarios WHERE email = :email AND senha = :senha');

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'senha' => $senha
            ]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            return $user;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectPostWithUserById($id)
    {
        $sql = "
        SELECT 
            p.*,
            u.nome AS nome_usuario
        FROM publicacoes AS p
        INNER JOIN usuarios AS u
            ON p.usuarios_id = u.id
        WHERE p.id = :id
        LIMIT 1
    ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function buscaPublicacoes($titulo)
    {
        $sql = 'SELECT 
                p.*,
                u.nome AS nome_usuario
                FROM publicacoes AS p
                INNER JOIN usuarios AS u
                ON p.usuarios_id = u.id
                WHERE p.titulo LIKE :titulo';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['titulo' => "%" . $titulo . "%"]);

            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function buscaUsuarios($nome)
    {
        $sql = 'SELECT * FROM usuarios WHERE nome LIKE :nome';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['nome' => "%" . $nome . "%"]);

            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectWhere($table, $conditions)
    {
        $sql = "SELECT * FROM {$table} WHERE ";
        $bindings = [];
        $clauses = [];

        foreach ($conditions as $col => $val) {
            $param = ':' . $col;
            $clauses[] = "{$col} = {$param}";
            $bindings[$param] = $val;
        }

        $sql .= implode(' AND ', $clauses);
        $sql .= " LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bindings);

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function insereFavoritos($id_post, $id_user)
    {
        if ($this->isFavorito($id_post, $id_user)) {
            $sql = "DELETE FROM favoritos 
                WHERE id_publicacao = :id_post AND id_usuario = :id_user";

            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':id_post' => $id_post,
                    ':id_user' => $id_user
                ]);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $sql = 'INSERT INTO favoritos (id_publicacao, id_usuario) VALUES (:id_post, :id_user)';

            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':id_user' => $id_user,
                    ':id_post' => $id_post,
                ]);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

    public function selectFavoritosByUser($id_usuario)
    {
        $sql = "
        SELECT 
            p.*,
            u.nome AS nome_usuario
        FROM favoritos f
        INNER JOIN publicacoes p 
            ON f.id_publicacao = p.id
        INNER JOIN usuarios u 
            ON p.usuarios_id = u.id
        WHERE f.id_usuario = :id_usuario
        ORDER BY p.id DESC
    ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_usuario' => $id_usuario]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Função que vai verificar se um post já está marcado como favorito 
    public function isFavorito($id_post, $id_user)
    {
        $sql = "SELECT COUNT(*) AS total 
            FROM favoritos 
            WHERE id_publicacao = :id_post AND id_usuario = :id_user";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_post' => $id_post,
                ':id_user' => $id_user
            ]);

            $result = $stmt->fetch(PDO::FETCH_OBJ);

            return $result->total > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findUserById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
