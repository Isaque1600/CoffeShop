<?php

namespace Sts\Models\Helpers;

use Sts\Models\Conn;
use PDO;
use PDOException;

class Insert
{
    private string $table;
    private array $data;
    private string $columns;
    private string $values;
    private ?object $connect;

    public function insert(string $table, array $data): string
    {
        $this->table = $table;
        $this->data = $data;
        $this->setConnect();
        $this->formatData();

        // var_dump($this->columns);
        // var_dump($this->values);

        try {

            $query = $this->setTable();

            if ($query->execute($this->data)) {
                return "success";
            }

            return "fail";

        } catch (PDOException $err) {
            throw $err;
        }

    }

    public function insertVendaItem(?array $data)
    {
        $this->table = 'vendas';
        $this->data = $data['venda'];
        $this->setConnect();
        $this->formatData();

        try {

            $query1 = $this->setTable();

            if ($query1->execute($this->data)) {
                $venda = $this->connect->lastInsertId();

                foreach ($data['venda_item'] as $key => $value) {
                    $subtotal = ($value[0] * $value[1]);

                    $query2 = $this->connect->prepare("INSERT INTO vendas_item(vendaId, produtoId, quantidade, preco_unit, subtotal) VALUES (:vendaId, :produtoId, :quantidade, :preco_unit, :subtotal)");

                    $query2->bindParam(":vendaId", $venda, PDO::PARAM_INT);
                    $query2->bindParam(":produtoId", $value[2], PDO::PARAM_INT);
                    $query2->bindParam(":quantidade", $value[1], PDO::PARAM_STR);
                    $query2->bindParam(":preco_unit", $value[0], PDO::PARAM_STR);
                    $query2->bindParam(":subtotal", $subtotal, PDO::PARAM_STR);

                    $query2->execute();
                }
            }

            return 'success';

        } catch (PDOException $err) {
            throw $err;
        }
    }

    private function setTable(): ?object
    {

        switch ($this->table) {
            case 'pessoas':
                return $this->connect->prepare("INSERT INTO pessoas({$this->columns}) VALUES ({$this->values})");

            case 'pessoas_categoria':
                return $this->connect->prepare("INSERT INTO pessoas_categoria({$this->columns} VALUES ({$this->values}))");

            case 'produtos':
                return $this->connect->prepare("INSERT INTO produtos({$this->columns}) VALUES ({$this->values})");

            case 'produtos_categoria':
                return $this->connect->prepare("INSERT INTO produtos_categoria({$this->columns} VALUES ({$this->values})");

            case 'vendas':
                return $this->connect->prepare("INSERT INTO vendas({$this->columns}) VALUES ({$this->values})");

            case 'formaPagamento':
                return $this->connect->prepare("INSERT INTO formaPagamento({$this->columns}) VALUES({$this->values})");

            case 'ocupacoes':
                return $this->connect->prepare("INSERT INTO ocupacoes({$this->columns}) VALUES ({$this->values})");

            case 'categorias':
                return $this->connect->prepare("INSERT INTO categorias({$this->columns}) VALUES ({$this->values})");

            default:
                return null;
        }

    }

    private function formatData(): void
    {
        foreach ($this->data as $key => $value) {
            if ($value == "" || $value == " ") {
                $this->data[$key] = null;
            }
        }

        $this->columns = implode(", ", array_keys($this->data));
        $this->values = ":" . implode(", :", array_keys($this->data));
    }

    private function setConnect(): void
    {
        $connection = new Conn();
        $this->connect = $connection->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}