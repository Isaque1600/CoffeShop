<?php

namespace Core;

use ErrorException;

class ConfigController extends Config
{
    /**
     * Armazena a url
     * @var array
     */
    private array $url;
    /**
     * Armazena o controlador da url
     * @var string
     */
    private string $urlController;
    /**
     * Armazena o metodo
     * @var string
     */
    private string $urlMethod;
    /**
     * Armazena os parametros
     * @var 
     */
    private ?array $urlParameters = null;

    public function __construct()
    {
        Config::__construct();

        // Testa se a url não está vazia
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            // Se não tiver pega a url e divide
            $this->url = explode("/", filter_input(INPUT_GET, 'url', FILTER_DEFAULT));

            // Se a Controller e o Method estiver setados ele atribui as variaveis
            // de urlController e urlMethod e urlParameters
            if ((isset($this->url[0])) and (isset($this->url[1]))) {
                $this->urlController = $this->url[0];
                $this->urlMethod = (!empty($this->url[1])) ? $this->url[1] : "index";
                $this->urlParameters = filter_input_array(INPUT_GET);
                unset($this->urlParameters['url']);
            } else {
                // Caso não esteja setado ele retorna erro
                $this->urlController = "Erro";
                $this->urlMethod = "index";
            }
        } else {
            // Caso esteja vazia redireciona para a Home(index)
            $this->urlController = "Home";
            $this->urlMethod = "index";
        }

        // var_dump($this->urlParameters);
        // var_dump($this->urlController);
        // var_dump($this->urlMethod);

    }

    /**
     * Carrega a View referente a controller e o method da url
     * @return void
     */
    public function loadPage()
    {
        // Tenta chamar a classe e o metodo da url, caso não consiga ele chama a controler 404
        try {
            $classLoad = "\\Sts\Controllers\\" . ucwords($this->urlController);
            $classPage = new $classLoad();
            $classPage->{$this->urlMethod}($this->urlParameters);
            // var_dump($classPage);
        } catch (ErrorException $err) {
            $classLoad = "\\Sts\Controllers\\" . "NotFound";
            $classPage = new $classLoad();
            $classPage->index();
        }
    }
}