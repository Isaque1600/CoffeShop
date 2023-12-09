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
                <li class="item">
                    <img src="<?php echo IMG_PATH ?>pexels-mohammad-khorram-14704657.jpg" alt="">
                    <p>Mocha</p>
                    <p>3 x <b>R$99,99</b></p>
                </li>
                <li class="item">
                    <img src="<?php echo IMG_PATH ?>pexels-mohammad-khorram-14704657.jpg" alt="">
                    <p>Mocha</p>
                    <p>3 x <b>R$99,99</b></p>
                </li>
                <li class="item">
                    <img src="<?php echo IMG_PATH ?>pexels-mohammad-khorram-14704657.jpg" alt="">
                    <p>Mocha</p>
                    <p>3 x <b>R$99,99</b></p>
                </li>
            </ul>
            <div class="general-info">
                <p>Valor Total: <b>R$99,99</b></p>
                <p>Token: <b>KFC123</b></p>
            </div>
            <a href="<?php echo DEFAULT_URL ?>">Retornar ao início</a>
        </section>
    </div>
</body>

</html>