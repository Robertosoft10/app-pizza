<?php
session_start();
include_once __DIR__. '/../Model/classUsuarios.php';
@$usuarioId = $_GET['usuarioId'];
$usuario = new Usuario();
$usuario = $usuario->buscaUsuario($usuarioId);
 ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin App - pizza</title>

    <!-- Custom fonts for this template-->
    <link href="../Componentes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../Componentes/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../Componentes/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Admin <br>App - Pizza</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="produtos.php">
                    <span>Produtos</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="clientes.php">
                    <span>Clientes</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pedidos.php">
                    <span>Pedidos</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="usuarios.php">
                    <span>Usuários Sistema</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../App/backup.php">
                    <span>Backup</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Usuário: <?= $_SESSION['usuarioNome'];?> </span>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="../App/logout.php">
                              <button class="btn btn-danger">Sair </button>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
                    </div>
                    <div class="row">
                      <?php if(!isset($_GET['usuarioId'])){ ?>
                      <div class="col-xl-12 col-lg-7">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div
                                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold text-primary">Cadastrar Usuários</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                <?php if(isset($_SESSION['usuarioOk'])){?>
                                <div class="alert alert-success" role="alert">
                                <?= $_SESSION['usuarioOk'];?>
                                </div>
                                <?php unset($_SESSION['usuarioOk']); } ?>
                                <!-- fim alert -->
                                <?php if(isset($_SESSION['usuarioAtualizado'])){?>
                                <div class="alert alert-success" role="alert">
                                <?= $_SESSION['usuarioAtualizado'];?>
                                </div>
                                <?php unset($_SESSION['usuarioAtualizado']); } ?>
                                <!-- fim alert -->
                                <?php if(isset($_SESSION['deleteUsuario'])){?>
                                <div class="alert alert-success" role="alert">
                                <?= $_SESSION['deleteUsuario'];?>
                                </div>
                                <?php unset($_SESSION['deleteUsuario']); } ?>
                                <!-- fim alert -->
                                  <div class="table-responsive">
                                    <form action="../Controller/criarUsuario.php" method="post">
                                        <div class="form-row">
                                          <div class="form-group col-md-3">
                                            <label for="inputEmail4">Nome</label>
                                            <input type="text" class="form-control" name="usuarioNome" required>
                                          </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputAddress">Cpf</label>
                                            <input type="number" class="form-control" name="usuarioCpf" required>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="inputPassword4">E-mail</label>
                                            <input type="email" class="form-control" name="usuarioEmail" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                          <label for="inputAddress2">Senha</label>
                                          <input type="password" class="form-control" name="usuarioSenha" required>
                                        </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-3">Salvar</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php }else{?>
                      <div class="col-xl-12 col-lg-7">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div
                                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold text-primary">Alterar dados do  Usuário</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                  <div class="table-responsive">
                                    <form action="../Controller/atualizaUsuario.php" method="post">
                                      <input type="hidden" class="form-control" name="usuarioId" value="<?= $usuario['usuarioId'];?>">
                                        <div class="form-row">
                                          <div class="form-group col-md-3">
                                            <label for="inputEmail4">Nome</label>
                                            <input type="text" class="form-control" name="usuarioNome" value="<?= $usuario['usuarioNome'];?>">
                                          </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputAddress">Cpf</label>
                                            <input type="number" class="form-control" name="usuarioCpf" value="<?= $usuario['usuarioCpf'];?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="inputPassword4">E-mail</label>
                                            <input type="email" class="form-control" name="usuarioEmail" value="<?= $usuario['usuarioEmail'];?>">
                                        </div>

                                        <div class="form-group col-md-3">
                                          <label for="inputAddress2">Senha</label>
                                          <input type="password" class="form-control" name="usuarioSenha" required>
                                        </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-3">Alterar</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php }?>
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lista de Usuários</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Usuário</th>
                                                    <th>E-mail</th>
                                                    <th>Cpf</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                              include_once __DIR__. '/../Model/classUsuarios.php';
                                              $usuario = new Usuario();
                                              $dados = $usuario->listarUsuarios();
                                              foreach($dados as $usuario):
                                               ?>
                                                <tr>
                                                    <td><?= $usuario['usuarioId'];?></td>
                                                    <td><?= $usuario['usuarioNome'];?></td>
                                                    <td><?= $usuario['usuarioCpf'];?></td>
                                                    <td><?= $usuario['usuarioEmail'];?></td>
                                                    <td class="text-right">
                                                      <a href="?usuarioId=<?= $usuario['usuarioId'];?>" class="btn btn-warning btn-sm">Editar</a>
                                                      <a href="../Controller/deleteUsuario.php?usuarioId=<?= $usuario['usuarioId'];?>" class="btn btn-danger">Excluir</a>
                                                    </td>
                                                </tr>
                                              <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; Admin App - Pizza 2025 </span>
                                </div>
                            </div>
                        </footer>
                        <!-- End of Footer -->

                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->
                <!-- Bootstrap core JavaScript-->
                <script src="../Componentes/vendor/jquery/jquery.min.js"></script>
                <script src="../Componentes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="../Componentes/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="../Componentes/js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="../Componentes/vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../Componentes/js/demo/chart-area-demo.js"></script>
                <script src="../Componentes/js/demo/chart-pie-demo.js"></script>
                <script src="../Componentes/vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="../Componentes/vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../Componentes/js/demo/datatables-demo.js"></script>

            </body>

            </html>
