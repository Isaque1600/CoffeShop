<?php

namespace Sts\Controllers;

use Core\ConfigView;

class Cardapio
{
    private ?array $data;

    public function index(): void
    {

        $loadView = new ConfigView('app/sts/Views/', $this->data);
        $loadView->renderView();
    }

}