<?php

namespace Sts\Models\Helpers;

use Sts\Models\Conn;
use PDO;
use PDOException;

class Insert {
    private string $table;
    private array $data;
    private string $columns;
    private string $values;
    private ?object $connect;

    public function insert(string $table, array $data): string {
        $this->table = $table;
        $this->data = $data;
        $this->setConnect();
        $this->formatData();

        // var_dump($this->columns);
        // var_dump($this->values);

        try {

            $query = $this->setTable();

            if($query->execute($this->data)) {
                return "success";
            }

            return "fail";

        } catch (PDOException $err) {
            throw $err;
        }

    }

    private function setTable(): ?object {

        switch($this->table) {
            case 'pessoas':
                return $this->connect->prepare("INSERT INTO pessoas({$this->columns}) VALUES ({$this->values})");

            case 'pessoas_categoria':
                return $this->connect->prepare("INSERT INTO pessoas_categoria({$this->columns} VALUES ({$this->values}))");

            case 'produtos':
                return $this->connect->prepare("INSERT INTO produtos({$this->columns}) VALUES ({$this->values})");

            case 'produtos_categoria':
                return $this->connect->prepare("INSERT INTO produtos_categoria({$this->columns} VALUES ({$this->values})");

            case 'vendas':
                return $this->connect->prepare("INSERT INTO vendas({$this->columns}) VALUES {$this->values}");

            case 'vendas_item':
                return $this->connect->prepare("INSERT INTO vendas_item({$this->columns}) VALUES({$this->values})");

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

    private function formatData(): void {
        $this->columns = implode(", ", array_keys($this->data));
        $this->values = ":".implode(", :", array_keys($this->data));
    }

    private function setConnect(): void {
        $connection = new Conn();
        $this->connect = $connection->connect();
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}