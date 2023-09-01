<?php

session_start();
include_once("../Cadastro~/conexao.php");

$cpf = $_POST['cpf'];

$sql = "SELECT *, (p.Quantidade * pr.Preco) AS PrecoP 
        FROM Pedido p, Livros l, Produtos pr, Cliente c, Pagamento pg
        WHERE c.CPF = $cpf and p.Produto = pr.CodProdutos and p.Livro = l.CodLivros 
        and p.CodPedido = pg.Pedido and $cpf = pg.CPF
        ORDER BY DataPedido DESC";

$result = mysqli_query($conexao, $sql);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEUS PEDIDOS</title>
</head>
<body>
    
    <center>
        <h1>MEUS PEDIDOS</h1>
    </center>

    <div>

<center>

<table class="table" border='1'>
   <thead>
    <tr>
      <th scope="col">CÓDIGO do PEDIDO</th>
      <th scope="col">DATA do PEDIDO</th>
      <th scope="col">NOME do LIVRO</th>
      <th scope="col">NOME do PRODUTO</th>
      <th scope="col">PREÇO do PRODUTO</th>
      <th scope="col">CPF do CLIENTE</th>
      <th scope="col">NOME do CLIENTE</th>
      <th scope="col">MÉTODO de PAGAMENTO</th>
    </tr>
   </thead>
  <tbody>
    <?php
        while($user_data = mysqli_fetch_assoc($result)){

            echo "<tr>";
            echo "<td>".$user_data['CodPedido']."</td>";
            echo "<td>".$user_data['DataPedido']."</td>";
            echo "<td>".$user_data['NomeL']."</td>";
            echo "<td>".$user_data['NomeP']."</td>";
            echo "<td>R$ ".$user_data['PrecoP']."</td>";
            echo "<td>".$user_data['CPF']."</td>";
            echo "<td>".$user_data['NomeC']."</td>";
            echo "<td>".$user_data['Metodo_PG']."</td>";
            echo "<tr>";

        }
    ?>
  </tbody>
</table>

</center>

    </div>

</body>
</html>