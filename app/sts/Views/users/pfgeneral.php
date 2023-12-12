<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css" />
  <link rel="stylesheet" href="<?php echo CSS_PATH ?>profile.css" />
  <title>Perfil</title>
</head>

<body>

  <?php

  include(HEADER);

  ?>

  <h1>Olá,
    <?php echo $data['user']['nome'] ?>
  </h1>
  <div class="user-info">
    <div class="user-data">
      <?php
      use Sts\Models\Encryption;

      $encryption = new Encryption();
      // var_dump($_SESSION);
      echo "<p class=\"data\">Nome:" . $data['user']['nome'] . "</p>";
      echo "<p class=\"data\">Sobrenome: Josivelha</p>";
      echo "<p class=\"data\">CPF: 1231231234</p>";
      echo "<p class=\"data\">Email:" . $data['user']['email'] . "</p>";
      echo "<p class=\"data\">Senha:" . $data['user']['senha'] . "</p>";
      ?>
    </div>
    <div class="user-opt">
      <a class="favorite" href="<?php echo DEFAULT_URL ?>User/favoritos"><i class="fa-solid fa-star"></i> Preferidos</a>
      <a class="logout" href="<?php echo DEFAULT_URL ?>User/logOut"><i class="fa-solid fa-right-from-bracket"></i>
        LogOut</a>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/9682b31f0e.js" crossorigin="anonymous"></script>
</body>

</html>