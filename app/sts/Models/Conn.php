<?php

namespace Sts\Models;

use PDO;
use PDOException;

class Conn
{
    protected ?string $dbHost;
    protected ?string $dbUser;
    protected ?string $dbPasswd;
    protected ?string $dbName;
    protected ?string $dbPort;
    protected ?object $connect;

    public function connect(
        ?string $host = "localhost",
        ?string $user = "root",
        ?string $passwd = "",
        ?string $dbname = "cafeteria",
        ?string $port = "3306"
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
     * @return ?object of PDO connect
     */
    public function getConnect(): ?object
    {
        return $this->connect;
    }
}

?>