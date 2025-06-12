<?php
include_once 'Admin/App/carrinho.php';
 ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>App Pizzaria</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="Admin/Componentes/assets/img/favicon.png" rel="icon">
  <link href="Admin/Componentes/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Admin/Componentes/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Admin/Componentes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Admin/Componentes/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Admin/Componentes/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Admin/Componentes/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   <link href="Admin/Componentes/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- Main CSS File -->
  <link href="Admin/Componentes/assets/css/main.css" rel="stylesheet">
  <link href="Admin/Componentes/style.css" rel="stylesheet" type="text/css">
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">
    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center me-auto me-xl-0">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">App Pizzaria</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php">Inicio<br></a></li>
            <li><a href="index.php">Cardápio</a></li>
            <li><a href="index.php">Contato</a></li>
            <?php if(isset($_SESSION['clienteId'])){?>
            <li><a href="meu-pedido.php?clienteId=<?= $_SESSION['clienteId'];?>">Meu Pedido</a></li>
            <li><a href="meus-dados.php">Usuário: <?= $_SESSION['clienteNome'];?></a></li>
            <li><a href="Admin/App/logoutCliente.php">Sair</a></li>
          <?php }else{?>
            <li><a href="index.php">Login</a></li>
          <?php }?>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-book-a-table d-none d-xl-block" href="fazer-pedido.php">Fazer Pedido</a>
      </div>

    </div>

  </header>

  <main class="main">

  <br>  <br>  <br>
    <section id="cardapio" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pedido</h2>
        <p>Fazer Pedido</p>
      </div><!-- End Section Title -->

      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Preço</th>
            <th scope="col">Quantia</th>
            <th scope="col">Sub-Total</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <form  action="?acao=atualizarQunatidade" method="post">
          <?php
          if(count($_SESSION['carrinho']) == 0){
          echo '<div class="alert alert-danger" role="alert">
             Não hà produtos nesse pedido, adicione os produtos desejados
           </div>';
          }else{
           include_once __DIR__. '/Admin/App/config.php';
            $total = 0;
            foreach ($_SESSION['carrinho'] as $produtoId => $quantia) {
            $sql = "SELECT * FROM tb_produtos WHERE produtoId = '$produtoId'";
            $busca = $conexao->query($sql);
            $produto = $busca->fetch(PDO::FETCH_OBJ);
            $subtotal = $produto->produtoPreco * $quantia;
            $total += $produto->produtoPreco * $quantia;
          print('<tr>
            <td><img src="Admin/ImagensProdutos/'.$produto->produtoFoto.'" id="imagemPedido"></td>
            <td>'.$produto->produtoNome.'</td>
            <td>R$ '.number_format($produto->produtoPreco, 2, ',','.').'</td>
            <td><input class="form-control" type="number" name="atualizar['.$produtoId.']" value="'.$quantia.'" id="quantiaPedido"></td>
            <td>R$ '.number_format($subtotal, 2, ',','.').'</td>
            <td><a href="?acao=deleteProduto&produtoId='.$produtoId.'" class="btn btn-danger">Remover</a></td>
          </tr>');
        }
      }
      ?>
        </tbody>
      </table>
      <div class="col-lg-12" id="total">
        <h2>Total: R$ <?= number_format(@$total, 2, ',','.');?></h2>
        </div>
        <?php if(isset($total)){?>
        <div class="col-lg-12">
          <button class="btn btn-default" id="btn-geral">Atualizar Pedido</button>
          </form>
          <a href="index.php"> <button class="btn btn-default" id="btn-geral">Adicionar mais Produtos</button></a>
          </div>
        <?php }else{?>
          <div class="col-lg-12">
            <a href="index.php"  class="btn btn-default" id="btn-geral"> Adicionar Produto</a>
            </div>
      <?php   } ?>
          <hr>
          <?php if(isset($total)){?>
            <?php if(isset($_SESSION['clienteId'])){?>
          <div class="col-lg-6">
            <form action="Admin/Controller/criarPedido.php" method="post">
                <input type="hidden" name="clienteCodigo" class="form-control"  value="<?= $_SESSION['clienteId'];?>">
              <div class="row gy-4">
                <div class="col-md-12">
                  <input type="text" name="enderecoEntrega" class="form-control" placeholder="Endereço para entrega">
                </div>
                <div class="col-md-12">
                  <select type="text" class="form-control" name="formaPagamento">
                    <option>Forma de Pagamento</option>
                    <option>Dinheiro</option>
                    <option>Cartão</option>
                    <option>Pix</option>
                  </select>
                </div>
                  <input type="hidden" name="total" class="form-control"  value="<?= $total;?>">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-default col-md-4" id="btn-geral">Finalizar Pedido</button>
                </div>
              </div>
            </form>
          </div><!-- End Contact Form -->
        <?php }else{?>
          <div class="col-md-12">

            <a href="index.php" class="btn btn-default col-md-4" id="btn-geral">Fazer Login</a>
          </div>
        <?php } ?>
        <?php } ?>
      </div>
    </section><!-- /Menu Section -->
  </main>
  <footer id="footer" class="footer">
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">App Pizzaria</strong> <span>Todos os direitos reservados<br>
  Desenvolvedor - Robertosoft10</span></p>
      <div class="credits">
      </div>
    </div>
  </footer>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="Admin/Componentes/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Admin/Componentes/assets/vendor/php-email-form/validate.js"></script>
  <script src="Admin/Componentes/assets/vendor/aos/aos.js"></script>
  <script src="Admin/Componentes/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="Admin/Componentes/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="Admin/Componentes/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="Admin/Componentes/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <!-- Main JS File -->
  <script src="Admin/Componentes/assets/js/main.js"></script>
</body>
</html>
