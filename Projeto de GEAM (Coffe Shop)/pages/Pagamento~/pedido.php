<?php

    session_start();
    include('../Cadastro~/conexao.php');

    $cod_produto = $_POST['pedido'];
    $cod_livro = $_POST['livro'];
    $quant = $_POST['quant'];
    $date = date('Y/m/d');
    $_SESSION['cpf'] = $_POST['cpf'];
    $cpf = $_SESSION['cpf'];
    $metodo_pg = $_POST['metodo'];

    $_SESSION['cod_pedido'] = rand(1, 99999);
    $cod_pedido = $_SESSION['cod_pedido'];

    $_SESSION['cod_pagamento'] = rand(1, 99999);
    $cod_pagamento = $_SESSION['cod_pagamento'];

    $sql = "INSERT INTO Pedido(CodPedido, Livro, Cliente, Produto, DataPedido, Quantidade) 
            VALUES ('$cod_pedido', '$cod_livro', $cpf, '$cod_produto', '$date', $quant);";
    
    $sql2 = "INSERT INTO Pagamento(CodPagamento, Pedido, CPF, Metodo_PG)
            VALUES ('$cod_pagamento', '$cod_pedido', $cpf, '$metodo_pg');";

    $conexaozinha = mysqli_query($conexao, $sql);
    $conexaozinha2 = mysqli_query($conexao, $sql2);

    if($conexaozinha){
    header("Location: ../Pg-inicial-dps-do-Login~/pg.html");
    mysqli_close($conexao);
    }

    else{
        header("Location: pedido.html");
        mysqli_close($conexao);
    }

?>