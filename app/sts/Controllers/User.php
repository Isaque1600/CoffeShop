<?php

namespace Sts\Controllers;

use Core\ConfigView;
use PDOException;
use Sts\Models\Helpers\Insert;
use Sts\Models\Helpers\Session;

class User {
    private ?array $data = null;

    private ?array $dataForm = null;

    public function perfil(?array $urlParameters = null): void {
        $session = new Session;

        $session->create();

        // var_dump($_SESSION);

        if(isset($_SESSION) && $_SESSION['user']['tipo'] == 'usuario') {
            $loadView = new ConfigView('sts/Views/users/pfgeneral', $this->data);
            $loadView->renderView();
        } elseif(isset($_SESSION) && $_SESSION['user']['tipo'] == 'func') {
            $loadView = new ConfigView('sts/Views/users/pfadm', $this->data);
            $loadView->renderView();
        }
    }

    public function favoritos(?array $urlParameters = null): void {
        $loadView = new ConfigView('sts/favoritos', $this->data);
        $loadView->renderView();
    }

    public function cadastrarProdutos(?array $urlParameters = null): void {
        $session = new Session;
        $session->create();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            $this->data['dataForm'] = true;
            $this->dataForm['path'] = "prod/".$this->dataForm["nome"];

            // var_dump($_FILES);
            // var_dump($_SERVER['DOCUMENT_ROOT']);

            $targetDir = IMG_FLSYSTEM;
            $targetFile = $targetDir.$this->dataForm['path'].".png";
            $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $insert = new Insert();

            try {
                $this->data['stats'] = $insert->insert('produtos', $this->dataForm);
                if($this->data['stats'] == "success") {
                    if($imageType == "jpg" || $imageType == "png" || $imageType == "jpeg") {
                        if(!file_exists($targetFile)) {
                            move_uploaded_file($_FILES['path']['tmp_name'], $targetFile);
                        }
                    }
                }

            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }

        }

        if(isset($_SESSION) && $_SESSION['user']['tipo'] != "usuario") {
            $loadView = new ConfigView("sts/Views/adm-pages/cad-produto", $this->data);
            $loadView->renderView();
        }
    }

    public function vendas(?array $urlParameters = null): void {
        $session = new Session;
        $session->create();

        if(isset($_SESSION) && $_SESSION['user']['tipo'] != "usuario") {
            $loadView = new ConfigView("sts/Views/adm-pages/historico-vendas", $this->data);
            $loadView->renderView();
        }
    }

    public function logOut(?array $urlParameters = null): void {
        $session = new Session;
        $session->delete();

        header("location:".DEFAULT_URL);

    }

}