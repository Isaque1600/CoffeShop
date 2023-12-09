<?php

namespace Sts\Models\Helpers;

use Exception;
use PDOException;
use Sts\Models\Conn;
use PDO;

class Select
{

    private object $connect;
    private string $table;

    public function selectAll($table)
    {
        $this->setConnect();

        $this->table = $table;

        try {

            $query = $this->getTableQuery('all');

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $err) {
            throw $err;
        } catch (Exception $err) {
            throw $err;
        }

    }

    public function selectName(string $name)
    {
        $this->setConnect();

        try {
            $query = $this->connect->prepare("SELECT * FROM produtos WHERE nome LIKE :name");

            $name = "%$name%";

            $query->bindParam(":name", $name, PDO::PARAM_STR);

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function selectVenda()
    {
        $this->setConnect();

        try {
            $query = $this->connect->prepare("SELECT * FROM vendas ORDER BY vendaId");

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            throw $err;
        }
    }

    public function selectVendaItem()
    {
        $this->setConnect();

        try {
            $query = $this->connect->prepare("SELECT * FROM vendas_item ORDER BY vendaId");

            if ($query->execute()) {
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            throw $err;
        }
    }

    private function getTableQuery($type = "all")
    {

        if ($type == "all") {
            switch ($this->table) {
                case 'produtos':
                    return $this->connect->prepare("SELECT * FROM produtos ");

                case 'produtos_categorias':
                    return $this->connect->prepare("SELECT * FROM produtos_Categorias ");

                case 'pessoas':
                    return $this->connect->prepare("SELECT * FROM pessoas ");

                case 'pessoas_favoritos':
                    return $this->connect->prepare("SELECT * FROM pessoas_Favoritos ");

                case 'categorias':
                    return $this->connect->prepare("SELECT * FROM categorias ");

                case 'ocupacoes':
                    return $this->connect->prepare("SELECT * FROM ocupacoes ");

                case 'vendas':
                    return $this->connect->prepare("SELECT * FROM vendas ");

                case 'forma_pag':
                    return $this->connect->prepare("SELECT * FROM formaPagamento ");
            }
        }
        // Consertar essa parte
        // else {

        //     switch($this->table) {
        //         case 'produtos':
        //             return $this->connect->prepare("SELECT * FROM produtos WHERE produtoId = :id");

        //         case 'produtos_categorias':
        //             return $this->connect->prepare("SELECT * FROM produtos_Categorias WHERE produtoId = :id");

        //         case 'pessoas':
        //             return $this->connect->prepare("SELECT * FROM pessoas WHERE pessoaId = :id");

        //         case 'pessoas_favoritos':
        //             return $this->connect->prepare("SELECT * FROM pessoas_Favoritos WHERE pessoaId = :id");

        //         case 'categorias':
        //             return $this->connect->prepare("SELECT * FROM categorias WHERE categoriaId = :id");

        //         case 'ocupacoes':
        //             return $this->connect->prepare("SELECT * FROM ocupacoes WHERE ocupacaoId = :id");

        //         case 'vendas':
        //             return $this->connect->prepare("SELECT * FROM vendas WHERE vendaId = :id");

        //         case 'forma_pag':
        //             return $this->connect->prepare("SELECT * FROM formaPagamento WHERE id = :id");

        //     }

        // }

    }

    private function setConnect()
    {
        $connect = new Conn;
        $this->connect = $connect->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}
