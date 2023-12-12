<?php

echo "<pre>";
var_dump($data);
echo "</pre>";

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
    <form action="" class="history-date">
        <input type="text" name="date" id="date" class="date" placeholder="dd/mm/yyyy">
        <button type="submit">Checar</button>
    </form>
    <div class="table-wrapper">
        <table class="vendas">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data Venda</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                    <th>Token</th>
                    <th>Total Venda</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>9 de janeiro</td>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>2</td>
                    <td>R$2,00</td>
                    <td>R$4,00</td>
                    <td>123jqz</td>
                    <td >R$6,00</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
                <tr>
                    <th>9 de janeiro</th>
                    <td>Seu José</td>
                    <td>Bolacha</td>
                    <td>R$89,99</td>
                    <td>123jqz</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Faturamento</th>
                    <td colspan="8">R$999,999</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo JS_PATH ?>sellsHistory.js"></script>
</body>

</html>