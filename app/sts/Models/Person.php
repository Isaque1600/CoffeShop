<?php

namespace Sts\Models;

use PDO;

abstract class Person
{
    private string $name;
    private string $surname;
    private string $type;
    private string $email;
    private string $passwd;
    private ?object $connect;

    protected function __construct(
        string $name,
        string $type,
        string $surname,
        string $email,
        string $passwd
    ) {
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

    /** 
     * @return void set connection with database
     */
    public function setConnect(): void
    {
        $connection = new Conn;
        $this->connect = $connection->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return 
     */
    public function getConnect(): ?object
    {
        $this->setConnect();
        return $this->connect;
    }
}

?>