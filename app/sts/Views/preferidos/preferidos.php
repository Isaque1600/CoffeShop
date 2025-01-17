<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>menu.css" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css" />
  <title>Cardápio</title>
</head>

<body>

  <?php
  include(HEADER);
  ?>

  <main>
    <section class="title">
      <div class="menu-info">
        <h1 class="titulo-preferidos">Seus Preferidos</h1>
      </div>
    </section>
    <section class="menu">
      <?php

      foreach ($data['produtos'] as $key => $value) {
        echo "<div class=\"menu__item-container\">";
        echo "<div class=\"img-container\"><img src=\"" . IMG_PATH . $value['path'] . ".png" . "\" alt=\"\" class=\"item-img\"></div>";
        echo "<div class=\"item-details\">";
        echo "<p>" . $value['nome'] . "</p>";
        echo "<b>R$" . $value['valor'] . "</b>";
        echo "<div class=\"add-cart\">";
        echo "    <button type=\"button\" name=\"" . $value['nome'] . "\" id=\"addcart\" class=\"addcart\"><i class=\"fa-solid fa-cart-shopping\"></i></button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </section>
  </main>
</body>

</html>