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
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();

            if (!empty($_SESSION) && $_SESSION['user']['status'] = "active") {
                $this->data['user'] = $_SESSION['user'];
            }
        }

        $loadView = new ConfigView("sts/Views/Home/main", $this->data);
        $loadView->renderView();
    }

    public function login()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['request'])) {
            unset($this->dataForm['request']);

            try {

                $this->user = new User($this->dataForm);
                $userData = $this->user->verifyUser($this->dataForm['email'], $this->dataForm['pass']);
                // var_dump($_SESSION);

                if (!empty($_SESSION) && $_SESSION['user']['status'] == "active") {
                    header("location:" . DEFAULT_URL);
                }

                $this->data['result'] = "Email ou Senha incorretos!";
            } catch (PDOException $err) {
                // $this->data['result'] = $err->getCode();
                $this->data['result'] = $err->getMessage();
                $this->data['form'] = $this->dataForm;
            }
        }

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

                $this->data['result'] = "succeed";
                $this->data['form']['name'] = $this->dataForm['name'];
            } catch (PDOException $err) {
                $this->data['result'] = $err->getCode();
                $this->data['form'] = $this->dataForm;
            }

        }

        $loadView = new ConfigView("sts/Views/acesso/cadastro/cad", $this->data);
        $loadView->renderView();
    }

    public function sair()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            echo "hello";

            unset($_SESSION['user']);
            session_destroy();
        }
        header("location:" . DEFAULT_URL);
    }

}