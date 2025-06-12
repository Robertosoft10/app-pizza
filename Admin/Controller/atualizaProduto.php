<?php
session_start();
include_once __DIR__ .'/../Model/classProdutos.php';
include_once '../App/config.php';

$produtoId = $_POST['produtoId'];
$produtoNome = $_POST['produtoNome'];
$produtoNTipo = $_POST['produtoNTipo'];
$produtoPreco = $_POST['produtoPreco'];
$produtoDescricao = $_POST['produtoDescricao'];
$produtoFoto = $_FILES['produtoFoto'];

$sql = "SELECT * FROM tb_produtos WHERE produtoId = '$produtoId'";
$consult = $conexao->query($sql);
while($result = $consult->fetch(PDO::FETCH_ASSOC)){
	$arquivo_db = $result['produtoFoto'];
}
unlink("../ImagensProdutos/$arquivo_db");

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produtoId'])){
	$produto = new Produto();
	if($produto->atualizaProduto($_POST['produtoId'], $_POST['produtoNome'], $_POST['produtoTipo'], $_POST['produtoPreco'], $_POST['produtoDescricao'], $_FILES['produtoFoto'])){
		$_SESSION['produtoAtualiza'] = "Registro atualizado com sucesso";
	header('location: ../View/produtos.php');

	}
}
?>
