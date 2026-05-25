<?php

require_once __DIR__ . '/../config/database.php';

class Produto {

    private PDO $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // CREATE
    public function criar(string $nome, float $preco, int $quantidade): bool {
        $sql  = 'INSERT INTO produtos (nome, preco, quantidade) VALUES (:nome, :preco, :quantidade)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome'       => $nome,
            ':preco'      => $preco,
            ':quantidade' => $quantidade,
        ]);
    }

    // READ — todos
    public function listar(): array {
        $stmt = $this->pdo->query('SELECT * FROM produtos ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    // READ — um por ID
    public function buscarPorId(int $id): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM produtos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // UPDATE
    public function atualizar(int $id, string $nome, float $preco, int $quantidade): bool {
        $sql  = 'UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'         => $id,
            ':nome'       => $nome,
            ':preco'      => $preco,
            ':quantidade' => $quantidade,
        ]);
    }

    // DELETE
    public function excluir(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
