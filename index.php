<?php
 session_start();
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
            <li><a href="#index">Inicio<br></a></li>
            <li><a href="#cardapio">Cardápio</a></li>
            <li><a href="#contato">Contato</a></li>
            <?php if(isset($_SESSION['clienteId'])){?>
            <li><a href="meu-pedido.php?clienteId=<?= $_SESSION['clienteId'];?>">Meu Pedido</a></li>
            <li><a href="">Usuário: <?= $_SESSION['clienteNome'];?></a></li>
            <li><a href="perfil.php?clienteId=<?= $_SESSION['clienteId'];?>">Perfil</a></li>
            <li><a href="Admin/App/logoutCliente.php">Sair</a></li>

          <?php }else{?>
            <li><a href="#login-cadastro">Login</a></li>
          <?php }?>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-book-a-table d-none d-xl-block" href="fazer-pedido.php">Fazer Pedido</a>
      </div>
    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="index" class="hero section dark-background">

      <img src="Admin/Componentes/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">

          <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
            <?php if(isset($_SESSION['clienteOk'])) {?>
            <div class="alert alert-success" role="alert">
              <?= $_SESSION['clienteOk'];?>
            </div>
            <?php unset($_SESSION['clienteOk']); }?>
            <!-- fim alert -->
            <?php if(isset($_SESSION['clienteLogado'])) {?>
            <div class="alert alert-success" role="alert">
              <?= $_SESSION['clienteLogado'];?>
            </div>
            <?php unset($_SESSION['clienteLogado']); }?>
            <!-- fim alert -->
            <?php if(isset($_SESSION['clienteLogadoErro'])) {?>
            <div class="alert alert-danger" role="alert">
              <?= $_SESSION['clienteLogadoErro'];?>
            </div>
            <?php unset($_SESSION['clienteLogadoErro']); }?>
            <!-- fim alert -->
            <?php if(isset($_SESSION['clienteAtualizado'])) {?>
            <div class="alert alert-success" role="alert">
              <?= $_SESSION['clienteAtualizado'];?>
            </div>
            <?php unset($_SESSION['clienteAtualizado']); }?>
            <!-- fim alert -->
            <h2 data-aos="fade-up" data-aos-delay="100">Olá Bem Vindo(a)</h2>
            <p data-aos="fade-up" data-aos-delay="200">Faça seu pedido e nosso delivery entregará!</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">

              <a href="fazer-pedido.php" class="btn btn-fefault" id="btn-geral"> Fazer Pedido</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->
    <!-- Menu Section -->
    <section id="cardapio" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Cardápio</h2>
        <p>Nosso Cardápio</p>
      </div><!-- End Section Title -->

      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul class="menu-filters isotope-filters">
              <li data-filter="*" class="filter-active">Tudo</li>
              <li data-filter=".Pizza">Pizza</li>
              <li data-filter=".Suco">Sucos</li>
              <li data-filter=".Refrigerante">Refrigerantes</li>
            </ul>
          </div>
        </div><!-- Menu Filters -->

        <div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">
          <?php
          include_once __DIR__ .'/Admin/Model/classProdutos.php';
          $produto = new Produto();
          $dados = $produto->listarProdutos();
          foreach($dados as $produto):
          ?>
          <div class="col-lg-6 menu-item isotope-item <?= $produto['produtoTipo'];?>">
            <img src="<?= "Admin/ImagensProdutos/".$produto['produtoFoto'];?>" class="menu-img" alt="">
            <div class="menu-content">
              <a href=""><?= $produto['produtoNome'];?></a><span>R$ <?= number_format($produto['produtoPreco'], 2, ',', '.');?></span>
            </div>
            <div class="menu-ingredients">
          <?= $produto['produtoDescricao'];?><br>
            <a href="fazer-pedido.php?acao=produtoId&produtoId=<?= $produto['produtoId'];?>" class="btn btn-default" id="btn-geral">Pedir</a>
            </div>
          </div><!-- Menu Item -->
          <?php endforeach; ?>

        </div><!-- Menu Container -->

      </div>

    </section><!-- /Menu Section -->

    <!-- Specials Section -->
    <section id="contato" class="specials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contato</h2>
        <p>Nosso Contato</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              Celular: 99 9 9999-9999<br>
              Endereço: Rua da Programação nº 10 Centro PHP OO PDO SQL<br>
            </ul>
          </div>

        </div>
    </section><!-- /Specials Section -->
    <section id="login-cadastro" class="contact section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up" id="login-container">
        <h2>Login</h2>
        <p>Login</p>
      </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6"   id="login-container">
            <form action="Admin/App/loginCliente.php" method="post">
              <div class="row gy-4">
                <div class="col-md-12">
                  <input type="text" class="form-control" name="clienteNome" placeholder="Nome">
                </div>
                <div class="col-md-12">
                  <input type="password" class="form-control" name="clienteSenha" placeholder="Senha">
                </div>
                <div class="col-md-12 text-center">

                  <button type="submit" class="btn btn-default col-md-12" id="btn-geral">Acessar</button>
                </div>
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>
      </div>
<hr>
      <div class="container section-title" data-aos="fade-up"  id="login-container">
        <h2>Cadastro</h2>
        <p>Cadastre - se</p>
      </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6"  id="login-container">
            <form action="Admin/Controller/criarCliente.php" method="post">
              <div class="row gy-4">
                <div class="col-md-12">
                  <input type="text" name="clienteNome" class="form-control" placeholder="Nome">
                </div>
                <div class="col-md-12">
                  <input type="number" class="form-control" name="clienteCelular" placeholder="Celular">
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="clienteEndereco" placeholder="Endereço">
                </div>
                <div class="col-md-12">
                  <input type="password" class="form-control" name="clienteSenha" placeholder="Senha">
                </div>
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                $dataCadastro = date('m-d-Y H:i:s');
                ?>
                  <input type="hidden" class="form-control" name="dataCadastro" value="<?= $dataCadastro;?>">
                <div class="col-md-12 text-center">

                  <button type="submit" class="btn btn-default col-md-12" id="btn-geral">Salvar Cadastro</button>
                </div>
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

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
