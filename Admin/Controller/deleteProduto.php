<?php
session_start();
 include_once __DIR__ .'/../Model/classProdutos.php';
include_once '../App/config.php';
$produtoId = $_GET['produtoId'];

$sql = "SELECT produtoFoto FROM tb_produtos WHERE produtoId = '$produtoId'";
$busca = $conexao->query($sql);
while($arquivo = $busca->fetch(PDO::FETCH_ASSOC)){
	$arquivo_imagem = $arquivo['produtoFoto'];
	unlink("../ImagensProdutos/".$arquivo_imagem);
	if($arquivo_imagem == true){

	if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['produtoId'])){

    include_once 'conexao.php';
    $produtoCodigo = $_GET['produtoId'];
    $sql_pedido = "DELETE FROM tb_pedidos WHERE produtoCodigo = '$produtoCodigo'";
    $delete_pedido = $conexao->prepare($sql_pedido);
    $delete_pedido->execute();

	$produtoId = $_GET['produtoCodigo'];
	$produto = new Produto();
	if($produto->deletaProduto($produtoId)){
		$_SESSION['produtoDeleteado'] = "Registro escluido com sucesso";
	header('location: ../View/produtos.php');

	}
}
}

}
?>
