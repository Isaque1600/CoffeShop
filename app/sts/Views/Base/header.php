<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<header class="header" id="pageTop">
        <nav class="nav">
            <ul class="nav__menu">
                <a href="<?php echo DEFAULT_URL ?>"><img src="<?php echo IMG_PATH ?>logo.png" alt="Home-icon"></a>
                <li class="nav__item"><a href="<?php echo DEFAULT_URL ?>Home/login">Login</a></li>
                <li class="nav__item"><a href="<?php echo DEFAULT_URL ?>Home/cadastro">Cadastro</a></li>
                <li class="nav__item"><a href="#">Cardápio</a></li>
                <li class="nav__item"><a href="#">Preferidos</a></li>
                <li class="nav__item"><a href="../sobre/sobre.html">Sobre</a></li>
            </ul>
            <!--
    <a href="<?php echo DEFAULT_URL ?>"><img src="<?php echo IMG_PATH ?>logo.png" alt="Home-icon"></a>
    <nav class="nav">
        <ul class="nav__menu">
            <li class="nav__item"><a href="#">Cardápio</a></li>
            <li class="nav__item"><a href="#">Preferidos</a></li>
            <li class="nav__item"><a href="#">Sobre</a></li>
            <?php
            if (!isset($_SESSION) || $_SESSION['user']['status'] !== "active") {
                echo "<li class=\"nav__item\"><a href=" . DEFAULT_URL . "Home/login>Login</a></li>";
                echo "<li class=\"nav__item\"><a href=" . DEFAULT_URL . "Home/cadastro>Cadastro</a></li>";
            } else {
                echo "<li class=\"nav__item\"><a href=" . DEFAULT_URL . "User/perfil>Profile</a></li>";
            }
            ?>
        </ul>

            -->
    </nav>
    <a href="#pageTop" class="backToTop"><i class="fa-solid fa-up-long"></i></a>
</header>