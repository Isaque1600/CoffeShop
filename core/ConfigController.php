<?php

namespace Core;

use Error;
use ErrorException;
use Exception;

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMethod;
    private ?string $urlParametters = null;

    public function __construct()
    {
        Config::__construct();

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->urlArray = explode("/", $this->url);

            if ((isset($this->urlArray[0])) and (isset($this->urlArray[1]))) {
                $this->urlController = $this->urlArray[0];
                $this->urlMethod = (!empty($this->urlArray[1])) ? $this->urlArray[1] : "index";
                // $this->urlParametters = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                // unset($this->urlParametters['url']);
            } else {
                $this->urlController = "Erro";
                $this->urlMethod = "index";
            }
        } else {
            $this->urlController = "Home";
            $this->urlMethod = "index";
        }

        // var_dump($this->urlParametters);
        // var_dump($this->urlController);
        // var_dump($this->urlMethod);

    }

    public function loadPage()
    {
        try {
            $classLoad = "\\Sts\Controllers\\" . ucwords($this->urlController);
            $classPage = new $classLoad();
            $classPage->{$this->urlMethod}();
            // var_dump($classPage);
        } catch (ErrorException $err) {
            $classLoad = "\\Sts\Controllers\\" . "NotFound";
            $classPage = new $classLoad();
            $classPage->index();
        }
    }

}