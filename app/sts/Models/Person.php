<?php

namespace Sts\Models;

use PDO;

/**
 * Classe mae das pessoas do bd
 */
abstract class Person
{
    /**
     * nome
     * @var string
     */
    private string $name;
    /**
     * sobrenome
     * @var string
     */
    private string $surname;
    /**
     * tipo de usuario
     * @var string
     */
    private string $type;
    /**
     * email da pessoa
     * @var string
     */
    private string $email;
    /**
     * senha da pessoa
     * @var string
     */
    private string $passwd;
    /**
     * Comporta a conexão com o banco
     * @var 
     */
    private ?object $connect;

    /**
     * Summary of __construct
     * @param string $name
     * @param string $type
     * @param string $surname
     * @param string $email
     * @param string $passwd
     */
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

    /**
     * Summary of verifyConnect
     * @return object|null
     */
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