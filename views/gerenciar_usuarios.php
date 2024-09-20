<?php
include '../classes/Usuario.php';
include '../views/header.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $usuario = $_POST['usuario'] ?? '';
   $senha = $_POST['senha'] ?? '';
   $acao = $_POST['acao'] ?? '';

   if ($acao === 'adicionar') {
      // Adiciona novo usuário
      Usuario::adicionarUsuario($usuario, $senha);
   } elseif ($acao === 'excluir') {
      // Exclui usuário existente
      $idUsuario = $_POST['id_usuario'] ?? '';
      Usuario::excluirUsuario($idUsuario);
   }
}
?>

<div class="container mt-4">
   <h2>Gerenciar Usuários</h2>

   <!-- Formulário para gerenciar usuários -->
   <form action="gerenciar_usuarios.php" method="post">
      <div class="form-group">
         <label for="usuario">Usuário</label>
         <input type="text" id="usuario" name="usuario" class="form-control" required>
      </div>
      <div class="form-group">
         <label for="senha">Senha</label>
         <input type="password" id="senha" name="senha" class="form-control" required>
      </div>
      <input type="hidden" name="acao" value="adicionar">
      <button type="submit" class="btn btn-primary">Adicionar Usuário</button>
   </form>

   <h3 class="mt-4">Usuários Existentes</h3>
   <ul class="list-group">
      <?php
      $usuarios = Usuario::listarUsuarios();
      foreach ($usuarios as $usuario) {
         echo "<li class='list-group-item'>";
         echo htmlspecialchars($usuario->getNome());
         echo "<form action='gerenciar_usuarios.php' method='post' class='d-inline'>
                    <input type='hidden' name='id_usuario' value='" . htmlspecialchars($usuario->getNome()) . "'>
                    <input type='hidden' name='acao' value='excluir'>
                    <button type='submit' class='btn btn-danger btn-sm float-right'>Excluir</button>
                  </form>";
         echo "</li>";
      }
      ?>
   </ul>

   <a href="../index.php" class="btn btn-secondary mt-3">Voltar ao Menu Principal</a>
</div>

<?php include '../views/footer.php'; ?>