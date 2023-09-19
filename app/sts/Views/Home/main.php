<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php echo (isset($this->data['user'])) ? "Ola senhor(a): {$this->data['user']['nome']}" : "" ?>

    <h1>Pagina inicial</h1>

    <a href="<?php echo DEFAULT_URL ?>Home/login">Login</a>

    </br>

    <a href="<?php echo DEFAULT_URL ?>Home/cadastro">Cadastro</a>

    <br>

    <a href="<?php echo DEFAULT_URL ?>Home/sair">Sair</a>

</body>

</html>