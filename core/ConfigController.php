<?php

namespace Core;

class ConfigController
{
    private ?string $url;
    private ?array $urlArray;
    private ?string $urlController;
    private ?string $urlMetodo;

    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            var_dump($this->url);
            $this->urlArray = explode("/", $this->url);
            var_dump($this->urlArray);

            if ((isset($this->urlArray))) {
                $this->urlController = $this->urlArray[0];
                $this->urlMetodo = (!empty($this->urlArray[1])) ? $this->urlArray[1] : "index";
            } else {
                $this->urlController = "erro";
                $this->urlMetodo = "index";
            }
        } else {
            $this->urlController = "home";
            $this->urlMetodo = "index";
        }

        echo "Controller: {$this->urlController} - Método: {$this->urlMetodo} <br>";
    }
}
