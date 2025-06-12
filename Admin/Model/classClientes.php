<?php
include_once __DIR__. '/../App/classConfig.php';

class Cliente{
    private $conexao;
    private $tabelaClientes = "tb_clientes";

    public function __construct(){
        $database = new Database();
        $this->conexao = $database->getConexaoDb();
    }
    public function criarCliente($clienteNome, $clienteCelular, $clienteEndereco, $clienteSenha, $dataCadastro){
    $clienteSenha = password_hash($clienteSenha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO $this->tabelaClientes (clienteNome, clienteCelular, clienteEndereco, clienteSenha, dataCadastro)VALUES(:clienteNome, :clienteCelular, :clienteEndereco, :clienteSenha, :dataCadastro)";
    $criar = $this->conexao->prepare($sql);
    $criar->bindParam(":clienteNome", $clienteNome);
    $criar->bindParam(":clienteCelular", $clienteCelular);
    $criar->bindParam(":clienteEndereco", $clienteEndereco);
    $criar->bindParam(":clienteSenha", $clienteSenha);
    $criar->bindParam(":dataCadastro", $dataCadastro);
     if($criar->execute()){
        return true;
     }
    return false;
    }
    public function loginCliente($clienteNome, $clienteSenha){
        $sql = "SELECT * FROM $this->tabelaClientes WHERE clienteNome = :clienteNome";
        $busca = $this->conexao->prepare($sql);
        $busca->bindParam(":clienteNome", $clienteNome);
        $busca->execute();

        $cliente = $busca->fetch(PDO::FETCH_ASSOC);
        if($cliente && password_verify($clienteSenha, $cliente['clienteSenha'])){
            session_start();
            $_SESSION['clienteId'] = $cliente['clienteId'];
            $_SESSION['clienteNome'] = $cliente['clienteNome'];
            $_SESSION['clienteCelular'] = $cliente['clienteCelular'];
            $_SESSION['clienteEndereco'] = $cliente['clienteEndereco'];
            $_SESSION['clienteSenha'] = $cliente['clienteSenha'];
            return true;
        }
        return false;
    }
    public function listarClientes(){
        $sql = "SELECT * FROM $this->tabelaClientes";
        $lista = $this->conexao->prepare($sql);
        $lista->execute();
        return $lista->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscaCliente($clienteId){
        $sql = "SELECT * FROM $this->tabelaClientes WHERE clienteId = :clienteId";
        $busca = $this->conexao->prepare($sql);
        $busca->bindParam("clienteId", $clienteId);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    public function atualizaClinte($clienteId, $clienteNome, $clienteCelular, $clienteEndereco, $clienteSenha){
        $clienteSenha = password_hash($clienteSenha, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->tabelaClientes SET clienteNome=:clienteNome, clienteCelular=:clienteCelular, clienteEndereco=:clienteEndereco, clienteSenha=:clienteSenha WHERE clienteId = :clienteId";
        $update = $this->conexao->prepare($sql);
        $update->bindParam(":clienteId", $clienteId);
        $update->bindParam(":clienteNome", $clienteNome);
        $update->bindParam(":clienteCelular", $clienteCelular);
        $update->bindParam(":clienteEndereco", $clienteEndereco);
        $update->bindParam(":clienteSenha", $clienteSenha);

         if($update->execute()){
            return true;
         }
        return false;
        }
        public function deletaCliente($clienteId){
            $sql = "DELETE FROM $this->tabelaClientes  WHERE clienteId = :clienteId";
            $delete = $this->conexao->prepare($sql);
            $delete->bindParam(":clienteId", $clienteId);
            return $delete->execute();

        }
}
    ?>
