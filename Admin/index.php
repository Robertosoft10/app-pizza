<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin App - Pizza</title>

    <!-- Custom fonts for this template-->
    <link href="Componentes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="Componentes/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem Vindo(a)<br>
                                        Login</h1>
                                        <?php if(isset($_SESSION['usuarioprimaioOk'])){?>
                                        <div class="alert alert-success" role="alert">
                                        <?= $_SESSION['usuarioprimaioOk'];?>
                                        </div>
                                        <?php unset($_SESSION['usuarioprimaioOk']); } ?>
                                        <!-- fim alert -->
                                        <?php if(isset($_SESSION['loginAdminErro'])){?>
                                        <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['loginAdminErro'];?>
                                        </div>
                                        <?php unset($_SESSION['loginAdminErro']); } ?>
                                          </div>
                                    <form class="user" action="App/loginAdmin.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Usuário" name="usuarioNome">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                     placeholder="Senha"  name="usuarioSenha">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                    <a href="View/primeiro-usuario.php">Cadastrar - se</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="Componentes/vendor/jquery/jquery.min.js"></script>
    <script src="Componentes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Componentes/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Componentes/js/sb-admin-2.min.js"></script>

</body>

</html>
