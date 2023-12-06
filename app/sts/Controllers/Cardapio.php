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

}