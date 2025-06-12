<?php
session_start();
include_once __DIR__. '/../Model/classUsuarios.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuarioId'])){
    $usuario = new Usuario();
    $atualiza = $usuario->atualizaUsuario($_POST['usuarioId'], $_POST['usuarioNome'], $_POST['usuarioCpf'], $_POST['usuarioEmail'], $_POST['usuarioSenha']);
    $_SESSION['usuarioAtualizado'] = "Registro atualizado com sucesso!";
    header('location: ../View/usuarios.php');
}
?>
