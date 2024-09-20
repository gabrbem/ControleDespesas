<?php
include '../classes/Usuario.php';

// Pegue os dados do formulário
$login = $_POST['login'];
$senha = $_POST['senha'];

// Crie um novo usuário
$novoUsuario = new Usuario($login, $senha);

// Salve o usuário no arquivo
$usuarios = Usuario::listarUsuarios();
$usuarios[] = $novoUsuario;
$filePath = '../data/usuarios.txt';
$file = fopen($filePath, 'w');
foreach ($usuarios as $usuario) {
    fwrite($file, implode('|', [
        $usuario->getLogin(),
        $usuario->getSenha()
    ]) . PHP_EOL);
}
fclose($file);

// Redirecione de volta para a página de gerenciamento de usuários
header("Location: ../views/gerenciar_usuarios.php");
exit;
?>
