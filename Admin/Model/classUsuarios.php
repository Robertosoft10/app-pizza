<?php
include_once __DIR__. '/../App/classConfig.php';

class Usuario{
    private $conexao;
    private $tabelaUsuarios = "tb_usuarios";

    public function __construct(){
        $database = new Database();
        $this->conexao = $database->getConexaoDb();
    }
    public function criarUsuario($usuarioNome, $usuarioCpf, $usuarioEmail, $usuarioSenha){
    $usuarioSenha = password_hash($usuarioSenha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO $this->tabelaUsuarios(usuarioNome, usuarioCpf, usuarioEmail, usuarioSenha)VALUES(:usuarioNome, :usuarioCpf, :usuarioEmail, :usuarioSenha)";
    $criar = $this->conexao->prepare($sql);
    $criar->bindParam(":usuarioNome", $usuarioNome);
    $criar->bindParam(":usuarioCpf", $usuarioCpf);
    $criar->bindParam(":usuarioEmail", $usuarioEmail);
    $criar->bindParam(":usuarioSenha", $usuarioSenha);
     if($criar->execute()){
        return true;
     }
    return false;
    }
    public function login($usuarioNome, $usuarioSenha){
        $sql = "SELECT * FROM $this->tabelaUsuarios WHERE usuarioNome = :usuarioNome";
        $busca = $this->conexao->prepare($sql);
        $busca->bindParam(":usuarioNome", $usuarioNome);
        $busca->execute();

        $usuario = $busca->fetch(PDO::FETCH_ASSOC);
        if($usuario && password_verify($usuarioSenha, $usuario['usuarioSenha'])){
            session_start();
            $_SESSION['usuarioId'] = $usuario['usuarioId'];
            $_SESSION['usuarioNome'] = $usuario['usuarioNome'];
            $_SESSION['usuarioCpf'] = $usuario['usuarioCpf'];
            $_SESSION['usuarioEmail'] = $usuario['usuarioEmail'];
            $_SESSION['usuarioSenha'] = $usuario['usuarioSenha'];
            return true;
        }
        return false;
    }
    public function listarUsuarios(){
        $sql = "SELECT * FROM $this->tabelaUsuarios";
        $lista = $this->conexao->prepare($sql);
        $lista->execute();
        return $lista->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscaUsuario($usuarioId){
        $sql = "SELECT * FROM $this->tabelaUsuarios WHERE usuarioId = :usuarioId";
        $busca = $this->conexao->prepare($sql);
        $busca->bindParam("usuarioId", $usuarioId);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    public function atualizaUsuario($usuarioId, $usuarioNome, $usuarioCpf, $usuarioEmail, $usuarioSenha){
          $usuarioSenha = password_hash($usuarioSenha, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->tabelaUsuarios SET usuarioNome=:usuarioNome, usuarioCpf=:usuarioCpf, usuarioEmail=:usuarioEmail, usuarioSenha=:usuarioSenha WHERE usuarioId = :usuarioId";
        $update = $this->conexao->prepare($sql);
        $update->bindParam(":usuarioId", $usuarioId);
        $update->bindParam(":usuarioNome", $usuarioNome);
        $update->bindParam(":usuarioCpf", $usuarioCpf);
        $update->bindParam(":usuarioEmail", $usuarioEmail);
        $update->bindParam(":usuarioSenha", $usuarioSenha);

         if($update->execute()){
            return true;
         }
        return false;
        }
        public function deletaUsuario($usuarioId){
            $sql = "DELETE FROM $this->tabelaUsuarios  WHERE usuarioId = :usuarioId";
            $delete = $this->conexao->prepare($sql);
            $delete->bindParam(":usuarioId", $usuarioId);
            return $delete->execute();

        }
}
    ?>
