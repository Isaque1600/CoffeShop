<?php
// * Arquivo responsavel por receber o usuario e chamar as devidas controllers e metodos *

require("./vendor/autoload.php");

$url = new Core\ConfigController();
$url->loadPage();
