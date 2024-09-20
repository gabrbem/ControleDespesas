<?php
include '../classes/Despesa.php';
include '../views/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = $_POST['valor'] ?? '';
    $dataPagamento = $_POST['data_pagamento'] ?? '';
    $idDespesa = $_POST['id_despesa'] ?? '';

    // Lógica para anotar o pagamento
    $despesas = Despesa::listarDespesas();
    foreach ($despesas as $despesa) {
        if ($despesa->getDescricao() === $idDespesa) {
            // Anota o pagamento para a despesa
            $despesa->anotarPagamento($valor, $dataPagamento);
            break;
        }
    }
}
?>

<div class="container mt-4">
    <h2>Anotar Pagamento</h2>

    <!-- Formulário para anotar pagamento -->
    <form action="anotar_pagamento.php" method="post">
        <div class="form-group">
            <label for="id_despesa">Despesa</label>
            <select id="id_despesa" name="id_despesa" class="form-control" required>
                <?php
                $despesas = Despesa::listarDespesas();
                foreach ($despesas as $despesa) {
                    echo "<option value='" . htmlspecialchars($despesa->getDescricao()) . "'>" . htmlspecialchars($despesa->getDescricao()) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" id="valor" name="valor" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="data_pagamento">Data do Pagamento</label>
            <input type="date" id="data_pagamento" name="data_pagamento" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Anotar Pagamento</button>
    </form>

    <a href="../index.php" class="btn btn-secondary mt-3">Voltar ao Menu Principal</a>
</div>

<?php include '../views/footer.php'; ?>
