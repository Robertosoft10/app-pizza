<?php
session_start();
include_once __DIR__. '/../Model/classClientes.php';
include_once __DIR__. '/../App/config.php';

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['clienteId'])){
  $clienteCodigo = $_GET['clienteId'];
  $sql = "SELECT * FROM tb_pedidos  WHERE clienteCodigo = '$clienteCodigo'";
  $busca = $conexao->query($sql);
  $venda = $busca->fetch(PDO::FETCH_ASSOC);

      $sqlCleinte = "UPDATE  tb_pedidos SET clienteCodigo=null  WHERE clienteCodigo = '$clienteCodigo'";
      $atualiza = $conexao->prepare($sqlCleinte);
      $atualiza->execute();
      if($atualiza == true){
  $clienteId = $_GET['clienteId'];
  $cliente = new Cliente();
  if($cliente->deletaCliente($clienteId)){
    $_SESSION['deleteCliente'] = "Registro excluido com sucesso!";
    header('location: ../View/clientes.php');
  }
}
}
  ?>
