<?php

// var_dump($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>finalizar.css">
    <title>Pagamento</title>
</head>

<body>

    <?php

    include(HEADER);

    ?>

    <main class="pay-form-wrapper">
        <form action="" method="post" class="pay-form">
            <select name="formaPagamento" id="formaPagamento">
                <?php
                foreach ($data['formasPagamento'] as $key => $value) {
                    echo "<option value=\"{$value['tipo']}\">" . ucwords($value['tipo']) . "</option> ";
                }
                ?>

            </select>
            <div class="input-wrapper" hidden>
                <label for="cpf_cnpj">Cpf ou Cnpj: </label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj">
            </div>
            <div class="input-wrapper" hidden>
                <label for="numeroCartao">Numero do Cartão: </label>
                <input type="text" name="numeroCartao" id="numeroCartao">
            </div>
            <div class="input-wrapper" hidden>
                <label for="cvv">Codigo de segurança: </label>
                <input type="text" name="cvv" id="cvv">
            </div>
            <div class="input-wrapper" hidden>
                <label for="dataVencimento">Data de Vencimento do cartão: </label>
                <input type="text" name="dataVencimento" id="dataVencimento">
            </div>
            <div class="input-wrapper" hidden>
                <label for="nomeNoCartao">Nome no Cartão: </label>
                <input type="text" name="nomeNoCartao" id="nomeNoCartao">
            </div>
            <input type="submit" value="Confirmar" name="submit">
        </form>
    </main>

</body>

</html>