<?php
// * Pagina inicial do site *


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Bonne Café</title>
</head>

<body>

    <?php echo (isset($data['user'])) ? "Ola senhor(a): {$data['user']['nome']}" : ""; ?>

    <h1>Pagina inicial</h1>

    <a href="<?php echo DEFAULT_URL ?>Home/login">Login</a>

    </br>

    <a href="<?php echo DEFAULT_URL ?>Home/cadastro">Cadastro</a>

    <br>

    <a href="<?php echo DEFAULT_URL ?>Home/sair">Sair</a>

</body>

</html>