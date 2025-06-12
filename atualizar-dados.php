<?php
session_start();
include_once 'Admin/Model/classClientes.php';
$clienteId = $_GET['clienteId'];
$cliente = new Cliente();
$cliente = $cliente->buscaCliente($clienteId);
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
            <li><a href="">Usuário: <?= $_SESSION['clienteNome'];?></a></li>
              <li><a href="perfil.php?clienteId=<?= $_SESSION['clienteId'];?>">Perfil</a></li>
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
    <section id="login-cadastro" class="contact section">
      <div class="container section-title" data-aos="fade-up"  id="login-container">
        <h2>Atulaiza</h2>
        <p>Atualizar Dados</p>
      </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6"  id="login-container">
            <form action="Admin/Controller/atualizaCliente.php" method="post">
                <input type="hidden" name="clienteId" class="form-control" value="<?= $cliente['clienteId'];?>">
              <div class="row gy-4">
                <div class="col-md-12">
                  <input type="text" name="clienteNome" class="form-control" value="<?= $cliente['clienteNome'];?>">
                </div>
                <div class="col-md-12">
                  <input type="number" class="form-control" name="clienteCelular" value="<?= $cliente['clienteCelular'];?>">
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="clienteEndereco" value="<?= $cliente['clienteEndereco'];?>">
                </div>
                <div class="col-md-12">
                  <input type="password" class="form-control" name="clienteSenha" placeholder="Senha atual ou nova senha" required>
                </div>
                <div class="col-md-12 text-center">

                  <button type="submit" class="btn btn-default col-md-12" id="btn-geral">Salvar Alterações</button>
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
