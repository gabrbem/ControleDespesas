<?php
include '../classes/Despesa.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $filePath = '../data/despesas.txt';
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    $newLines = array_filter($lines, function($line) use ($id) {
        return strpos($line, $id) === false;
    });
    file_put_contents($filePath, implode(PHP_EOL, $newLines) . PHP_EOL);
    echo '<p>Despesa excluída com sucesso!</p>';
}
?>

<a href="gerenciar_despesas.php" class="btn btn-primary">Voltar à Listagem de Despesas</a>
