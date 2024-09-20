<?php
include '../classes/Despesa.php';

$id = $_GET['id'];

// Filtrar e excluir despesa do arquivo
$despesas = Despesa::listarDespesas();
$despesas = array_filter($despesas, function($despesa) use ($id) {
    return $despesa->getDescricao() !== $id;
});

// Salvar as despesas restantes
$filePath = '../data/despesas.txt';
$file = fopen($filePath, 'w');
foreach ($despesas as $despesa) {
    fwrite($file, implode('|', [
        $despesa->getDescricao(),
        $despesa->getValor(),
        $despesa->getDataVencimento(),
        $despesa->getCategoria(),
        $despesa->getStatus()
    ]) . PHP_EOL);
}
fclose($file);

// Redirecione para a página de listagem de despesas
header("Location: ../views/listar_despesas.php");
exit;
?>
