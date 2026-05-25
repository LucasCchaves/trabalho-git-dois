-- Execute este arquivo no phpMyAdmin ou via MySQL CLI
-- mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS crud_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE crud_db;

CREATE TABLE IF NOT EXISTS produtos (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nome       VARCHAR(100)   NOT NULL,
  preco      DECIMAL(10,2)  NOT NULL,
  quantidade INT            NOT NULL,
  criado_em  DATETIME       DEFAULT CURRENT_TIMESTAMP
);

-- Dados de exemplo
INSERT INTO produtos (nome, preco, quantidade) VALUES
  ('Teclado Mecânico', 299.90, 15),
  ('Mouse Gamer',      149.50, 30),
  ('Monitor 24"',     1299.00,  8);
