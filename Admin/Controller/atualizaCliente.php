<?php
session_start();
include_once __DIR__. '/../Model/classClientes.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clienteId'])){
    $cliente = new Cliente();
    $atualiza = $cliente->atualizaClinte($_POST['clienteId'], $_POST['clienteNome'], $_POST['clienteCelular'], $_POST['clienteEndereco'], $_POST['clienteSenha']);
    $_SESSION['clienteAtualizado'] = "Registro atualizado com sucesso!";
    header('location: /../App-pizza/index.php');
}
?>
