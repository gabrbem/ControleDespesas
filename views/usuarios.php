<?php
include 'header.php';
include '../classes/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    // Criar e tentar salvar o novo usuário
    $usuario = new Usuario($nome, $login, $senha);
    if ($usuario->salvarUsuario()) {
        echo "<p class='text-success'>Usuário cadastrado com sucesso!</p>";
    } else {
        echo "<p class='text-danger'>Erro: O login já existe. Escolha outro login.</p>";
    }
}
?>

<div class="container">
    <h2 class="mt-5">Gerenciar Usuários</h2>

    <h3 class="mt-4">Cadastrar Novo Usuário</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <hr>

    <h3 class="mt-4">Usuários Cadastrados</h3>
    <ul class="list-group">
        <?php
        $usuarios = Usuario::listarUsuarios();
        foreach ($usuarios as $usuario) {
            echo "<li class='list-group-item'>{$usuario->getNome()} (Login: {$usuario->getLogin()})</li>";
        }
        ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
