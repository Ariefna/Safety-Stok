<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 200;
    include 'template/head.php';
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
                                <h1>Data Master Karyawan</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item active">Data Master Karyawan</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a href="tambah-data-karyawan.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Tambah Pengguna</button></a>
                                <br><br>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Lengkap</center>
                                                    </th>
                                                    <th>
                                                        <center>Alamat</center>
                                                    </th>
                                                    <th>
                                                        <center>Telepon</center>
                                                    </th>
                                                    <th>
                                                        <center>Email</center>
                                                    </th>
                                                    <th>
                                                        <center>Jabatan</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Ubah</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Hapus</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = 'SELECT * FROM users';
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                        if ($row['type_user'] == 0) {
                                                            $type_sts = '<span class="right badge badge-success">Superadmin</span>';
                                                        } elseif ($row['type_user'] == 1) {
                                                            $type_sts = '<span class="right badge badge-primary">Admin Cabang</span>';
                                                        } elseif ($row['type_user'] == 2) {
                                                            $type_sts = '<span class="right badge badge-info">Gudang</span>';
                                                        } else {
                                                            $type_sts = '<span class="right badge badge-warning">Pimpinan Gudang</span>';
                                                        }

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['nama_user'] . '</td>
                                                            <td align="">' . $row['alamat_user'] . '</td>
                                                            <td align="">' . $row['telepon_user'] . '</td>
                                                            <td align="">' . $row['email_user'] . '</td>
                                                            <td align="">' . $type_sts . '</td>
                                                            <td align="center" style="">
                                                                <form class="" action="tambah-data-karyawan.php" method="GET">
                                                                    <input type="text" name="ubah" value="' . md5($row['id_user']) . '" hidden>
                                                                    <button class="btn btn-primary btn-sm" type="submit" name=""><i class="fa fa-edit"></i></button>
                                                                </form>
                                                            </td>
                                                            <td align="center" style="">
                                                                <form class="" action="config/add-data-karyawan.php" method="GET">
                                                                <input type="text" name="delete" value="' . md5($row['id_user']) . '" hidden>
                                                                <button class="btn btn-danger btn-sm" type="submit" name=""><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td></tr>
                                                            ';
                                                    }
                                                } else {
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
        <?php include 'template/script.php';
        if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete'])) {
            if ($_GET['tambah'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Karyawan berhasil ditambahkan.");
                    </script>
                    ';
            } elseif ($_GET['edit'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Karyawan berhasil diubah.");
                    </script>
                    ';
            } elseif ($_GET['delete'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Karyawan berhasil dihapus.");
                    </script>
                    ';
            } else {
                echo '
                    <script type="text/javascript">
                    toastr.error("Permintaan Anda gagal diproses.");
                    </script>
                    ';
            }
        } ?>
    </body>
<?php } ?>

</html>
