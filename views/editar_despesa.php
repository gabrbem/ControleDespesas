<?php
include '../classes/Despesa.php';

$id = $_GET['id'] ?? '';
$despesa = null;
$despesas = Despesa::listarDespesas();

foreach ($despesas as $item) {
    if ($item->getDescricao() === $id) {
        $despesa = $item;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $dataVencimento = $_POST['data_vencimento'];
    $categoria = $_POST['categoria'];
    $status = $_POST['status'];

    $filePath = '../data/despesas.txt';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    $newLines = array_filter($lines, function($line) use ($id) {
        return strpos($line, $id) === false;
    });
    $newLines[] = "{$descricao}|{$valor}|{$dataVencimento}|{$categoria}|{$status}";
    file_put_contents($filePath, implode(PHP_EOL, $newLines) . PHP_EOL);
    echo '<p>Despesa atualizada com sucesso!</p>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Despesa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2>Editar Despesa</h2>
        <form method="post">
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo htmlspecialchars($despesa->getDescricao()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" class="form-control" id="valor" name="valor" value="<?php echo htmlspecialchars($despesa->getValor()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" value="<?php echo htmlspecialchars($despesa->getDataVencimento()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo htmlspecialchars($despesa->getCategoria()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="pendente" <?php echo $despesa->getStatus() === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                    <option value="pago" <?php echo $despesa->getStatus() === 'pago' ? 'selected' : ''; ?>>Pago</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
        <a href="gerenciar_despesas.php" class="btn btn-primary mt-3">Voltar à Listagem de Despesas</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
