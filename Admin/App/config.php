<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_app_pizza";
try{
	$conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8","$usuario", "$senha");
}catch(PDOException $x){
	echo "Erro de conexao" . $x->getMessage();
	exit;
}
?>
