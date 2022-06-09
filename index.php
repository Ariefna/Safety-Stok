<!DOCTYPE html>
<html>
<?php include 'template/head.php'; ?>
<?php
error_reporting(0);
//Remove Otomatis Data Safety Stok Ketika Berbeda Bulan
date_default_timezone_set('Asia/Jakarta');
$date_now = date('Y-m');

$cekdatesty = "SELECT date_sty FROM safety_stok";
$cekquedata = mysqli_query($conn, $cekdatesty);
$data_delete_sty = mysqli_fetch_array($cekquedata);

$datenya_ = $data_delete_sty['date_sty'];
$sub_data = substr($datenya_, 0, -3);

if ($date_now != $sub_data) {
  $removeSty = "DELETE FROM safety_stok";
  $queRemove = mysqli_query($conn, $removeSty);
}

?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="assets/logo.png" style="width:290px;margin-top:-70px" alt=""><br>
      <!-- <b>PT. INDONESIA BERKAH MANDIRI</b> -->
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h3 class="login-box-msg">Login</h3><br>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>
    <?php

    // AKSES PENGGUNA / type_user
    // 0 = Superadmin
    // 1 = Admin Cabang
    // 2 = gudang
    // 3 = pimpinan

    if (isset($_POST['login'])) {
      $pwku = htmlentities(md5($_POST['password']));
      $usss = htmlentities(md5($_POST['username']));
      $username = mysqli_real_escape_string($conn, $usss);
      $password = mysqli_real_escape_string($conn, $pwku);
      $sql = "SELECT * FROM users WHERE md5(username)='$username' && password='$password'";
      $query = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($query);
      if ($num == 1) {
        $row = mysqli_fetch_array($query);
        $_SESSION['appks'] = $row['nama_user'];
        $_SESSION['type'] = $row['type_user'];
        $_SESSION['id_user'] = $row['id_user'];

        if ($_SESSION['type'] == 0) {
          echo "<script>alert('Selamat datang kembali, " . $_SESSION['appks'] . "');document.location = 'halaman/menu-data-karyawan.php';</script>";
        } elseif ($_SESSION['type'] == 1) {
          echo "<script>alert('Selamat datang kembali, " . $_SESSION['appks'] . "');document.location = 'halaman/menu-permintaan-brg-keluar.php';</script>";
        } elseif ($_SESSION['type'] == 2) {
          echo "<script>alert('Selamat datang kembali, " . $_SESSION['appks'] . "');document.location = 'halaman/menu-verifikasi-permintaan_gudang_in.php';</script>";
        } else {
          echo "<script>alert('Selamat datang kembali, " . $_SESSION['appks'] . "');document.location = 'halaman/menu-verifikasi-permintaan_out.php';</script>";
        }
      } else {
        echo '<script type="text/javascript">
    toastr.error("Username atau password yang Anda masukan salah.");
    </script>';
      }
    }
    ?>

</body>

</html>