<?php
session_start();
// parte dos produtos
if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
  }
  if(isset($_GET['acao'])){
  // adiciona
      if($_GET['acao'] == 'produtoId'){
          $produtoId = intval($_GET['produtoId']);
          if(!isset($_SESSION['carrinho'][$produtoId])){
              $_SESSION['carrinho'][$produtoId] = 1;
          }else{
            $_SESSION['carrinho'][$produtoId] += 1;
        }
    }
     // atualiza quantia
     if($_GET['acao'] == 'atualizarQunatidade'){
        if(is_array(@$_POST['atualizar'])){
          foreach($_POST['atualizar'] as $produtoId => $quantia) {
            $produtoId = intval($produtoId);
            $quantia = intval($quantia);
            if(!empty($quantia) || $quantia <> 0){
              $_SESSION['carrinho'][$produtoId] = $quantia;
          }else{
              unset($_SESSION['carrinho'][$produtoId]);
          }
      }
  }
  }
     // deletar produto do carrinho
if($_GET['acao'] == 'deleteProduto'){
    $produtoId = intval($_GET['produtoId']);
    if(isset($_SESSION['carrinho'][$produtoId])){
      unset($_SESSION['carrinho'][$produtoId]);
  }
  }
}

if(isset($_GET['pedido'])){
    $_SESSION['carrinho'] = null;
   ?>
   <script>
    window.location.href = "fazer-pedido.php";
   </script>
   <?php
  }
?>
