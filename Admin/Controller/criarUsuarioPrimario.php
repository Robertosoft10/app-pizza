<?php
session_start();
include_once __DIR__. '/../Model/classUsuarios.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = new Usuario();
    $cadastro = $usuario->criarUsuario($_POST['usuarioNome'], $_POST['usuarioCpf'], $_POST['usuarioEmail'], $_POST['usuarioSenha']);
    $_SESSION['usuarioprimaioOk'] = "Cadastro realizado com sucesso!";
    header('location: /../App-pizza/Admin/index.php');
}
?>
