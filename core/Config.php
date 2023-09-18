<?php

namespace Core;

abstract class Config
{

    public function __construct()
    {
        define("DEFAULT_URL", "http://localhost/Projects-8.2/CoffeShop/");

        define("CSS_PATH", "http://localhost/Projects-8.2/CoffeShop/assets/css/");
        define("JS_PATH", "http://localhost/Projects-8.2/CoffeShop/assets/js/");
        define("IMG_PATH", "http://localhost/Projects-8.2/CoffeShop/assets/imgs/");
    }

}