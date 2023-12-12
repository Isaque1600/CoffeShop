<?php

namespace Sts\Controllers;

use Core\ConfigView;
use Sts\Models\Helpers\Insert;
use Sts\Models\Helpers\Session;
use DateTime;
use DateTimeZone;
use PDOException;
use Sts\Models\TokenGenerator;

class Pagamento
{
    private ?array $data = [];

    public function pix()
    {
        $session = new Session();
        $session->create();
        $token = new TokenGenerator();
        $token = $token->generateRandomString(6);

        $insert = new Insert();


        if (isset($_GET['pagamento']) && $_GET['pagamento'] == "approved") {

            $date = new DateTime();

            $date->setTimezone(new DateTimeZone('America/Recife'));

            $valor = 0;

            if (isset($_SESSION['user']['cart'])) {
                foreach ($_SESSION['user']['cart'] as $key => $value) {
                    $valor += ($value[0] * $value[1]);
                }
            }

            $dataInsert = array_merge(array("pessoaId" => $_SESSION['user']['pessoaId'], "valor" => $valor, "dataVenda" => $date->format("Y-m-d"), "token" => $token));

            // var_dump($this->dataForm);

            try {
                $this->data['test'] = $insert->insertVendaItem(array("venda" => $dataInsert, "venda_item" => $_SESSION['user']['cart']));

                header("location:" . DEFAULT_URL . "User/finalizarCompras?token=$token");
            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }

        }

        $loadView = new ConfigView("sts/Views/compra/qrcode", $this->data);
        $loadView->renderView();
    }

}
