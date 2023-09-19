<?php

$dataForm = (isset($this->data['form'])) ? $this->data['form'] : null;

if (isset($this->data['result'])) {
    if ($this->data['result'] == "succeed") {
        $result['title'] = "Cadastro realizado com sucesso!";
        $result['text'] = "Caso queira logar-se <a href=" . DEFAULT_URL . "/Home/login>clique aqui</a>";
    } elseif ($this->data['result'] == "23000") {
        $result['title'] = "Usuário já cadastrado no sistema!";
        $result['text'] = "O usuário {$dataForm['name']} já está cadastrado no sistema </br>Tente cadastrar outro usuário";
    } else {
        $result['title'] = "Error inesperado!";
        $result['text'] = "Um erro inesperado ocorreu\nCódigo do erro:{$this->data['result']}\nAnote o código do erro e contate o desenvolvedor!";
    }
}

?>
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
                        <input id="name" name="name" type="text" class="cad-card__input"
                            value="<?php echo (!empty($dataForm['name'])) ? $dataForm['name'] : "" ?>" required>

                        <label for="sobrenome" class="cad-card__label">Sobrenome: </label>
                        <input id="sobrenome" name="sobrenome" type="text" class="cad-card__input"
                            value="<?php echo (!empty($dataForm['sobrenome'])) ? $dataForm['sobrenome'] : "" ?>"
                            required>

                        <label for="cpf" for="" class="cad-card__label">CPF: </label>
                        <input id="cpf" name="cpf" type="number" class="cad-card__input"
                            value="<?php echo (!empty($dataForm['cpf'])) ? $dataForm['cpf'] : "" ?>" required>

                        <label for="email" class="cad-card__label">Email: </label>
                        <input id="email" name="email" type="email" class="cad-card__input"
                            value="<?php echo (!empty($dataForm['email'])) ? $dataForm['email'] : "" ?>" required>

                        <label for="pass" class="cad-card__label">Senha: </label>
                        <input id="pass" name="pass" type="password" class="cad-card__input"
                            value="<?php echo (!empty($dataForm['pass'])) ? $dataForm['pass'] : "" ?>" required>

                    </div>
                </form>
            </article>
            <div class="popUp" style="<?php echo (isset($this->data['result'])) ? "display:flex;" : "display:none;" ?>">
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