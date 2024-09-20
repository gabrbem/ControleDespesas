<?php
include '../classes/Usuario.php';

$login = $_GET['login'];

// Filtrar e excluir usuário do arquivo
$usuarios = Usuario::listarUsuarios();
$usuarios = array_filter($usuarios, function($usuario) use ($login) {
    return $usuario->getLogin() !== $login;
});

// Salvar os usuários restantes
$filePath = '../data/usuarios.txt';
$file = fopen($filePath, 'w');
foreach ($usuarios as $usuario) {
    fwrite($file, implode('|', [
        $usuario->getLogin(),
        $usuario->getSenha()
    ]) . PHP_EOL);
}
fclose($file);

// Redirecione para a página de gerenciamento de usuários
header("Location: ../views/gerenciar_usuarios.php");
exit;
?>
