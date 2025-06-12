<?php
session_start();
include_once __DIR__. '/../Model/classUsuarios.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $usuario = new Usuario();
    if($usuario->login($_POST['usuarioNome'], $_POST['usuarioSenha'])){
      $_SESSION['usuarioAdminLogado'] = "Login efetuado com sucesso";
        header('location: ../View/dashboard.php');
        exit();
    }else{
        $_SESSION['loginAdminErro'] = "Falha no login usuário ou senha invalido";
        header('location: /../app-pizza/Admin/index.php');
        exit();
    }
}
?>
