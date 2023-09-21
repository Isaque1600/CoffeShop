<?php

namespace Sts\Models;

use PDO;
use PDOException;

class User extends Person
{

    private string $cpf_cnpj;
    private string $name;
    private string $surname;
    private string $email;
    private string $passwd;
    protected string $type = "usuario";
    private ?object $connection;

    public function __construct(
        array $userData
    ) {

        $this->connection = $this->getConnect();
    }

    public function registerUser($userData): bool|string|null
    {
        $encryption = new Encryption();

        try {
            $userInsert = $this->connection->prepare("INSERT INTO pessoas(
                cpf_cnpj, 
                nome, 
                sobrenome, 
                tipo, 
                email, 
                senha) VALUES(
                :cpf_cnpj,
                :name,
                :sobrenome,
                :type,
                :email,
                :pass
                )");

            $userInsert->bindParam(":cpf_cnpj", $userData['cpf']);
            $userInsert->bindParam(":name", $userData['name']);
            $userInsert->bindParam(":sobrenome", $userData['sobrenome']);
            $userInsert->bindParam(":type", $this->type);
            $userInsert->bindParam(":email", $userData['email']);
            $userInsert->bindParam(":pass", $encryption->encrypt($userData['pass']));

            if ($userInsert->execute()) {
                return "success";
            }

            return false;
        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function verifyUser($email, $senha): string|bool
    {
        $encryption = new Encryption();

        try {
            $userSelect = $this->connection->prepare(
                "SELECT email, senha, nome, sobrenome, cpf_cnpj, tipo 
                FROM pessoas 
                WHERE email=:email"
            );

            $userSelect->bindParam(":email", $email);

            if ($userSelect->execute()) {
                $userData = $userSelect->fetch(PDO::FETCH_ASSOC);

                $verifyPass = $encryption->decrypt($userData['senha']);
                if (!empty($userData) && $verifyPass = $senha) {
                    if (session_status() != PHP_SESSION_ACTIVE) {
                        session_start();
                        var_dump($userData);

                        $_SESSION['user'] = $userData;
                        $_SESSION['user']['status'] = "active";
                        // var_dump($_SESSION);
                        return "succeed";
                    }
                }

            }

            return false;
        } catch (PDOException $err) {
            throw $err;
        }
    }

}