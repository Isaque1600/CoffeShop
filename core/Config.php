<?php

namespace Core;

abstract class Config
{

    public function __construct()
    {

        $url = explode("/", __DIR__);
        $urlDefault = "";
        array_pop($url);
        for ($i = array_search("htdocs", $url) + 1; $i < count($url); $i++) {
            $urlDefault .= $url[$i] . "/";
        }

        define("DEFAULT_URL", "http://localhost/" . $urlDefault);

        define("CSS_PATH", DEFAULT_URL . "assets/css/");
        define("JS_PATH", DEFAULT_URL . "assets/js/");
        define("IMG_PATH", DEFAULT_URL . "assets/images/");

        define('FIRSTKEY', base64_encode('MACA'));
        define('SECONDKEY', base64_encode('MARIANO'));
        define('THIRDKEY', base64_encode('DAM'));

    }

}