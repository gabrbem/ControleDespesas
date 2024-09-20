<?php
include '../views/header.php';
include '../classes/Despesa.php';

// Obtém o filtro de status, se existir
$status = $_GET['status'] ?? '';

// Obtém as despesas
$despesas = Despesa::listarDespesas();

?>

<div class="container mt-4">
   <h2>Gerenciar Despesas</h2>

   <table class="table table-striped mt-4">
      <thead>
         <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Data de Vencimento</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Ações</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($despesas as $despesa): ?>
            <?php if ($status === '' || $despesa->getStatus() === $status): ?>
               <tr>
                  <td><?php echo htmlspecialchars($despesa->getDescricao()); ?></td>
                  <td><?php echo htmlspecialchars($despesa->getValor()); ?></td>
                  <td><?php echo htmlspecialchars($despesa->getDataVencimento()); ?></td>
                  <td><?php echo htmlspecialchars($despesa->getCategoria()); ?></td>
                  <td><?php echo htmlspecialchars($despesa->getStatus()); ?></td>
                  <td>
                     <!-- Aqui você pode adicionar botões de editar e excluir se necessário -->
                     <a href="editar_despesa.php?id=<?php echo urlencode($despesa->getDescricao()); ?>"
                        class="btn btn-warning btn-sm">Editar</a>
                     <a href="excluir_despesa.php?id=<?php echo urlencode($despesa->getDescricao()); ?>"
                        class="btn btn-danger btn-sm">Excluir</a>
                  </td>
               </tr>
            <?php endif; ?>
         <?php endforeach; ?>
      </tbody>
   </table>

   <a href="../index.php" class="btn btn-secondary mt-3">Voltar ao Menu Principal</a>
</div>

<?php include '../views/footer.php'; ?>