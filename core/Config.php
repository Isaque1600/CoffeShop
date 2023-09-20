<?php

namespace Core;

abstract class Config
{

    public function __construct()
    {
        $url = explode("/", __DIR__);
        $urlDefault = "";
        for ($i = 4; $i < count($url) - 1; $i++) {
            $urlDefault .= $url[$i] . "/";
        }

        define("DEFAULT_URL", "http://localhost/" . $urlDefault);

        define("CSS_PATH", DEFAULT_URL . "assets/css/");
        define("JS_PATH", DEFAULT_URL . "assets/js/");
        define("IMG_PATH", DEFAULT_URL . "assets/images/");

    }

}