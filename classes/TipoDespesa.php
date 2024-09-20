<?php

class TipoDespesa {
    private $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public static function listarTiposDespesa() {
        $filePath = '../data/tipos_despesa.txt'; // Atualizado para "data"

        // Verifica se o arquivo existe
        if (!file_exists($filePath)) {
            // Cria o arquivo se ele não existir
            file_put_contents($filePath, '');
        }

        $tiposDespesa = [];

        // Tenta abrir o arquivo
        $file = fopen($filePath, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $tipoDespesa = trim($line);
                $tiposDespesa[] = new TipoDespesa($tipoDespesa); // Adiciona como objeto
            }
            fclose($file);
        } else {
            // Erro ao abrir o arquivo
            throw new Exception("Não foi possível abrir o arquivo de tipos de despesa.");
        }

        return $tiposDespesa;
    }

    public static function adicionarTipoDespesa($novoTipo) {
        $filePath = '../data/tipos_despesa.txt'; // Atualizado para "data"

        // Adiciona o novo tipo de despesa ao final do arquivo
        $file = fopen($filePath, 'a');
        if ($file) {
            fwrite($file, $novoTipo . PHP_EOL);
            fclose($file);
        } else {
            throw new Exception("Não foi possível abrir o arquivo de tipos de despesa.");
        }
    }
}
