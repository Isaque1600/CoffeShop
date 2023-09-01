<?php

session_start();
include_once("../Cadastro~/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$_SESSION['selectin'] = "SELECT CPF FROM Cliente WHERE Email = '$email' AND Senha = '$senha'";

$select = "SELECT * FROM Cliente WHERE Email = '$email' AND Senha = '$senha';";

$result = $conexao -> query($select);

if(mysqli_num_rows($result) < 1){
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header("Location: deuerrado.html");
    mysqli_close($conexao);
}

else{
    header("Location: deucerto.html");
    mysqli_close($conexao);
}

?>