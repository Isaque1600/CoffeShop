<?php

namespace Sts\Controllers;

use Core\ConfigView;
use PDOException;
use Sts\Models\User;

class Home
{
    private array $data = [];
    private ?array $dataForm = null;
    private ?object $user;

    public function index()
    {
        $loadView = new ConfigView("sts/Views/Home/main", $this->data);
        $loadView->renderView();
    }

    public function login()
    {
        $loadView = new ConfigView("sts/Views/acesso/login/log", $this->data);
        $loadView->renderView();
    }

    public function cadastro()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);

        if (isset($this->dataForm['registerUser'])) {
            unset($this->dataForm['registerUser']);

            try {
                $this->user = new User($this->dataForm);
                $this->user->registerUser($this->dataForm);

            } catch (PDOException $err) {
                die("error:" . $err->getMessage());
            }

        }

        $loadView = new ConfigView("sts/Views/acesso/cadastro/cad", $this->data);
        $loadView->renderView();
    }

}