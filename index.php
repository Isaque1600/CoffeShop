<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $url = explode("/", __DIR__);
    $urlDefault = "";
    for ($i = 4; $i < count($url) - 1; $i++) {
        $urlDefault .= $url[$i] . "/";
    }

    require("./vendor/autoload.php");

    $url = new Core\ConfigController();
    $url->loadPage();
    ?>
</body>

</html>