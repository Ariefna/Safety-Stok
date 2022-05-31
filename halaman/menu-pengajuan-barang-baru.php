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
                                <h1>Data Pengajuan Barang Baru</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Data Pengajuan Barang Baru</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a href="tambah-data-barang.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Pengajuan Barang Baru</button></a>
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
                                                        <center>No Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal Pengajuan</center>
                                                    </th>

                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="15%">
                                                        <center>Opsi</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = 'SELECT * FROM pengajuan_barang_baru WHERE status_pengajuan IN (0,1)';
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {



                                                        if ($row['status_pengajuan'] == 0) {
                                                            $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                            $but = 'hidden';
                                                        } elseif ($row['status_pengajuan'] == 1) {
                                                            $verifikasi = '<span class="right badge badge-success">Sudah Dievaluasi</span>';
                                                            $but = '';
                                                        } else {
                                                            $verifikasi = '<span class="right badge badge-danger">Sudah Dievaluasi</span>';
                                                            $but = '';
                                                        }

                                                        if ($row['status_pengajuan'] == 0) {
                                                            $but1 = '';
                                                        } else {
                                                            $but1 = '';
                                                        }



                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['tanggal_pengajuan'] . '</td>
                                                            <td align="">' . $verifikasi . '</td>
                                                          
                                                            <td align="center" style="">
                                                                <a href="detail-pengajuan-barang.php?detail=' . md5($row['no_request']) . '">
                                                                    <button type="submit" class="btn btn-primary btn-sm" name="detail" id="detail">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="cetak-bukti-permintaan.php?po=' . $row['no_request'] . '">
                                                                <button ' . $but . ' type="submit" class="btn btn-warning btn-sm" name="po" id="po">
                                                                    <i class="fa fa-file"></i>
                                                                </button>
                                                                </a>
                                                              
                                                            </td>

                                                            </tr>

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
        if (isset($_GET['tambah']) or isset($_GET['edit']) or isset($_GET['delete']) or isset($_GET['simpan'])) {
            if ($_GET['tambah'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil ditambahkan.");
                    </script>
                    ';
            } elseif ($_GET['edit'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil diubah.");
                    </script>
                    ';
            } elseif ($_GET['delete'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil dihapus.");
                    </script>
                    ';
            } elseif ($_GET['simpan'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil disimpan.");
                    </script>
                    ';
            } elseif ($_GET['update_foto_ya'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Update Foto Barang berhasil disimpan.");
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