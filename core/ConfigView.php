<?php

namespace Core;

class ConfigView
{

<<<<<<< HEAD
=======
    /**
     * Construct para pegar o path da pagina e os dados que ele vai passar para a view 
     * @param string $name Path do arquivo
     * @param array $data Dados para a view(pagina)
     */
>>>>>>> ba6c5ecd38db30f2440aa73317948029c027b3d9
    public function __construct(private string $name, private array $data)
    {
        // var_dump($name);
        // var_dump($data);
    }

<<<<<<< HEAD
=======
    /**
     * Renderiza a vizão (Carrega/Envia a view para o cliente)
     * @return void
     */
>>>>>>> ba6c5ecd38db30f2440aa73317948029c027b3d9
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

<<<<<<< HEAD

=======
>>>>>>> ba6c5ecd38db30f2440aa73317948029c027b3d9
}