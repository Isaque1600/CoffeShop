<?php

namespace Sts\Models;

use PDO;
use PDOException;

abstract class Conn {
    protected string $dbType;
    protected string $dbHost;
    protected string $dbUser;
    protected string $dbPasswd;
    protected string $dbName;
    protected string $dbPort;
    protected object $connect;

    protected function __construct(
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

    public function connectDb(){
        try {
            $this->connect = new PDO(
                $this->dbType . ":host=". 
                $this->dbHost . ":port=". 
                $this->dbPort . ":dbname=". 
                $this->dbName, 
                $this->dbUser, 
                $this->dbPasswd
                );
            return $this->connect;  
        } catch (PDOException $err) {
            die("Um erro inesperado ocorreu" . $err);
        }
    }

}