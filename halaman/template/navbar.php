<?php
$sql = 'SELECT * FROM users where nama_user="' . $_SESSION['appks'] . '"';
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    // $sts = $row['status'];
    $ids = $row['id_user'];
  }
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-toggle="" href="dashboard.php">
        Selamat datang, <?php echo $_SESSION['appks']; ?>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="" data-slide="" href="logout.php" role="button">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <!-- <i class="fa fa-user brand-image"></i> -->
    <span class="brand-text font-weight-light">
      <?php
      if ($_SESSION['type'] == 0) {
        $type_sts = '<span class="right badge badge-success">Superadmin</span>';
      } elseif ($_SESSION['type'] == 1) {
        $type_sts = '<span class="right badge badge-primary">Admin Cabang</span>';
      } elseif ($_SESSION['type'] == 3) {
        $type_sts = '<span class="right badge badge-warning">pimpinan</span>';
      } else {
        $type_sts = '<span class="right badge badge-info">Gudang</span>';
      }
      ?>
      <h6 style="margin:5px"><?php echo $type_sts; ?></h6>
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <!-- <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li> -->
        <?php if ($_SESSION['type'] == 0) { ?>
          <li class="nav-header">WAREHOUSE</li>
          <li class="nav-item">
            <a href="menu-data-karyawan.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Karyawan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="menu-data-satuan-barang.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Satuan Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="menu-data-barang.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan-barang-masuk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Masuk</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan-barang-keluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($_SESSION['type'] == 1) { ?>
          <li class="nav-header">Admin Cabang</li>
          <li class="nav-item">
            <a href="menu-permintaan-brg-keluar.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Permintaan Barang Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="menu-permintaan-brg-masuk.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Permintaan Barang Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="menu-safetystok-brg.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Safety Stok
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan-barang-masuk.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Masuk</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="laporan-barang-keluar.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($_SESSION['type'] == 2) { ?>

          <li class="nav-header">Gudang</li>
          <li class="nav-item">
            <a href="menu-verifikasi-permintaan_gudang_out.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Kirim Barang
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if ($_SESSION['type'] == 3) { ?>

          <li class="nav-header">Kepala</li>
          <li class="nav-item">
            <a href="menu-verifikasi-permintaan_out.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Verifikasi Permintaan Barang Keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="menu-verifikasi-permintaan_in.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Verifikasi Permintaan Barang Masuk
              </p>
            </a>
          </li>
        <?php } ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>