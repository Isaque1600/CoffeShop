<?php

namespace Sts\Controllers;

use Core\ConfigView;
use DateTime;
use DateTimeZone;
use PDO;
use PDOException;
use Sts\Models\Helpers\FileHandler;
use Sts\Models\Helpers\Insert;
use Sts\Models\Helpers\Select;
use Sts\Models\Helpers\Session;
use Sts\Models\TokenGenerator;

class User
{
    private ?array $data = null;

    private ?array $dataForm = null;

    private ?float $valor;

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
        $session = new Session;

        $session->create();

        $select = new Select();

        try {
            $pessoaCategorias = $select->selectCat('pessoa', $_SESSION['user']['pessoaId']);

            $produtos = $select->selectAll('produtos');

            foreach ($produtos as $key => $value) {
                $prodCategorias = $select->selectCat('produto', $value['produtoId']);
                $produtos[$key]['categorias'] = $prodCategorias;
            }

            foreach ($produtos as $key => $value) {
                if (!array_diff($value['categorias'], $pessoaCategorias)) {
                    unset($produtos[$key]);
                }
            }

            $produtos = array_values($produtos);

            for ($i = 0; $i < count($produtos); $i++) {
                $prevValue = count($produtos[$i]['categorias']);
                for ($j = $i + 1; $j < count($produtos); $j++) {
                    $nextValue = count($produtos[$j]['categorias']);
                    if ($prevValue < $nextValue) {
                        $helper = $produtos[$i];
                        $produtos[$i] = $produtos[$j];
                        $produtos[$j] = $helper;
                    }
                }
            }

            $this->data['produtos'] = $produtos;

        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        $loadView = new ConfigView('sts/Views/preferidos/preferidos', $this->data);
        $loadView->renderView();
    }

    public function pagamento(?array $urlParameters = null): void
    {
        $session = new Session;
        $session->create();
        $token = new TokenGenerator();
        $token = $token->generateRandomString(6);

        $valor = 0;

        if (isset($_SESSION['user']['cart'])) {
            foreach ($_SESSION['user']['cart'] as $key => $value) {
                $valor += ($value[0] * $value[1]);
            }
        }

        $this->valor = $valor;

        // var_dump($_SESSION);

        $select = new Select();
        $insert = new Insert();
        $date = new DateTime();

        $date->setTimezone(new DateTimeZone('America/Recife'));

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            if ($this->dataForm['formaPagamento'] == "pix") {
                header("location:" . DEFAULT_URL . "pagamento/pix");
                exit;
            }

            unset($this->dataForm['formaPagamento']);

            $this->dataForm = array_merge($this->dataForm, array("pessoaId" => $_SESSION['user']['pessoaId'], "valor" => $valor, "dataVenda" => $date->format("Y-m-d"), "token" => $token));

            // var_dump($this->dataForm);

            try {
                $this->data['test'] = $insert->insertVendaItem(array("venda" => $this->dataForm, "venda_item" => $_SESSION['user']['cart']));

                header("location:" . DEFAULT_URL . "User/finalizarCompras?token=$token");
            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }
        }

        try {
            $this->data['formasPagamento'] = $select->selectAll('forma_pag');
        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        $loadView = new ConfigView('sts/Views/compra/pagamento', $this->data);
        $loadView->renderView();
    }

    public function finalizarCompras(?array $urlParameters = null): void
    {
        $session = new Session();
        $session->create();

        $valor = 0;

        if (isset($_SESSION['user']['cart'])) {
            foreach ($_SESSION['user']['cart'] as $key => $value) {
                $valor += ($value[0] * $value[1]);
            }
        }

        $this->valor = $valor;

        $this->data['prod'] = (isset($_SESSION['user']['cart'])) ? $_SESSION['user']['cart'] : null;
        $this->data['token'] = (isset($urlParameters['token'])) ? $urlParameters['token'] : null;
        $this->data['valor'] = ($this->valor != 0) ? $this->valor : null;

        unset($_SESSION['user']['cart']);

        $loadView = new ConfigView('sts/Views/compra/compra', $this->data);
        $loadView->renderView();
    }

    public function cadastrarProdutos(array $urlParameters = []): void
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

            $insert = new Insert();

            try {
                $this->data['stats'][] = $fileSystem->fileUpload();
                if ($fileSystem->fileUpload() == "success") {
                    $this->data['stats'][] = $insert->insert('produtos', $this->dataForm);
                }
            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }

            if (isset($this->data['stats']) && in_array('success', $this->data['stats'])) {
                header("location:" . DEFAULT_URL . "User/produtoCategorias?nome=" . $this->dataForm['nome']);
            }

        }

        if (isset($urlParameters['result'])) {
            $this->data['stats'][] = "success";
            $this->data['stats'][] = "success";
        }

        if (isset($_SESSION) && $_SESSION['user']['tipo'] != "usuario") {
            $loadView = new ConfigView("sts/Views/adm-pages/cad-produto", $this->data);
            $loadView->renderView();
        }
    }

    public function produtoCategorias(?array $urlParameters = null)
    {
        $session = new Session();
        $session->create();

        $select = new Select();
        $insert = new Insert();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            try {
                $this->data['result'] = $insert->insertCategories('produtos', $this->dataForm['categorias'], $urlParameters['nome']);
            } catch (PDOException $err) {
                $this->data['result'] = $err->getCode();
                $this->data['err'] = $err->getMessage();
            }
        }

        try {
            $this->data['categorias'] = $select->selectAll('categorias');
        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        if (isset($this->data['result']) && $this->data['result'] == "success") {
            header("location:" . DEFAULT_URL . "User/cadastrarProdutos?result=success");
        }

        $loadView = new ConfigView("sts/Views/adm-pages/pref-categorias-cad", $this->data);
        $loadView->renderView();
    }

    public function vendas(?array $urlParameters = null): void
    {
        $session = new Session;
        $session->create();

        $select = new Select();

        try {

            $vendas = $select->selectVenda();
            $this->data['vendas_item'] = $select->selectVendaItem();

            // var_dump($select->selectId('produtos', 2));

            foreach ($vendas as $key => $value) {
                $vendas[$key]['pessoaId'] = $select->selectId('pessoas', $value['pessoaId'])['nome'];
            }

            foreach ($this->data['vendas_item'] as $key => $value) {
                $this->data['vendas_item'][$key]['produtoId'] = $select->selectId('produtos', $value['produtoId'])['nome'];
            }

            foreach ($this->data['vendas_item'] as $key => $value) {
                foreach ($vendas as $key2 => $value2) {
                    if ($value2['vendaId'] == $value['vendaId']) {
                        $this->data['vendas_item'][$key] = array_merge($value, $value2);
                    }
                }
            }

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