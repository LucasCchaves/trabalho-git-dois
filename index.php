<?php

require_once 'Produto.php';

$produto  = new Produto();
$produtos = $produto->listar();

$mensagem = $_GET['msg'] ?? '';
$tipo     = $_GET['tipo'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>CRUD Produtos</title>
</head>
<body>

<h1>CRUD de Produtos</h1>

<a href="pages/criar.php">+ Novo Produto</a>

<?php if ($mensagem): ?>
  <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
<?php endif; ?>

<table border="1" cellpadding="6" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Preço (R$)</th>
      <th>Quantidade</th>
      <th>Criado em</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($produtos)): ?>
      <tr><td colspan="6">Nenhum produto cadastrado.</td></tr>
    <?php else: ?>
      <?php foreach ($produtos as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nome']) ?></td>
          <td><?= number_format($p['preco'], 2, ',', '.') ?></td>
          <td><?= $p['quantidade'] ?></td>
          <td><?= $p['criado_em'] ?></td>
          <td>
            <a href="pages/editar.php?id=<?= $p['id'] ?>">Editar</a>
            |
            <a href="pages/excluir.php?id=<?= $p['id'] ?>"
               onclick="return confirm('Excluir produto #<?= $p['id'] ?>?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
