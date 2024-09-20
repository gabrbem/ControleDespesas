<?php include '../views/header.php'; ?>
<div class="container mt-4">
    <h1 class="mb-4">Entrar Despesa</h1>
    <form action="../controllers/entrar_despesa_controller.php" method="post">
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
        </div>
        <div class="form-group">
            <label for="dataVencimento">Data de Vencimento:</label>
            <input type="date" class="form-control" id="dataVencimento" name="dataVencimento" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pendente">Pendente</option>
                <option value="pago">Pago</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Entrar Despesa</button>
    </form>
    <a href="../index.php" class="btn btn-secondary mt-4">Voltar ao Menu Principal</a>
</div>
<?php include '../views/footer.php'; ?>
