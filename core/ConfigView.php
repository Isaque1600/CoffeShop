<?php

namespace Core;

class ConfigView
{

    /**
     * Construct para pegar o path da pagina e os dados que ele vai passar para a view 
     * @param string $name Path do arquivo
     * @param array $data Dados para a view(pagina)
     */
    public function __construct(private string $name, private array $data)
    {
        // var_dump($name);
        // var_dump($data);
    }

    /**
     * Renderiza a vizão (Carrega/Envia a view para o cliente)
     * @return void
     */
    public function renderView()
    {

        $data = $this->data;

        if (file_exists('app/' . $this->name . ".php")) {
            include("app/sts/Views/Base/header.php");
            include('app/' . $this->name . ".php");
            include("app/sts/Views/Base/footer.php");
        } else {
            die("An error occurred, please contact administrator");
        }
    }

}