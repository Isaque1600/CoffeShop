<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cafeteria";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if(!$conexao){
    die("Ocorreu um erro na conexão: ".mysqli_connect_errno());
}

?>