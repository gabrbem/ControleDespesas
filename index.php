<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu Principal</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
   <?php include 'views/header.php'; ?>
   <div class="container mt-4">
      <h1 class="mb-4">Bem-vindo ao Sistema de Controle de Despesas</h1>
      <div class="list-group">
         <a href="views/entrar_despesa.php" class="list-group-item list-group-item-action">Entrar Despesa</a>
         <a href="views/anotar_pagamento.php" class="list-group-item list-group-item-action">Anotar Pagamento</a>
         <a href="views/gerenciar_despesas.php" class="list-group-item list-group-item-action">Gerenciar Despesas</a>
         <a href="views/gerenciar_usuarios.php" class="list-group-item list-group-item-action">Gerenciar Usuários</a>
         <a href="views/logout.php" class="list-group-item list-group-item-action">Sair</a>
      </div>
   </div>
   <?php include 'views/footer.php'; ?>
</body>

</html>