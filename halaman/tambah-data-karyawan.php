<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['ubah'])) {
                $sql = 'SELECT * FROM users WHERE md5(id_user)="' . $_GET['ubah'] . '"';
                $i = 1;
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id_user        = $row['id_user'];
                        $nama_user      = $row['nama_user'];
                        $alamat_user    = $row['alamat_user'];
                        $telepon_user   = $row['telepon_user'];
                        $email_user     = $row['email_user'];
                        $username       = $row['username'];
                        $password       = $row['password'];
                        $type_user      = $row['type_user'];
                    }
                } else {
                }
            } else {

                $id_user        = 0;
                $nama_user      = "";
                $alamat_user    = "";
                $telepon_user   = "";
                $email_user     = "";
                $username       = "";
                $password       = "";
                $type_user      = "";
            }
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Tambah Data Karyawan</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item"><a href="menu-data-karyawan.php">Data Karyawan</a></li>
                                    <li class="breadcrumb-item active">Tambah Data Karyawan</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <form class="" action="config/add-data-karyawan.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="ID USER .." name="id_user" value="<?php echo $id_user; ?>" hidden required>
                                                    <input type="text" class="form-control" id="" placeholder="Masukkan Nama Lengkap .." name="nama_user" value="<?php echo $nama_user; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="Masukkan Alamat Lengkap .." name="alamat_user" value="<?php echo $alamat_user; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">No. Telepon</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="Masukkan Nomor Telepon .." name="telepon_user" value="<?php echo $telepon_user; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Alamat Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="" placeholder="Masukkan Alamat Email .." name="email_user" value="<?php echo $email_user; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="Masukkan Username .." name="username" value="<?php echo $username; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="" placeholder="Masukkan Password .." name="password">
                                                    <?php if ($password != '') { ?>
                                                        <label for="" class="col-sm-10 col-form-label">* Jangan diisi jika tidak ingin mengganti password</label>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <!-- select -->
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Jabatan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="type_user">
                                                        <option value="" selected disabled>- Pilih Jabatan -</option>
                                                        <option value="0" <?php echo $type_user == 0 ? "selected='selected'" : ""; ?>>Superadmin</option>
                                                        <option value="1" <?php echo $type_user == 1 ? "selected='selected'" : ""; ?>>Admin Cabang</option>
                                                        <option value="2" <?php echo $type_user == 2 ? "selected='selected'" : ""; ?>>Gudang</option>
                                                        <option value="3" <?php echo $type_user == 3 ? "selected='selected'" : ""; ?>>Pimpinan</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                        </div>
                                    </form>

                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. container-fluid -->
                </section>

                <!-- Main content -->

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include 'template/footer.php';; ?>

            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php include 'template/script.php'; ?>

    </body>
<?php } ?>

</html>