<?php
include_once __DIR__. '/../App/classConfig.php';

class Produto{
    private $conexao;
    private $tabelaProdutos = "tb_produtos";

    public function __construct(){
        $database = new Database();
        $this->conexao = $database->getConexaoDb();
    }
    public function criarProduto($produtoNome, $produtoTipo, $produtoPreco, $produtoDescricao, $produtoFoto){

      	if(isset($_FILES['produtoFoto'])){
      		$extensao = strtolower(substr($_FILES['produtoFoto']['name'], - 4));
      		$produtoFoto = sha1(time()) . $extensao;
      		$diretorio = "../ImagensProdutos/";
      		move_uploaded_file($_FILES['produtoFoto']['tmp_name'], $diretorio.$produtoFoto);

    $sql = "INSERT INTO $this->tabelaProdutos(produtoNome, produtoTipo, produtoPreco, produtoDescricao, produtoFoto)VALUES(:produtoNome, :produtoTipo, :produtoPreco, :produtoDescricao, :produtoFoto)";
    $criar = $this->conexao->prepare($sql);
    $criar->bindParam(":produtoNome", $produtoNome);
    $criar->bindParam(":produtoTipo", $produtoTipo);
    $criar->bindParam(":produtoPreco", $produtoPreco);
    $criar->bindParam(":produtoDescricao", $produtoDescricao);
    $criar->bindParam(":produtoFoto", $produtoFoto);
     if($criar->execute()){
        return true;
     }
    return false;
    }
  }

    public function listarProdutos(){
        $sql = "SELECT * FROM $this->tabelaProdutos";
        $lista = $this->conexao->prepare($sql);
        $lista->execute();
        return $lista->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscaProduto($produtoId){
        $sql = "SELECT * FROM $this->tabelaProdutos WHERE produtoId = :produtoId";
        $busca = $this->conexao->prepare($sql);
        $busca->bindParam("produtoId", $produtoId);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    public function atualizaProduto($produtoId, $produtoNome, $produtoTipo, $produtoPreco, $produtoDescricao, $produtoFoto){

      if(isset($_FILES['produtoFoto'])){
        $extensao = strtolower(substr($_FILES['produtoFoto']['name'], - 4));
        $produtoFoto = sha1(time()) . $extensao;
        $diretorio = "../ImagensProdutos/";
        move_uploaded_file($_FILES['produtoFoto']['tmp_name'], $diretorio.$produtoFoto);

        $sql = "UPDATE $this->tabelaProdutos SET produtoNome=:produtoNome, produtoTipo=:produtoTipo, produtoPreco=:produtoPreco, produtoDescricao=:produtoDescricao, produtoFoto=:produtoFoto WHERE produtoId = :produtoId";
        $atualiza = $this->conexao->prepare($sql);
        $atualiza->bindParam(":produtoId", $produtoId);
        $atualiza->bindParam(":produtoNome", $produtoNome);
        $atualiza->bindParam(":produtoTipo", $produtoTipo);
        $atualiza->bindParam(":produtoPreco", $produtoPreco);
        $atualiza->bindParam(":produtoDescricao", $produtoDescricao);
        $atualiza->bindParam(":produtoFoto", $produtoFoto);

         if($atualiza->execute()){
            return true;
         }
        return false;
        }
      }
        public function deletaProduto($produtoId){
            $sql = "DELETE FROM $this->tabelaProdutos  WHERE produtoId = :produtoId";
            $delete = $this->conexao->prepare($sql);
            $delete->bindParam(":produtoId", $produtoId);
            return $delete->execute();

        }
}
    ?>
