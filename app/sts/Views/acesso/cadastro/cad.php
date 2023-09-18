<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>cad.css">
</head>

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
                            <h1 class="cad-card__mtitle">Cadastre-se</h1>
                            <a href="<?php echo DEFAULT_URL ?>Home/login">Já tem uma conta?</a>
                        </div>
                        <div class="cad-card__login">
                            <input class="cad-card__login-button" type="submit" name="registerUser"
                                value="Cadastrar"></input>
                        </div>
                    </header>
                    <div class="cad-card__inputs">

                        <label for="name" class="cad-card__label">Nome: </label>
                        <input id="name" name="name" type="text" class="cad-card__input" required>

                        <label for="sobrenome" class="cad-card__label">Sobrenome: </label>
                        <input id="sobrenome" name="sobrenome" type="text" class="cad-card__input" required>

                        <label for="cpf" for="" class="cad-card__label">CPF: </label>
                        <input id="cpf" name="cpf" type="number" class="cad-card__input" required>

                        <label for="email" class="cad-card__label">Email: </label>
                        <input id="email" name="email" type="email" class="cad-card__input" required>

                        <label for="pass" class="cad-card__label">Senha: </label>
                        <input id="pass" name="pass" type="password" class="cad-card__input" required>

                    </div>
                </form>
            </article>
        </section>
    </main>
</body>

</html>