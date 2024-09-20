<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/Despesa.php';

    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $dataVencimento = $_POST['dataVencimento'];
    $categoria = $_POST['categoria'];
    $status = $_POST['status'];

    $novaDespesa = new Despesa($descricao, $valor, $dataVencimento, $categoria, $status);

    // Lógica para salvar a nova despesa no arquivo
    $filePath = '../data/despesas.txt';
    $file = fopen($filePath, 'a');
    if ($file) {
        $line = implode('|', [$descricao, $valor, $dataVencimento, $categoria, $status]) . PHP_EOL;
        fwrite($file, $line);
        fclose($file);
        header("Location: ../views/entrar_despesa.php?success=true");
        exit();
    } else {
        echo "Erro ao abrir o arquivo.";
    }
}
?>
