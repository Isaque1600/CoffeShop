<?php

namespace Sts\Controllers;

use Core\ConfigView;

class User
{
    private ?array $data = null;

    public function perfil(?array $urlParameters = null): void
    {
        $loadView = new ConfigView('sts/perfil', $this->data);
        $loadView->renderView();
    }

    public function favoritos(?array $urlParameters = null): void
    {
        $loadView = new ConfigView('sts/favoritos', $this->data);
        $loadView->renderView();
    }

}