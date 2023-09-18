<?php

require_once("Conn.php");

abstract class Person extends Conn {
    protected string|null $name;
    protected string|null $surname;
    protected string|null $type;
    protected string|null $email;
    protected string|null $passwd;
    
    protected function __construct(
        string|null $name = null,
        string|null $type = null,  
        string|null $surname = null,        
        string|null $email = null, 
        string|null $passwd = null,
        ) 
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->type = $type;
        $this->email = $email;
        $this->passwd = $passwd;
    }

    protected function verifyConnect(): object|null
    {
        return $this->connect;
    }

}

?>