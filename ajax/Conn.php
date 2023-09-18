<?php

abstract class Conn {
    protected string|null $dbType;
    protected string|null $dbHost;
    protected string|null $dbUser;
    protected string|null $dbPasswd;
    protected string|null $dbName;
    protected string|null $dbPort;
    protected object|null $connect;

    protected function __construct(
        string|null $db = "mysql",
        string|null $host = "localhost",
        string|null $user = "root",
        string|null $passwd = "",
        string|null $dbname = "",
        string|null $port = "3306"
    ) {
        $this->dbType = $db;
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPasswd = $passwd;
        $this->dbName = $dbname;
        $this->dbPort = $port;
    }

}

?>