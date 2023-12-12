<?php

if (isset($data['stats'])) {
    if ($data['stats'][0] == "success" && $data['stats'][1] == "success") {
        $result['title'] = "Cadastro sucedido!";
        $result['text'] = "O cadastro do produto foi feito com exito!";
    } else {
        $result['title'] = "Erro ocorrido!";
        if ($data['stats'][0] != "success") {
            $result['text'] = $data['stats'][0];
        } else {
            $result['text'] = "Um erro critico ocorreu, contate o administrador para resolver-lo!";
        }
    }
}

// var_dump($data);

?>

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
    <div class="popUp" style="<?php echo (isset($result)) ? "display:flex;" : "display:none;" ?>">
        <div class="popUp-content">
            <span class="popUp-close">&times;</span>
            <h1 class="popUp-title">
                <?php echo $result['title']; ?>
            </h1>
            <p class="popUp-text">
                <?php echo $result['text']; ?>
            </p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
</body>

</html>