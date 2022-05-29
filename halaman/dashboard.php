<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
  echo '<script>window.location="../";</script>';
} else {
  $index = 1;
  include 'template/head.php';
  $your_id = $_SESSION['id_user'];
  $type_user = $_SESSION['type'];
  ?>

  <body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <?php include 'template/navbar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Dashboard</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>
                      <?php
                        $tampilkanBarang = "select count(*) as countBarang FROM barang WHERE status_po = 2";
                        $str = mysqli_query($conn, $tampilkanBarang);
                        while ($data = mysqli_fetch_array($str)) {
                          echo $data['countBarang'];
                        }
                        ?>
                    </h3>
                    <p>Barang</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ionic"></i>
                  </div>
                  <a href="#" class="small-box-footer"><i class="fas"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>
                      <?php
                        if ($type_user == 0 || $type_user == 1 || $type_user == 2) {
                          $tampilkanPermintaan = "select count(*) as countPermintaan FROM permintaan_barang_out";
                        } else {
                          $tampilkanPermintaan = "select count(*) as countPermintaan FROM permintaan_barang_out WHERE id_user = '$your_id'";
                        }
                        $str = mysqli_query($conn, $tampilkanPermintaan);
                        while ($data = mysqli_fetch_array($str)) {
                          echo $data['countPermintaan'];
                        }
                        ?>
                    </h3>
                    <p>Permintaan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-compose"></i>
                  </div>
                  <a href="#" class="small-box-footer"><i class="fas"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>
                      <?php
                        if ($type_user == 0 || $type_user == 1 || $type_user == 2) {
                          $tampilkanPeminjaman = "select count(*) as countPeminjaman FROM peminjaman_barang";
                        } else {
                          $tampilkanPeminjaman = "select count(*) as countPeminjaman FROM peminjaman_barang WHERE id_user = '$your_id'";
                        }
                        $str = mysqli_query($conn, $tampilkanPeminjaman);
                        while ($data = mysqli_fetch_array($str)) {
                          echo $data['countPeminjaman'];
                        }
                        ?>
                    </h3>

                    <p>Peminjaman</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-arrow-right-c"></i>
                  </div>
                  <a href="#" class="small-box-footer"><i class="fas"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      <?php
                        if ($type_user == 0 || $type_user == 1 || $type_user == 2) {
                          $tampilkanPengembalian = "select count(*) as countPengembalian FROM peminjaman_barang";
                        } else {
                          $tampilkanPengembalian = "select count(*) as countPengembalian FROM peminjaman_barang WHERE id_user = '$your_id' AND status_peminjaman = 2";
                        }
                        $str = mysqli_query($conn, $tampilkanPengembalian);
                        while ($data = mysqli_fetch_array($str)) {
                          echo $data['countPengembalian'];
                        }
                        ?>
                    </h3>

                    <p>Pengembalian</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-arrow-left-c"></i>
                  </div>
                  <a href="#" class="small-box-footer"><i class="fas"></i></a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <?php include 'template/footer.php';; ?>

      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include 'template/script.php'; ?>

    <!-- Filterizr-->
    <script src="../plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });

        $('.filter-container').filterizr({
          gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
          $('.btn[data-filter]').removeClass('active');
          $(this).addClass('active');
        });
      })
    </script>
  </body>
<?php } ?>

</html>