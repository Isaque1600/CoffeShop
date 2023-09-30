<?php

namespace Sts\Models;

use PDO;
use PDOException;

class RegisterUser extends Person
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
    public function registerUser($userData): ?string
    {
        // instancia a classe de criptografia
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
            return "fail";
        } catch (PDOException $err) {
            // Caso tenha dado algum erro com o bd ele joga uma excessão
            throw $err;
        }
    }

}