<?php

namespace Sts\Controllers;

use Core\ConfigView;

class Cardapio {
    private ?array $data = [];

    public function index(): void {
        $loadView = new ConfigView('sts/Views/menu/menu', $this->data);
        $loadView->renderView();
    }

}