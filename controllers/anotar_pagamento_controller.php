<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../classes/Despesa.php';

    $id = $_POST['id'];
    $status = 'pago';

    // Lógica para atualizar o status da despesa no arquivo
    $filePath = '../data/despesas.txt';
    $fileLines = file($filePath);
    $file = fopen($filePath, 'w');

    foreach ($fileLines as $line) {
        $data = explode('|', trim($line));
        if ($data[0] == $id) {
            $data[4] = $status;
            $line = implode('|', $data) . PHP_EOL;
        }
        fwrite($file, $line);
    }
    fclose($file);

    header("Location: ../views/anotar_pagamento.php?success=true");
    exit();
}
?>
