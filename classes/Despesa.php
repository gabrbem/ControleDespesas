<?php

class Despesa {
    private $descricao;
    private $valor;
    private $dataVencimento;
    private $categoria;
    private $status;

    public function __construct($descricao, $valor, $dataVencimento, $categoria, $status) {
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->dataVencimento = $dataVencimento;
        $this->categoria = $categoria;
        $this->status = $status;
    }

    public static function listarDespesas() {
        $despesas = [];
        $filePath = '../data/despesas.txt';

        if (!file_exists($filePath)) {
            file_put_contents($filePath, '');
        }

        $file = fopen($filePath, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = explode('|', trim($line));
                if (count($data) === 5) {
                    $despesas[] = new Despesa($data[0], $data[1], $data[2], $data[3], $data[4]);
                }
            }
            fclose($file);
        }
        return $despesas;
    }

    public function anotarPagamento($valor, $dataPagamento) {
        // Atualiza o status e os detalhes do pagamento
        $this->status = 'pago';
        $this->valor = $valor; // Aqui você pode decidir se quer atualizar o valor
        $this->dataPagamento = $dataPagamento; // Pode adicionar um atributo para a data de pagamento
        $this->salvar();
    }

    private function salvar() {
        $filePath = '../data/despesas.txt';
        $linhas = file($filePath, FILE_IGNORE_NEW_LINES);
        $novasLinhas = [];

        foreach ($linhas as $linha) {
            $data = explode('|', trim($linha));
            if ($data[0] === $this->descricao) {
                // Atualiza a linha com o novo status e valor
                $novasLinhas[] = implode('|', [$this->descricao, $this->valor, $data[2], $data[3], $this->status]);
            } else {
                $novasLinhas[] = $linha; // Mantém a linha inalterada
            }
        }

        // Grava as novas linhas no arquivo
        file_put_contents($filePath, implode(PHP_EOL, $novasLinhas) . PHP_EOL);
    }

    // Getters
    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getDataVencimento() {
        return $this->dataVencimento;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getStatus() {
        return $this->status;
    }
}
?>
