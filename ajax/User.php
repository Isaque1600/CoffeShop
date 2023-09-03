<?php
error_reporting(E_ALL);
ini_set("display_errors", "on");

require("Person.php");

class User extends Person
{
    protected ?string $type;
    protected ?array $preferencies;
    public object|string|null $result;
    
    public function __construct(?string $preferencies = "", ?string $name = null) 
    {
        $this->preferencies = explode(";", $preferencies);
        parent::__construct(name:$name);
    }

    public function listUserPreferencies() : array
    {
        return $this->preferencies;
    }

    public function showObject() : object
    {
        return $this;
    }

    public function listUsersData() : string|object|array
    {
        return "empty";
    }

}
