<?php

// var_dump($data);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>menu.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <title>Cardápio</title>
</head>

<body>

    <?php
    include(HEADER);
    ?>

    <main>
        <section class="title">
            <div class="menu-info">
                <h1>Cardápio</h1>
                <h2 class="category-info">Sobremesas</h2>
            </div>
            <div class="product-categories">
                <a href="#" class="category">Cafés</a>
                <a href="#" class="category">Massas</a>
                <a href="#" class="category">Sobremesas</a>
            </div>
        </section>
        <section class="menu">
            <?php

            foreach($data['produtos'] as $key => $value) {
                echo "<div class=\"menu__item-container\">";
                echo "<div class=\"img-container\"><img src=\"".IMG_PATH.$value['path'].".png"."\" alt=\"\" class=\"item-img\"></div>";
                echo "<div class=\"item-details\">";
                echo "<p>".$value['nome']."</p>";
                echo "<b>R$".$value['valor']."</b>";
                echo "</div>";
                echo "</div>";
            }

            ?>
        </section>
    </main>
</body>

</html>