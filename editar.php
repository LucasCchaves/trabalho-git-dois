<?php

require_once 'Produto.php';

$produto = new Produto();
$erros   = [];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)
  ?: filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../index.php?msg=ID+inválido&tipo=erro');
    exit;
}

$registro = $produto->buscarPorId($id);

if (!$registro) {
    header('Location: ../index.php?msg=Produto+não+encontrado&tipo=erro');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome       = trim($_POST['nome'] ?? '');
    $preco      = $_POST['preco'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';

    if ($nome === '') {
        $erros[] = 'O nome é obrigatório.';
    }
    if (!is_numeric($preco) || $preco < 0) {
        $erros[] = 'Preço inválido.';
    }
    if (!ctype_digit((string)$quantidade) || $quantidade < 0) {
        $erros[] = 'Quantidade inválida.';
    }

    if (empty($erros)) {
        $produto->atualizar($id, $nome, (float)$preco, (int)$quantidade);
        header('Location: ../index.php?msg=Produto+atualizado+com+sucesso&tipo=ok');
        exit;
    }

    // Mantém os valores digitados se houver erro
    $registro['nome']       = $nome;
    $registro['preco']      = $preco;
    $registro['quantidade'] = $quantidade;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Editar Produto #<?= $id ?></title>
</head>
<body>

<h1>Editar Produto #<?= $id ?></h1>
<a href="../index.php">← Voltar</a>

<?php foreach ($erros as $erro): ?>
  <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endforeach; ?>

<form method="POST">
  <input type="hidden" name="id" value="<?= $id ?>" />

  <label for="nome">Nome:</label><br />
  <input type="text" id="nome" name="nome"
         value="<?= htmlspecialchars($registro['nome']) ?>" required />
  <br /><br />

  <label for="preco">Preço (R$):</label><br />
  <input type="number" id="preco" name="preco" step="0.01" min="0"
         value="<?= htmlspecialchars($registro['preco']) ?>" required />
  <br /><br />

  <label for="quantidade">Quantidade:</label><br />
  <input type="number" id="quantidade" name="quantidade" min="0"
         value="<?= htmlspecialchars($registro['quantidade']) ?>" required />
  <br /><br />

  <button type="submit">Atualizar</button>

</form>

</body>
</html>
