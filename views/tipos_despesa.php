<?php
include 'header.php';
require_once '../classes/TipoDespesa.php';

$tiposDespesa = TipoDespesa::listarTiposDespesa();
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['descricao']) && isset($_POST['acao'])) {
        $descricao = $_POST['descricao'];
        $acao = $_POST['acao'];

        if ($acao === 'Adicionar') {
            TipoDespesa::adicionarTipoDespesa($descricao);
            $successMessage = 'Tipo de despesa adicionado com sucesso!';
        } elseif ($acao === 'Editar' && isset($_POST['id'])) {
            $id = $_POST['id'];
            TipoDespesa::editarTipoDespesa($id, $descricao);
            $successMessage = 'Tipo de despesa editado com sucesso!';
        }
    } elseif (isset($_POST['acaoExcluir']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        TipoDespesa::excluirTipoDespesa($id);
        $successMessage = 'Tipo de despesa excluído com sucesso!';
    }
    $tiposDespesa = TipoDespesa::listarTiposDespesa();
}
?>

<div class="container">
    <h2 class="mt-5">Gerenciar Tipos de Despesa</h2>

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <button type="submit" name="acao" value="Adicionar" class="btn btn-primary">Adicionar Tipo de Despesa</button>
    </form>

    <h3 class="mt-5">Tipos de Despesa Existentes</h3>
    <ul class="list-group mt-3">
        <?php foreach ($tiposDespesa as $tipo): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlspecialchars($tipo->getDescricao()); ?>
                <div>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($tipo->getId()); ?>">
                        <input type="text" name="descricao" value="<?php echo htmlspecialchars($tipo->getDescricao()); ?>" required>
                        <button type="submit" name="acao" value="Editar" class="btn btn-warning btn-sm">Editar</button>
                    </form>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($tipo->getId()); ?>">
                        <button type="submit" name="acaoExcluir" value="Excluir" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
