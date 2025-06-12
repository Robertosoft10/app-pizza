<?php
session_start();
include_once __DIR__. '/../Model/classUsuarios.php';

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['usuarioId'])){
  $usuarioId = $_GET['usuarioId'];
  $usuario = new Usuario();
  if($usuario->deletaUsuario($usuarioId)){
    $_SESSION['deleteUsuario'] = "Registro excluido com sucesso!";
    header('location: ../View/usuarios.php');
  }
}
  ?>
