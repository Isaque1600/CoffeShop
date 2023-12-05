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

}