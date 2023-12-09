<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
</head>

<body>

    <?php

    include(HEADER);

    ?>

    <form action="" method="post">
        <select name="formaPagamento" id="formaPagamento">
            <option value="pix">PIX</option>
            <option value="debito">Cartão de Debito</option>
        </select>
        <label for="cpf_cnpj" hidden>Cpf ou Cnpj</label>
        <input type="text" name="cpf_cnpj" id="cpf_cnpj" hidden>
        <label for="numeroCartao" hidden>Numero do Cartão</label>
        <input type="text" name="numeroCartao" id="numeroCartao" hidden>
        <label for="cvv" hidden>Codigo de segurança</label>
        <input type="text" name="cvv" id="cvv" hidden>
        <label for="dataVencimento" hidden>Data de Vencimento do cartão</label>
        <input type="text" name="dataVencimento" id="dataVencimento" hidden>
        <label for="nomeNoCartao" hidden>Nome no Cartão</label>
        <input type="text" name="nomeNoCartao" id="nomeNoCartao" hidden>
        <input type="submit" value="Confirmar" name="submit">
    </form>

</body>

</html>