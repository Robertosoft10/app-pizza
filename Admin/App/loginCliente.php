<?php
session_start();
include_once __DIR__. '/../Model/classClientes.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $cliente = new Cliente();
    if($cliente->loginCliente($_POST['clienteNome'], $_POST['clienteSenha'])){
      $_SESSION['clienteLogado'] = "Login efetuado com sucesso";
        header('location: /../app-pizza/index.php');
        exit();
    }else{
        $_SESSION['clienteLogadoErro'] = "Falha no login usuário ou senha invalido";
        header('location: /../app-pizza/index.php');
        exit();
    }
}
?>
