<?php

namespace Sts\Controllers;
use Core\ConfigView;

class Home
{
    private array $data;

    public function index()
    {
        // echo "Controller\Pagina Home<br>";
        $listContent = new \Sts\Models\ListHome();
        $this->data['content'] = $listContent->list();

        $loadView = new ConfigView("sts/Views/Home/ListContent", $this->data);
        // var_dump($loadView);
        $loadView->renderView();
    }

}


