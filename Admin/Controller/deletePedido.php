<?php
session_start();
include_once __DIR__. '/../App/config.php';
$pedidoCodigo = $_GET['pedidoId'];
$sqlPedido = "DELETE FROM tb_produtos_pedidos WHERE pedidoCodigo = '$pedidoCodigo'";
$deletePedido = $conexao->prepare($sqlPedido);
$deletePedido->execute();

if($deletePedido == true){
$pedidoId = $_GET['pedidoId'];
$sql = "DELETE FROM tb_pedidos WHERE pedidoId = '$pedidoId'";
$delete = $conexao->prepare($sql);
$delete->execute();
$_SESSION['pedidoExcluido'] = "Registro excluido com sucesso";
header('location: ../View/pedidos.php');
}
  ?>
