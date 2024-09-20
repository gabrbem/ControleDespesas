<?php

class Usuario {
    private $nome;
    private $login;
    private $senha;

    public function __construct($nome, $login, $senha) {
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a senha
    }

    public function getNome() {
        return $this->nome;
    }

    public function getLogin() {
        return $this->login;
    }

    // Função para salvar o usuário no arquivo de texto
    public function salvarUsuario() {
        if (self::loginExiste($this->login)) {
            return false; // Se o login já existe, retorna false
        }
        
        $linha = $this->nome . "," . $this->login . "," . $this->senha . "\n";
        file_put_contents('../data/usuarios.txt', $linha, FILE_APPEND);
        return true; // Se o usuário foi salvo com sucesso, retorna true
    }

    // Função para verificar se o login já existe
    public static function loginExiste($login) {
        $arquivo = '../data/usuarios.txt';
        
        if (file_exists($arquivo)) {
            $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
            foreach ($linhas as $linha) {
                if (!empty($linha)) { // Verifica se a linha não está vazia
                    list($nome, $loginExistente, $senha) = explode(',', $linha);
                    if ($loginExistente === $login) {
                        return true; // O login já existe
                    }
                }
            }
        }

        return false; // O login não existe
    }

    // Função para listar todos os usuários
    public static function listarUsuarios() {
        $usuarios = [];
        $arquivo = '../data/usuarios.txt';

        if (file_exists($arquivo)) {
            $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
            foreach ($linhas as $linha) {
                if (!empty($linha)) { // Verifica se a linha não está vazia
                    $dados = explode(',', $linha);
                    if (count($dados) === 3) { // Verifica se há 3 elementos
                        $usuarios[] = new Usuario(trim($dados[0]), trim($dados[1]), trim($dados[2]));
                    }
                }
            }
        }

        return $usuarios;
    }

    // Função para adicionar um usuário
    public static function adicionarUsuario($nome, $senha) {
        $usuario = new Usuario($nome, $nome, $senha); // O login é o mesmo que o nome
        return $usuario->salvarUsuario();
    }

    // Função para excluir um usuário
    public static function excluirUsuario($login) {
        $arquivo = '../data/usuarios.txt';
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $novasLinhas = [];

        foreach ($linhas as $linha) {
            if (!empty($linha)) { // Verifica se a linha não está vazia
                list($nome, $loginExistente, $senha) = explode(',', $linha);
                if ($loginExistente !== $login) {
                    $novasLinhas[] = $linha; // Mantém apenas os usuários que não são o que queremos excluir
                }
            }
        }

        // Grava as novas linhas no arquivo
        file_put_contents($arquivo, implode(PHP_EOL, $novasLinhas) . PHP_EOL);
    }

    // Função para editar um usuário
    public static function editarUsuario($login, $novaSenha) {
        $arquivo = '../data/usuarios.txt';
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $novasLinhas = [];

        foreach ($linhas as $linha) {
            if (!empty($linha)) { // Verifica se a linha não está vazia
                list($nome, $loginExistente, $senha) = explode(',', $linha);
                if ($loginExistente === $login) {
                    // Atualiza a senha
                    $senha = password_hash($novaSenha, PASSWORD_DEFAULT);
                }
                $novasLinhas[] = $nome . "," . $loginExistente . "," . $senha; // Recria a linha
            }
        }

        // Grava as novas linhas no arquivo
        file_put_contents($arquivo, implode(PHP_EOL, $novasLinhas) . PHP_EOL);
    }
}
?>
