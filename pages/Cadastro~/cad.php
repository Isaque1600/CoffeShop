<?php

include_once("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$num = $_POST['num'];
$rb = $_POST['rb'];
$senha = $_POST['senha'];

$sql = "INSERT INTO Cliente(CPF, NomeC, Email, Contato, ReB, Senha) 
        VALUES ($cpf, '$nome', '$email', $num, '$rb', '$senha');";

$conexaozinha = mysqli_query($conexao, $sql);

if(!$conexaozinha){
    header("Location: ../Cadastro~/naodeuprarealizar.html");
    mysqli_close($conexao);
}

else{
    header("Location: ../Cadastro~/deuprarealizar.html");
    mysqli_close($conexao);
}

?>