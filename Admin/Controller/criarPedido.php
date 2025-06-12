<?php
session_start();
include_once '../App/config.php';
$clienteCodigo = $_POST['clienteCodigo'];
$enderecoEntrega = $_POST['enderecoEntrega'];
$formaPagamento = $_POST['formaPagamento'];
$total = $_POST['total'];
date_default_timezone_set('America/Sao_Paulo');
$dataPedido = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_pedidos(clienteCodigo, enderecoEntrega, formaPagamento, total, dataPedido)VALUES(:clienteCodigo, :enderecoEntrega, :formaPagamento, :total,  :dataPedido)";
$criar = $conexao->prepare($sql);
$criar->bindParam(":clienteCodigo", $clienteCodigo);
$criar->bindParam(":enderecoEntrega", $enderecoEntrega);
$criar->bindParam(":formaPagamento", $formaPagamento);
$criar->bindParam(":total", $total);
$criar->bindParam(":dataPedido", $dataPedido);
$criar->execute();
$pedido = $conexao->lastInsertId();

foreach ($_SESSION['carrinho'] as $produtoId => $quantia) {
$sql = "SELECT * FROM tb_produtos WHERE produtoId = '$produtoId'";
$busca = $conexao->query($sql);
$produto = $busca->fetch(PDO::FETCH_OBJ);
$subtotal = $produto->produtoPreco * $quantia;
$produto = $produtoId;
$pedidoCodigo = $pedido;
$sql = "INSERT INTO tb_produtos_pedidos(produto, quantia, subtotal, pedidoCodigo)VALUES(:produto, :quantia, :subtotal, :pedidoCodigo)";
$criar = $conexao->prepare($sql);
$criar->bindParam(":produto", $produto);
$criar->bindParam(":quantia", $quantia);
$criar->bindParam(":subtotal", $subtotal);
$criar->bindParam(":pedidoCodigo", $pedidoCodigo);
$criar->execute();
}
//header('location: /../app-pizza/fazer-pedido.php');
 ?>
 <style>
 .modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: RGB(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
background-color: #fefefe;
margin: 15% auto; /* 15% from the top and centered */
padding: 20px;
border: 1px solid #888;
width: 30%; /* Could be more or less, depending on screen size */
text-align: center;
font-size: 13pt;
}

/* The Close Button */
.close {
color: #aaa;
float: right;
font-size: 28px;
font-weight: bold;

}

.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}
#btn-venda-ok{
width: 30%;
height: 40px;
font-size: 13pt;
}
 </style>

</div>
<div id="myModal" class="modal">
<!-- Modal content -->
<div class="modal-content">
  <!--nesse evento "onclick" é onde fecho a model, deve ser colocado no X-->
  <br>
  <p>Pedido finalizado com sucesso!</p>
  <a href="/../App-pizza/fazer-pedido.php?pedido=pedido-finalizado">
  <button class="btn btn-primary" id="btn-venda-ok"><i class="fa fa-check"></i>  Ok</button></a>
</div>
</div>
 <script>
 (function() {
 // Get the modal
 setTimeout(function(){
 const modal = document.getElementById("myModal");
 modal.style.display = "block";
 }, 1000); // 2 segundos após a página estiver pronta para abrir o PopUp
 })();

 function fecharModel() {
 const modal = document.getElementById("myModal");
 modal.style.display = "none";
 }
 </script>
