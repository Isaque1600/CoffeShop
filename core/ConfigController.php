<?php

namespace Core;

use Error;

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;

    public function __construct()
    {
        Config::__construct();

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->urlArray = explode("/", $this->url);

            if ((isset($this->urlArray[0])) and (isset($this->urlArray[1]))) {
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

    }

    public function loadPage()
    {

        $classLoad = "\\Sts\Controllers\\" . ucwords($this->urlController);
        try {
            $classPage = new $classLoad();
            $classPage->index();
        } catch (Error $err) {
            $classLoad = "\\Sts\Controllers\\" . "NotFound";
            $classPage = new $classLoad();
            $classPage->index();
        }
    }

}