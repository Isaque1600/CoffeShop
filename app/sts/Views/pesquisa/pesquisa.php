<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>pesquisa.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>menu.css">
    <title>Buscando por:
        <?php echo $data['search'] ?>
    </title>
</head>

<body>

    <?php

    include(HEADER);

    ?>

    <main>
        <section class="title">
            <div class="menu-info">
                <h1><i class="fa-solid fa-magnifying-glass"></i>
                    Buscando por:
                    <?php echo $data['search'] ?>
                </h1>
            </div>
            <!-- <div class="product-org">
                <div class="product-categories">
                    <a href="#" class="category">Cafés</a>
                    <a href="#" class="category">Massas</a>
                    <a href="#" class="category">Sobremesas</a>
                </div>
                <div class="product-filters">
                    (label+input:checkbox.filter)*
                </div>
            </div> -->
        </section>
        <section class="menu">
            <?php

            foreach($data['produtos'] as $key => $value) {
                echo "<div class=\"menu__item-container\">";
                echo " <div class=\"img-container\"><img src=\"".IMG_PATH.$value['path'].".png"."\" alt=\"\" class=\"item-img\"></div>";
                echo " <div class=\"item-details\">";
                echo " <p>".$value['nome']."</p>";
                echo " <b>R$".$value['valor']."</b>";
                echo "<div class=\"favoritar\">";
                echo "    <label for=\"favorito\">Favoritar: </label>";
                echo "    <input class=\"favorito\" type=\"checkbox\" name=\"favorito\" id=\"favorito\">";
                echo "</div>";
                echo "<div class=\"add-cart\">";
                echo "    <button type=\"button\" name=\"".$value['nome']."\" id=\"addcart\" class=\"addcart\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo " </div>";
                echo "</div>";
            }

            ?>
        </section>
    </main>
</body>

</html>