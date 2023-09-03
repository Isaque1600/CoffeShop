<?php

error_reporting(E_ALL);
class Conn
{
    protected string $dbType;
    protected string $dbHost;
    protected string $dbUser;
    protected string $dbPasswd;
    protected string $dbName;
    protected string $dbPort;
    protected object $connect;

    public function __construct(
        string $db = "mysql",
        string $host = "localhost",
        string $user = "root",
        string $passwd = "",
        string $dbname = "",
        string $port = "3306"
    ) {
        $this->dbType = $db;
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPasswd = $passwd;
        $this->dbName = $dbname;
        $this->dbPort = $port;
    }

}
