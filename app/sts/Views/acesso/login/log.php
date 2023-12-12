<?php
// **** Pagina de login do usuario ****
$dataUser = (isset($data["form"])) ? $data["form"] : null;

if (isset($data['result']) && $data['result'] == "success") {
    $result['title'] = ($data['result'] == "success") ? "Usuario cadastrado com sucesso!" : "";
    $result['text'] = ($data['result'] == "success") ? "O usuario foi cadastrado com sucessor<br>Logue para acessar sua conta" : "";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>cad.css">
    <title>Logue</title>
</head>

<?php
require("app/sts/Views/Base/header.php");
?>

<body>
    <main>
        <section class="cad-card">
            <article class="cad-card__icon">
                <figure>
                    <img class="cad-card__img" src="<?php echo IMG_PATH ?>logo-grande.png" alt="Café">
                    <figcaption class="cad-card__legenda"></figcaption>
                </figure>
            </article>
            <article class="cad-card__content">
                <form action="" method="post">
                    <header class="cad-card__form-header">
                        <div class="cad-card__title">
                            <h1 class="cad-card__subtitle">Login</h1>
                            <a href="<?php echo DEFAULT_URL ?>Home/cadastro">Não tem conta ainda?</a>
                        </div>
                        <div class="cad-card__login">
                            <input class="cad-card__login-button" type="submit" name="request" value="Acessar"></input>
                        </div>
                    </header>
                    <div class="cad-card__inputs">

                        <div class="cad-card__input-container">
                            <label for="email" class="cad-card__label">Email: </label>
                            <input id="email" name="email" type="email" placeholder="Digite seu email"
                                class="cad-card__input" required>
                        </div>

                        <div class="cad-card__input-container">
                            <label for="pass" class="cad-card__label">Senha: </label>
                            <input id="pass" name="pass" type="password" placeholder="Digite sua senha"
                                class="cad-card__input" required>
                        </div>

                        <br>

                        <p style="color:red;">
                            <?php echo (isset($data['result']) && $data['result'] !== "success") ? $data['result'] : "" ?>
                        </p>

                    </div>
                </form>
            </article>
            <div class="popUp" style="<?php echo (isset($result)) ? "display:flex;" : "display:none;" ?>">
                <div class="popUp-content">
                    <span class="popUp-close">&times;</span>
                    <h1 class="popUp-title">
                        <?php echo $result['title']; ?>
                    </h1>
                    <p class="popUp-text">
                        <?php echo $result['text']; ?>
                    </p>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo JS_PATH ?>main.js"></script>
</body>

</html>