<?php

var_dump($data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>pref-categorias.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <title>Seu produto tem(categorias): </title>
</head>

<body>
    <?php
    include(HEADER);
    ?>
    <form action="" class="categories-container" method="post">
        <ul class="wrapper">
            <h2>Categorias</h2>
            <?php

            foreach ($data['categorias'] as $key => $value) {
                echo "<li class=\"category\">";
                echo " <label for=\"{$value['nome']}\">{$value['nome']}: </label>";
                echo " <input type=\"checkbox\" name=\"categorias[]\" value=\"{$value['categoriaId']}\" id=\"{$value['nome']}\" class=\"categorias\">";
                echo "</li>";
            }

            ?>
        </ul>
        <input type="submit" value="Confirmar" class="submit-btn" name="submit">
    </form>
</body>

</html>