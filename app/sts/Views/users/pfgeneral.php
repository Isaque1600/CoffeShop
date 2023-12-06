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

  <h1>Olá, *Nome*</h1>
  <div class="user-info">
    <div class="user-data">
      <p class="data">Nome: Josivaldo</p>
      <p class="data">Sobrenome: Josivaldo</p>
      <p class="data">CPF: 123123123</p>
      <p class="data">Email: teste123@gmail.com</p>
      <p class="data">Senha: 123</p>
    </div>
    <div class="user-opt">
      <a class="favorite" href="#"><i class="fa-solid fa-star"></i> Preferidos</a>
      <a class="logout" href="<?php echo DEFAULT_URL ?>User/logOut"><i class="fa-solid fa-right-from-bracket"></i>
        LogOut</a>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/9682b31f0e.js" crossorigin="anonymous"></script>
</body>

</html>