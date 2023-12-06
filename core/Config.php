<?php

namespace Core;

abstract class Config {

    public function __construct() {

        // Gambiarra para pegar a url default de qualquer pc q ele for rodado
        $url = explode("/", __DIR__);
        $url = (count($url) < 2) ? explode("\\", __DIR__) : $url;
        $urlDefault = "";
        array_pop($url);
        for($i = array_search("htdocs", $url) + 1; $i < count($url); $i++) {
            $urlDefault .= $url[$i]."/";
        }

        // Seta a url default pra uma variavel de ambiente
        define("DEFAULT_URL", "http://localhost/".$urlDefault);

        // Seta a url default da pasta com os css pra uma variavel de ambiente
        define("CSS_PATH", DEFAULT_URL."assets/css/");
        // Seta a url default da pasta com os js pra uma variavel de ambiente
        define("JS_PATH", DEFAULT_URL."assets/js/");
        // Seta a url default da pasta com as imagens pra uma variavel de ambiente
        define("IMG_FLSYSTEM", $_SERVER['DOCUMENT_ROOT']."/".$urlDefault."assets/images/");
        define("IMG_PATH", DEFAULT_URL."assets/images/");
        // Seta o path para o header
        define("HEADER", "app/sts/Views/Base/header.php");

        define('FIRSTKEY', base64_encode('MACA'));
        define('SECONDKEY', base64_encode('MARIANO'));
        define('THIRDKEY', base64_encode('DAM'));
    }

}