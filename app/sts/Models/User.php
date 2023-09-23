<?php

namespace Sts\Models;

use PDO;
use PDOException;

class User extends Person
{
    /**
     * So para guardar o tipo do usuario
     * @var string
     */
    protected string $type = "usuario";
    /**
     * Contem a conexão com o banco
     * @var 
     */
    private ?object $connection;

    /**
     * Serve basicamente para setar a conexão com o banco
     * Em andamento...
     * @param array $userData
     */
    public function __construct(
        array $userData
    ) {

        $this->connection = $this->getConnect();
    }

    /**
     * Metodo para registrar o usuario no ganco
     * @param mixed $userData
     * @return bool|string|null
     */
    public function registerUser($userData): bool|string|null
    {
<<<<<<< HEAD
=======
        // instancia a classe de criptografia
>>>>>>> ba6c5ecd38db30f2440aa73317948029c027b3d9
        $encryption = new Encryption();

        try {
            // prepara o statement de inserção de usuario no bd
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

            // seta os dados da statement
            $userInsert->bindParam(":cpf_cnpj", $userData['cpf']);
            $userInsert->bindParam(":name", $userData['name']);
            $userInsert->bindParam(":sobrenome", $userData['sobrenome']);
            $userInsert->bindParam(":type", $this->type);
            $userInsert->bindParam(":email", $userData['email']);
            $userInsert->bindParam(":pass", $encryption->encrypt($userData['pass']));

            // verifica se foi possivel inserir e retorna sucesso
            if ($userInsert->execute()) {
                return "success";
            }

            // se não retorna false
            return false;
        } catch (PDOException $err) {
            // Caso tenha dado algum erro com o bd ele joga uma excessão
            throw $err;
        }
    }

    /**
     * Metodo para verificar a ocorrencia do usuario no bd
     * @param mixed $email email do usuario
     * @param mixed $senha senha do usuario
     * @return string|bool
     */
    public function verifyUser($email, $senha): string|bool
    {
        // instancia a classe de criptografia
        $encryption = new Encryption();

        try {
            // prepara o statement de consulta
            $userSelect = $this->connection->prepare(
                "SELECT email, senha, nome, sobrenome, cpf_cnpj, tipo 
                FROM pessoas 
                WHERE email=:email"
            );

            // seta o email no statement
            $userSelect->bindParam(":email", $email);

            // caso ele tenha dado certo ele verifica se a senha inserida no form esta certa e retorna sucesso
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
            // Caso de algum erro no bd ele joga uma excessão 
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