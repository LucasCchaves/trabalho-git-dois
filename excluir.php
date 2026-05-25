<?php

require_once 'Produto.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../index.php?msg=ID+inválido&tipo=erro');
    exit;
}

$produto   = new Produto();
$registro  = $produto->buscarPorId($id);

if (!$registro) {
    header('Location: ../index.php?msg=Produto+não+encontrado&tipo=erro');
    exit;
}

$produto->excluir($id);

header('Location: ../index.php?msg=Produto+excluído+com+sucesso&tipo=ok');
exit;
