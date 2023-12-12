<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>finalizar.css">
    <title>Finalizar Compra</title>
</head>

<body>
    <div class="wrapper-thanks">
        <section class="thanks">
            <img src="<?php echo IMG_PATH ?>undraw_empty_cart_co35.svg" alt="">
            <h1>Agradecemos pela compra</h1>
            <p>Leve o token a nossa loja mais próxima para retirada.</p>
        </section>
        <section class="products">
            <header>
                <h2><i class="fa-solid fa-bag-shopping"></i> Seu pedido</h2>
            </header>
            <ul class="items">
                <?php

                foreach ($data['prod'] as $key => $value) {
                    echo "<li class=\"item\">";
                    echo "<p>$key</p>";
                    echo "<p>$value[1] x <b>R$$value[0]</b></p>";
                    echo "</li>";
                }

                ?>
            </ul>
            <div class="general-info">
                <p>Valor Total: <b>
                        R$
                        <?php echo $data['valor'] ?>
                    </b></p>
                <p>Token: <b>
                        <?php echo $data['token'] ?>
                    </b></p>
            </div>
            <a href="<?php echo DEFAULT_URL ?>">Retornar ao início</a>
        </section>
    </div>
</body>

</html>