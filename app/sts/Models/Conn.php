<?php

namespace Sts\Models;

use PDO;
use PDOException;

class Conn
{
    protected string|null $dbHost;
    protected string|null $dbUser;
    protected string|null $dbPasswd;
    protected string|null $dbName;
    protected string|null $dbPort;
    protected object|null $connect;

    public function connect(
        string|null $host = "localhost",
        string|null $user = "root",
        string|null $passwd = "",
        string|null $dbname = "cafeteria",
        string|null $port = "3306"
    ) {
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPasswd = $passwd;
        $this->dbName = $dbname;
        $this->dbPort = $port;

        try {
            $this->connect = new PDO("mysql:host=" . $this->dbHost . ";port=" . $this->dbPort . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPasswd);
            return $this->getConnect();
        } catch (PDOException $err) {
            die("ERROR: cannot connect with database");
        }
    }


    /**
     * @return object|null of PDO connect
     */
    public function getConnect(): object|null
    {
        return $this->connect;
    }
}

?>