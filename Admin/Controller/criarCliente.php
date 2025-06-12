<?php
session_start();
include_once __DIR__. '/../Model/classClientes.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cliente = new Cliente();
    $cadastro = $cliente->criarCliente($_POST['clienteNome'], $_POST['clienteCelular'], $_POST['clienteEndereco'], $_POST['clienteSenha'] , $_POST['dataCadastro']);
    $_SESSION['clienteOk'] = "Cadastro realizado com sucesso!";
    header('location: /../app-pizza/index.php');
}
?>
