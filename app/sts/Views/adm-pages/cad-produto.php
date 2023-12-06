<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>cad-produto.css">
    <title>Cadastrar Produto</title>
</head>

<body>

    <?php

    include(HEADER);

    ?>

    <h1>Cadastre um Produto</h1>
    <form action="" method="POST" class="form-produto" enctype="multipart/form-data">
        <label for="name" class="input-name">Nome: </label><input required type="text" class="input" name="nome">
        <label for="price" class="input-name">Preço: </label><input required type="text" class="input" name="valor">
        <label for="stock" class="input-name">Quanto há em estoque: </label><input required type="number" class="input"
            name="quantidade">
        <label for="img" class="input-name">Imagem: </label><input required type="file" class="input" name="path">
        <button type="submit" name="submit">Cadastrar</button>
    </form>
    <p>
        <?php
        if($data['stats'] == "success") {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "falha ao cadastra produto!";
        }
        ?>
    </p>
</body>

</html>