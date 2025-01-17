<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>sobre.css">
    <title>Sobre nós</title>
</head>

<body>

    <?php
    require("app/sts/Views/Base/header.php");
    ?>

    <main>
        <section class="hero">
            <p class="scroll-advice">Scroll Down</p>
            <b class="scroll-icon"><i class="fa-regular fa-hand-point-down"></i></b>
            <div class="hero__title">
                <h2>Bonne Café</h2>
                <p>Juntos a você</p>
            </div>
            <video class="hero__bg-video" autoplay loop muted>
                <source src="<?php echo IMG_PATH ?>bg-vid.mp4" type="video/mp4">
            </video>
        </section>
        <section class="presentation">
            <article class="presentation__intro">
                <h2>Sua Escolha</h2>
                <p>Garantimos os três tipos de torra perfeita para você cliente, pois aqui o café é mais que um produto,
                    é uma experiência cotidiana que aviva.</p>
            </article>
        </section>
        <section class="cafeteria">
            <div class="cafeteria__bg-gradient">
                <h2>Conforto & Proximidade</h2>
            </div>
            <article class="cafeteria__intro">
                <h2>Conforto & Proximidade</h2>
                <p>Queremos que você viva momentos felizes no Bonne Café, e por isso estamos sempre melhorando o nosso
                    ambiente. Afinal não é apenas um local de trabalho, mas também de partilha e crescimento.</p>
            </article>
        </section>
    </main>
</body>

</html>