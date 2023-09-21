<?php

namespace Core;

class ConfigView
{

    public function __construct(private string $name, private array $data)
    {
        // var_dump($name);
        // var_dump($data);
    }

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