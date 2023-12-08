<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<header class="header" id="pageTop">
    <nav class="nav">
        <a href="<?php echo DEFAULT_URL ?>"><img src="<?php echo IMG_PATH ?>logo.png" alt="Logo"></a>
        <ul class="nav__menu">
            <li class="nav__item"><a href="<?php echo DEFAULT_URL ?>Cardapio/">Cardápio</a></li>
            <li class="nav__item"><a href="<?php echo DEFAULT_URL ?>Home/sobre">Sobre</a></li>
            <?php
            if(!isset($_SESSION['user'])) {
                echo "<li class=\"nav__item\"><a href=".DEFAULT_URL."Home/login>Login</a></li>";
            } else {
                echo "<li class=\"nav__item\"><a href=".DEFAULT_URL."User/perfil class=\"profile\"><span class=\"profile-box\"><i class=\"fa-solid fa-user fa-xl profile-icon\" alt=\"Profile\"></i></span></a></li>";
            }
            ?>
            <li class="nav__search">
                <label class="search-label" for="search"><i
                        class="fa-solid fa-magnifying-glass search-label-one"></i></label>
                <input class="search-input" type="text" name="search" id="search" placeholder="Pesquise">
            </li>
            <li><button class="open-cart">$</button></li>
        </ul>
        <!--
    <a href="<?php echo DEFAULT_URL ?>"><img src="<?php echo IMG_PATH ?>logo.png" alt="Home-icon"></a>
    <nav class="nav">
        <ul class="nav__menu">
            <li class="nav__item"><a href="#">Cardápio</a></li>
            <li class="nav__item"><a href="#">Preferidos</a></li>
            <li class="nav__item"><a href="#">Sobre</a></li>
            
        </ul>

            -->
    </nav>
    <a href="#pageTop" class="backToTop"><i class="fa-solid fa-up-long"></i></a>
</header>
<ul class="cart-sidebar">
    <div class="cart-title">
        <h2>Carrinho <i class="fa-solid fa-cart-shopping" style="color: #6d9891ff;"></i></h2>
        <p class="close-cart">X</p>
        <button class="buy">Comprar</button>
    </div>
    <?php

    if(isset($_SESSION['user']['cart'])) {
        foreach($_SESSION['user']['cart'] as $key => $value) {
            echo "<li class=\"cart-item\">";
            echo "<p>$key</p>";
            echo "<b>R$".$value[0]." x ".$value[1]."</b>";
            echo "<button class=\"trash\" name=\"$key\"><i class=\"fa-solid fa-trash trash-icon\"></i></button>";
            echo "</li>";
        }
    }


    ?>
</ul>