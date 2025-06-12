<?php
class Database{
    private $servidor = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "db_app_pizza";
    private $conexao;

    public function getConexaoDb(){
        $this->conexao = null;
        try{
            $this->conexao = new PDO("mysql:host=". $this->servidor . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $x){
            echo "Erro na conexão";
        }
        return $this->conexao;
    }
}
?>
