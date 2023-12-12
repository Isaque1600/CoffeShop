<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Sts\Models\Encryption;

class Test
{
    private ?array $data = [];

    public function test(array $urlParametters)
    {
        $encrypt = new Encryption();

        var_dump($encrypt->encrypt('caixa'));

        $loadView = new ConfigView("sts/Views/teste", $this->data);
        $loadView->renderView();
    }

}