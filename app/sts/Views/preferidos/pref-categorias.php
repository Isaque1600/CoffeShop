<?php

// var_dump($data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>pref-categorias.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <title>Selecione seus preferidos: </title>
</head>

<body>
    <?php
    include(HEADER);
    ?>
    <form action="" class="categories-container" method="POST">
    <h2>Selecione suas categorias favoritas</h2>
        <ul class="wrapper">
            <?php

            foreach ($data['categorias'] as $key => $value) {
                echo "<li class=\"category\">";
                echo " <label for=\"{$value['nome']}\">{$value['nome']}: </label>";
                echo " <input type=\"checkbox\" name=\"categorias[]\" value=\"{$value['categoriaId']}\" id=\"{$value['nome']}\" class=\"categorias\">";
                echo "</li>";
            }

            ?>
        </ul>
        <input type="submit" name="submit" value="Confirmar" class="submit-btn">
    </form>
</body>

</html>