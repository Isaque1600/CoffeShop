<?php

namespace Sts\Models;

use PDO;
use PDOException;

class VerifyUser extends Person
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
     * Metodo para verificar a ocorrencia do usuario no bd
     * @param mixed $email email do usuario
     * @param mixed $senha senha do usuario
     * @return string
     */
    public function verifyUser($email, $senha): string
    {
        // instancia a classe de criptografia
        $encryption = new Encryption();

        try {
            // prepara o statement de consulta
            $userSelect = $this->connection->prepare(
                "SELECT pessoaId, email, senha, nome, sobrenome, cpf_cnpj, tipo 
                FROM pessoas 
                WHERE email=:email"
            );

            // seta o email no statement
            $userSelect->bindParam(":email", $email);

            // caso ele tenha dado certo ele verifica se a senha inserida no form esta certa e retorna sucesso
            if ($userSelect->execute()) {
                $userData = $userSelect->fetch(PDO::FETCH_ASSOC);
            }

            if ($userData !== false) {
                $userData['senha'] = $encryption->decrypt($userData['senha']);
                $verifyPass = $userData['senha'];
                if (!empty($userData) && $verifyPass == $senha) {
                    if (session_status() != PHP_SESSION_ACTIVE) {
                        session_start();
                        // var_dump($userData);

                        $_SESSION['user'] = $userData;
                        $_SESSION['user']['status'] = "active";
                        // var_dump($_SESSION);
                        return "succeed";
                    }
                }
            }

            return "fail";
        } catch (PDOException $err) {
            // Caso de algum erro no bd ele joga uma excessão 
            throw $err;
        }
    }

}