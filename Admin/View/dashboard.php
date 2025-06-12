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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-9 col-lg-7">
                          <?php if(isset($_SESSION['usuarioAdminLogado'])){?>
                          <div class="alert alert-success" role="alert">
                          <?= $_SESSION['usuarioAdminLogado'];?>
                          </div>
                          <?php unset($_SESSION['usuarioAdminLogado']); } ?>
                          <!-- fim alert -->
                          <?php if(isset($_SESSION['backup'])){?>
                          <div class="alert alert-success" role="alert">
                          <?= $_SESSION['backup'];?>
                          </div>
                          <?php unset($_SESSION['backup']); } ?>
                          <!-- fim alert -->
                            <div class="card shadow mb-4">


                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Vendas do Dia</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Cód</th>
                                                    <th>Data</th>
                                                    <th>Valor</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                              include_once '../App/config.php';
                                              date_default_timezone_set('America/Sao_Paulo');
                                              $dataInicio = date('Y-m-d');
                                              $dataFim  = date('Y-m-d');
                                              $sql = "SELECT * FROM tb_pedidos WHERE DATE(dataPedido) BETWEEN '$dataInicio' AND '$dataFim'";
                                              $lista = $conexao->query($sql);
                                                  while ($pedido = $lista->fetch(PDO::FETCH_ASSOC)):?>
                                                  <tr>
                                                      <td><?= $pedido['pedidoId'];?></td>
                                                      <?php $dataBrasileira = date('d/m/Y H:i:s', strtotime($pedido['dataPedido']));?>
                                                      <td><?= $dataBrasileira;?></td>
                                                      <td>R$ <?= number_format($pedido['total'], 2, ',', '.');?></td>
                                                      <td class="text-right">
                                                        <a href="detalhe-pedido.php?pedidoId=<?= $pedido['pedidoId'];?>" class="btn btn-success">Detalhes</a>
                                                      </td>
                                                  </tr>
                                                  <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-3 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Forma de Recebimento</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                  <?php
                                  // dinheiro
                                  include_once '../App/config.php';
                                  date_default_timezone_set('America/Sao_Paulo');
                                  $dataInicio = date('Y-m-d');
                                  $dataFim  = date('Y-m-d');
                                  $sql = "SELECT COUNT(formaPagamento) AS total_d FROM tb_pedidos  WHERE formaPagamento='Dinheiro' AND DATE(dataPedido) BETWEEN '$dataInicio' AND '$dataFim'";
                                  $lista = $conexao->prepare($sql);
                                  $lista->execute();

                                // Obter resultado
                                $resultado = $lista->fetch(PDO::FETCH_ASSOC);
                                $total_d = $resultado['total_d'] ?? 0;
                                ?>
                                <script>
                                var totalDinheiro = "<?php echo $total_d; ?>"
                                </script>
                                <?php
                                // Cartão
                                date_default_timezone_set('America/Sao_Paulo');
                                $dataInicio = date('Y-m-d');
                                $dataFim  = date('Y-m-d');
                                $sql = "SELECT COUNT(formaPagamento) AS total_c FROM tb_pedidos  WHERE formaPagamento='Cartão' AND DATE(dataPedido) BETWEEN '$dataInicio' AND '$dataFim'";
                                $lista = $conexao->prepare($sql);
                                $lista->execute();

                              // Obter resultado
                              $resultado = $lista->fetch(PDO::FETCH_ASSOC);
                              $total_c = $resultado['total_c'] ?? 0;
                              ?>
                              <script>
                              var totalCartao = "<?php echo $total_c; ?>"
                              </script>
                              <?php
                              // Cartão
                              date_default_timezone_set('America/Sao_Paulo');
                              $dataInicio = date('Y-m-d');
                              $dataFim  = date('Y-m-d');
                              $sql = "SELECT COUNT(formaPagamento) AS total_p FROM tb_pedidos  WHERE formaPagamento='Pix' AND DATE(dataPedido) BETWEEN '$dataInicio' AND '$dataFim'";
                              $lista = $conexao->prepare($sql);
                              $lista->execute();

                            // Obter resultado
                            $resultado = $lista->fetch(PDO::FETCH_ASSOC);
                            $total_p = $resultado['total_p'] ?? 0;
                            ?>
                            <script>
                              var totalPix = "<?php echo $total_p; ?>"
                              </script>
                                    <canvas id="graficoFormaPagamento" width="400" height="400"></canvas>
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
                <script src="../Componentes/vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="../Componentes/vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="../Componentes/js/demo/datatables-demo.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                const ctx = document.getElementById('graficoFormaPagamento').getContext('2d');
                const graficoFormaPagamento = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ['Dinheiro', 'Cartão', 'Pix'],
                    datasets: [{
                      label: 'Forma de Recebimento',
                      data: [totalDinheiro, totalCartao, totalPix],
                      backgroundColor: [
                        'rgba(70, 179, 113, 0.7)',
                        'rgba(106, 90, 205, 0.7)',
                        'rgba(255, 99, 71, 0.7)'
                      ],
                      borderColor: [
                        'rgba(70, 179, 113, 1)',
                        'rgba(106, 90, 205, 1)',
                        'rgba(255, 99, 71, 1)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true
                  }
                });
              </script>

            </body>

            </html>
