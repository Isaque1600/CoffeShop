<?php

require_once("Conn.php");

class Person extends Conn
{
    
    protected string $name;
    protected string $surname;
    protected string $type;
    protected string $email;
    protected string $passwd;

    public function __construct(
        string $name,
        string $type,  
        string $surname = null,        
        string $email = null, 
        string $passwd = null,
        ) 
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->type = $type;
        $this->email = $email;
        $this->passwd = $passwd;
    }

    protected function verifyConnect(): object|string
    {
        return $this->connect;
    }

}

