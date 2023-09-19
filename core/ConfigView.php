<?php

namespace Core;

class ConfigView
{
    
    public function __construct(private string $name, private array $data) {
        // var_dump($name);
        // var_dump($data);
    }

    public function renderView(){
        if (file_exists('app/' . $this->name . ".php")) {
            include('app/' . $this->name . ".php");
        }else {
            die("An error occurred, please contact administrator");
        }
    }


}
