<?php

namespace Core;

abstract class Config
{

    public function __construct()
    {
        define("DEFAULT_URL", "http://localhost/Projects-8.2/CoffeShop/");

        define("CSS_PATH", DEFAULT_URL . "assets/css/");
        define("JS_PATH", DEFAULT_URL . "assets/js/");
        define("IMG_PATH", DEFAULT_URL . "assets/images/");
    }

}