<?php

namespace Sts\Controllers;

use Core\ConfigView;
use PDOException;
use Sts\Models\Helpers\FileHandler;
use Sts\Models\Helpers\Insert;
use Sts\Models\Helpers\Select;
use Sts\Models\Helpers\Session;

class User
{
    private ?array $data = null;

    private ?array $dataForm = null;

    public function perfil(?array $urlParameters = null): void
    {
        $session = new Session;

        $session->create();

        // var_dump($_SESSION);

        if (isset($_SESSION) && $_SESSION['user']['tipo'] == 'usuario') {
            $this->data['user'] = $_SESSION['user'];

            $loadView = new ConfigView('sts/Views/users/pfgeneral', $this->data);
            $loadView->renderView();
        } elseif (isset($_SESSION) && $_SESSION['user']['tipo'] == 'func') {
            $this->data['user'] = $_SESSION['user'];

            $loadView = new ConfigView('sts/Views/users/pfadm', $this->data);
            $loadView->renderView();
        }
    }

    public function favoritos(?array $urlParameters = null): void
    {
        $loadView = new ConfigView('sts/favoritos', $this->data);
        $loadView->renderView();
    }

    public function pagamento(?array $urlParameters = null): void
    {
        $insert = new Insert();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            if ($this->dataForm['formaPagamento'] == "pix") {
                header("location:" . DEFAULT_URL . "pagamento/pix");
            }

            $this->data['test'] = $insert->insert();
        }

        $loadView = new ConfigView('sts/Views/compra/pagamento', $this->data);
        $loadView->renderView();
    }

    public function finalizarCompras(?array $urlParameters = null): void
    {
        $loadView = new ConfigView('sts/Views/compra/compra', $this->data);
        $loadView->renderView();
    }

    public function cadastrarProdutos(?array $urlParameters = null): void
    {
        $session = new Session;
        $session->create();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            $this->dataForm['path'] = "prod/" . $this->dataForm["nome"];
            $fileName = "prod/" . $this->dataForm["nome"];
            $originalFileName = $_FILES['path']['name'];
            $tmp_path = $_FILES['path']['tmp_name'];

            $fileSystem = new FileHandler($fileName, "png", $originalFileName, $tmp_path);

            $this->data['dataForm'] = true;

            $insert = new Insert();

            try {
                $this->data['stats'][] = $fileSystem->fileUpload();
                if ($fileSystem->fileUpload() == "success") {
                    $this->data['stats'][] = $insert->insert('produtos', $this->dataForm);
                }
            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }

        }

        if (isset($_SESSION) && $_SESSION['user']['tipo'] != "usuario") {
            $loadView = new ConfigView("sts/Views/adm-pages/cad-produto", $this->data);
            $loadView->renderView();
        }
    }

    public function vendas(?array $urlParameters = null): void
    {
        $session = new Session;
        $session->create();

        $select = new Select();

        try {

            $this->data['vendas'] = $select->selectVenda();
            $this->data['vendas_item'] = $select->selectVendaItem();

        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        if (isset($_SESSION) && $_SESSION['user']['tipo'] != "usuario") {
            $loadView = new ConfigView("sts/Views/adm-pages/historico-vendas", $this->data);
            $loadView->renderView();
        }
    }

    public function logOut(?array $urlParameters = null): void
    {
        $session = new Session;
        $session->delete();

        header("location:" . DEFAULT_URL);

    }

}