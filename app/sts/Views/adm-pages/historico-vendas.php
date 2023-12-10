<?php

// echo "<pre>";
// var_dump($data);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>historico.css">
    <title>Histórico de Vendas</title>
</head>

<body>

    <?php

    include(HEADER);

    ?>

    <h1>Últimas Vendas Realizadas</h1>
    <div class="table-wrapper">
        <table class="vendas">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data Venda</th>
                    <th>Cliente Id</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                    <th>Token</th>
                    <th>Total Venda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['vendas_item'] as $key => $value) {
                    echo "<tr>";
                    echo " <th>{$value['vendaId']}</th>";
                    echo " <td>{$value['dataVenda']}</td>";
                    echo " <td>{$value['pessoaId']}</td>";
                    echo " <td>{$value['produtoId']}</td>";
                    echo " <td>{$value['quantidade']}</td>";
                    echo " <td>R$" . $value['preco_unit'] . "</td>";
                    echo " <td>R$" . $value['subtotal'] . "</td>";
                    echo " <td>{$value['token']}</td>";
                    echo " <td>R$" . $value['valor'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo JS_PATH ?>sellsHistory.js"></script>
</body>

</html>