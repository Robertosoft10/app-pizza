<?php
session_start();
include_once __DIR__. '/../Model/classProdutos.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $produto = new Produto();
    $cadastro = $produto->criarProduto($_POST['produtoNome'], $_POST['produtoTipo'], $_POST['produtoPreco'], $_POST['produtoDescricao'], $_FILES['produtoFoto']);
    $_SESSION['produtoOk'] = "Cadastro realizado com sucesso!";
    header('location: ../View/produtos.php');
}
?>
