<?php

require("Person.php");
class User extends Person
{
    private string $name;
    private string $type;
    protected array $preferencies;
    public object|string $result;
    
    public function __construct(string $preferencies = null) 
    {
        parent::__construct($this->name, $this->type);
        $this->preferencies = explode(";", $preferencies);
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
