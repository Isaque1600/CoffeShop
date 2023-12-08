<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Sts\Models\Encryption;

class Test {
    private ?array $data = [];

    public function test(array $urlParametters) {
        $loadView = new ConfigView("sts/Views/teste", $this->data);
        $loadView->renderView();
    }

}