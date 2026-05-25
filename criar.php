<?php

require_once 'Produto.php';

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome       = trim($_POST['nome'] ?? '');
    $preco      = $_POST['preco'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';

    // Validação
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
        $produto = new Produto();
        $produto->criar($nome, (float)$preco, (int)$quantidade);
        header('Location: ../index.php?msg=Produto+criado+com+sucesso&tipo=ok');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Novo Produto</title>
</head>
<body>

<h1>Novo Produto</h1>
<a href="../index.php">← Voltar</a>

<?php foreach ($erros as $erro): ?>
  <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
<?php endforeach; ?>

<form method="POST">

  <label for="nome">Nome:</label><br />
  <input type="text" id="nome" name="nome"
         value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required />
  <br /><br />

  <label for="preco">Preço (R$):</label><br />
  <input type="number" id="preco" name="preco" step="0.01" min="0"
         value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required />
  <br /><br />

  <label for="quantidade">Quantidade:</label><br />
  <input type="number" id="quantidade" name="quantidade" min="0"
         value="<?= htmlspecialchars($_POST['quantidade'] ?? '') ?>" required />
  <br /><br />

  <button type="submit">Salvar</button>

</form>

</body>
</html>
