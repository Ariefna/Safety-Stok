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
                                <h1>Verifikasi Restok Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Verifikasi Restok Barang</li>
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
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>No Seri</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Stok</center>
                                                    </th>
                                                    <th>
                                                        <center>Restok</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Status Restok</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Opsi</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = 'SELECT a.*, b.no_serial, b.nama_barang, b.jumlah_barang, c.nama_jenis_barang FROM safety_stok a JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN jenis_barang c ON b.id_jenis_barang = c.id_jenis_barang
                                                    WHERE a.sts_sty_restok = 1';
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['sts_sty_restok'] == 1) {
                                                                $v_restok = '<span class="right badge badge-warning">Belum Approved</span>';
                                                            } 

                                                            echo '<tr>
                                                             <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $row['restok_sty'] . '</td>
                                                            <td align="center">' . $row['date_restok'] . '</td>
                                                            <td align="center">' . $v_restok . '</td>
                                                            
                                                            <td align="center" style="">
                                                               <button type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#sty_restok_verif' . md5($row['id_safety_stok']) . '">
                                                                    <i class="fa fa-cog"></i>
                                                                </button>
                                                            </td>
                                                            </tr>
                                                            <div class="modal fade" id="sty_restok_verif' . md5($row['id_safety_stok']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Kode ' . $row['no_serial'] . '</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-safety-stok.php">
                                                                            <div class="modal-body">
                                                                                <!-- <p>One fine body…</p> -->

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_safety_stok" name="id_safety_stok" value="' . $row['id_safety_stok'] . '" hidden>
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <label for="" class="col-form-label">Jumlah Stok</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Jumlah Restok</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="restok_sty" value="' . $row['restok_sty'] . '" required readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="submit" class="btn btn-danger" value="' . $row['id_safety_stok'] . '" name="tidakacc_restok">Tidak</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_safety_stok'] . '" name="acc_restok">Ya</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            ';
                                                        }
                                                    } else { }
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
            if (isset($_GET['restok_verif_acc']) or isset($_GET['restok_verif_notacc'])) {
                if ($_GET['restok_verif_acc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Restok Barang berhasil diApproved.");
                    </script>
                    ';
                } elseif ($_GET['restok_verif_notacc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Restok Barang berhasil Not Approved.");
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