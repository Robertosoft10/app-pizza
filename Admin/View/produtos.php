<?php
session_start();
include_once __DIR__. '/../Model/classProdutos.php';
@$produtoId = $_GET['produtoId'];
$produto = new Produto();
$produto = $produto->buscaProduto($produtoId);
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Usuário:  <?= $_SESSION['usuarioNome'];?></span>
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
                        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
                    </div>
                    <div class="row">
                        <?php if(!isset($_GET['produtoId'])){ ?>
                      <div class="col-xl-12 col-lg-7">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div
                                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold text-primary">Cadastrar Produtos</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                <?php if(isset($_SESSION['produtoOk'])){?>
                                <div class="alert alert-success" role="alert">
                                <?= $_SESSION['produtoOk'];?>
                                </div>
                                <?php unset($_SESSION['produtoOk']); } ?>
                                <!-- fim alert -->
                                  <?php if(isset($_SESSION['produtoAtualiza'])){?>
                                  <div class="alert alert-success" role="alert">
                                  <?= $_SESSION['produtoAtualiza'];?>
                                  </div>
                                  <?php unset($_SESSION['produtoAtualiza']); } ?>
                                  <!-- fim alert -->
                                  <div class="table-responsive">
                                    <form action="../Controller/criarProduto.php" method="post" enctype="multipart/form-data">
                                        <div class="form-row">
                                          <div class="form-group col-md-3">
                                            <label for="inputEmail4">Produto</label>
                                            <input type="text" class="form-control" name="produtoNome" required>
                                          </div>
                                            <div class="form-group col-md-2">
                                          <label for="inputPassword4">Tipo</label>
                                          <select type="text" class="form-control" name="produtoTipo" required>
                                            <option></option>
                                            <option>Pizza</option>
                                            <option>Refrigerante</option>
                                            <option>Suco</option>
                                          </select>
                                      </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputPassword4">Preço</label>
                                            <input type="number" class="form-control" name="produtoPreco" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="inputAddress">Descrição</label>
                                          <input type="text" class="form-control" name="produtoDescricao" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                          <label for="inputAddress2">Foto</label>
                                          <input type="file" class="form-control"  name="produtoFoto" required>
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
                                  <h6 class="m-0 font-weight-bold text-primary">Alterar dados do Produto</h6>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                  <div class="table-responsive">
                                    <form action="../Controller/atualizaProduto.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" class="form-control" name="produtoId" value="<?= $produto['produtoId'];?>">
                                        <div class="form-row">
                                          <div class="form-group col-md-3">
                                            <label for="inputEmail4">Produto</label>
                                            <input type="text" class="form-control" name="produtoNome" value="<?= $produto['produtoNome'];?>">
                                          </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputPassword4">Categria</label>
                                            <select type="text" class="form-control" name="produtoTipo">
                                              <option><?= $produto['produtoTipo'];?></option>
                                              <option>Pizza</option>
                                              <option>Refrigerante</option>
                                              <option>Suco</option>
                                            </select>
                                        </div>
                                          <div class="form-group col-md-2">
                                            <label for="inputPassword4">Preço</label>
                                            <input type="number" class="form-control" name="produtoPreco" value="<?= $produto['produtoPreco'];?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="inputAddress">Descrição</label>
                                          <input type="text" class="form-control" name="produtoDescricao" value="<?= $produto['produtoDescricao'];?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                          <label for="inputAddress2">Foto *</label>
                                          <input type="file" class="form-control"  name="produtoFoto" required>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Lista de Produtos</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Cód</th>
                                                    <th>Produto</th>
                                                    <th>Tipo</th>
                                                    <th>Preço</th>
                                                    <th>Descrição</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                              include_once __DIR__. '/../Model/classProdutos.php';
                                              $produto = new Produto();
                                              $dados = $produto->listarProdutos();
                                              foreach($dados as $produto):
                                               ?>
                                                <tr>
                                                  <td><?= $produto['produtoId'];?></td>
                                                  <td><img src="<?= "../ImagensProdutos/".$produto['produtoFoto'];?>" style="width: 80px;"><?= $produto['produtoNome'];?></td>
                                                  <td><?= $produto['produtoTipo'];?></td>
                                                  <td>R$ <?= number_format($produto['produtoPreco'], 2, ',', '.');?></td>
                                                  <td><?= $produto['produtoDescricao'];?></td>
                                                  <td class="text-right">
                                                    <a href="?produtoId=<?= $produto['produtoId'];?>" class="btn btn-warning">Editar</a>
                                                    <a href="../Controller/deleteProduto.php?produtoId=<?= $produto['produtoId'];?>" class="btn btn-danger">Excluir</a>
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
