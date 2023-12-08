<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Exception;
use PDOException;
use Sts\Models\Helpers\Select;
use Sts\Models\Helpers\Session;

class Cardapio {
    private ?array $data = [];

    public function index(): void {
        $session = new Session;
        $select = new Select();

        $session->create();

        try {
            $this->data['produtos'] = $select->selectAll("produtos");
        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        } catch (Exception $err) {
            $this->data['err'] = $err->getMessage();
        }

        $loadView = new ConfigView('sts/Views/menu/menu', $this->data);
        $loadView->renderView();
    }

    public function pesquisar($urlParameters = []): void {
        $session = new Session;
        $select = new Select();

        $session->create();

        try {
            if(!empty($urlParameters['search'])) {
                $this->data['produtos'] = $select->selectName($urlParameters['search']);
                $this->data['search'] = $urlParameters['search'];
            } else {
                $this->data['produtos'] = $select->selectAll("produtos");
                $this->data['search'] = "";
            }
        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        $loadView = new ConfigView('sts/Views/pesquisa/pesquisa', $this->data);
        $loadView->renderView();
    }

    public function addcart($urlParameters = []) {
        $session = new Session;
        $select = new Select();

        $session->create();

        $ob = $select->selectName($urlParameters['name'])[0];

        // var_dump($ob);
        // var_dump($_SESSION['user']['cart']);

        if(isset($_SESSION['user']['cart']) && in_array($urlParameters['name'], array_keys($_SESSION['user']['cart']))) {
            $_SESSION['user']['cart'][$urlParameters['name']][1] += 1;
        } else {
            $_SESSION['user']['cart'][$ob['nome']] = [$ob['valor'], 1];
        }

        header("location:".DEFAULT_URL."Cardapio/");

    }

    public function removecart($urlParameters = []) {
        $session = new Session;

        $session->create();

        if(isset($_SESSION['user']['cart']) && in_array($urlParameters['name'], array_keys($_SESSION['user']['cart']))) {
            unset($_SESSION['user']['cart'][$urlParameters['name']]);
        }

        header("location:".DEFAULT_URL."Cardapio/");

    }

}