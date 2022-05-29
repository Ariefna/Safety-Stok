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
            <?php if (isset($_GET['detail'])) {
                    $sql = 'SELECT * FROM barang WHERE md5(no_request)="' . $_GET['detail'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_barang           = $row['id_barang'];
                            $no_request          = $row['no_request'];
                            $status_request      = $row['status_request'];
                        }
                    } else { }
                }
                ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Detail Verifikasi Barang PO</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Verifikasi Barang PO</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <?php
                                    $no_request          = $_GET['detail'];

                                    $cek_status_ya = "SELECT * FROM barang WHERE no_request = '$no_request'";
                                    $query_cek_status_ya = mysqli_query($conn, $cek_status_ya);
                                    while ($get_aja = mysqli_fetch_array($query_cek_status_ya)) {

                                        $a = $get_aja['status_request'];
                                        $b = $get_aja['status_po'];

                                        if ($a == 0) {
                                            $cek_but_sts = 'disabled';
                                        } else {
                                            $cek_but_sts = '';
                                        }

                                        if ($b == 0 || $b == 1) {
                                            $cek_but_sts_po = 'disabled';
                                        } else {
                                            $cek_but_sts_po = '';
                                        }
                                    }
                                    ?>
                                <a href="config/add-po-verifikasi.php?id=<?php echo $no_request; ?>">
                                    <button <?php echo $cek_but_sts_po; ?> type="submit" class="btn btn-success" name="verifikasi_cek_po" id="verifikasi_cek_po">
                                        <i class="fa fa-save"></i> Konfirmasi Barang PO
                                    </button>
                                </a>
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
                                                        <center>No Seri</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis</center>
                                                    </th>
                                                    <th>
                                                        <center>Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Request</center>
                                                    </th>
                                                    <th>
                                                        <center>Tgl Req</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Lihat</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $get_no_req_baru = $_GET['detail'];

                                                    $sql = "SELECT a.*, b.nama_jenis_barang, c.nama_user 
                                                    FROM barang a JOIN jenis_barang b ON a.id_jenis_barang = b.id_jenis_barang
                                                    JOIN users c ON a.id_user = c.id_user
                                                    WHERE a.status_request = 1 AND a.no_request = '$get_no_req_baru'";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_po'] == 0) {
                                                                $sts_po = '<span class="right badge badge-warning">Belum Sampai</span>';
                                                            } elseif ($row['status_po'] == 1) {
                                                                $sts_po = '<span class="right badge badge-success">Sudah Sampai</span>';
                                                            } else {
                                                                $sts_po = '<span class="right badge badge-primary">PO Selesai</span>';
                                                            }

                                                            if ($row['status_po'] == 0) {
                                                                $dis_po = 'disabled';
                                                            } elseif ($row['status_po'] == 1) {
                                                                $dis_po = '';
                                                            } else {
                                                                $dis_po = 'disabled';
                                                            }

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="">' . $row['nama_user'] . '</td>
                                                            <td align="">' . $row['date_request'] . '</td>
                                                            <td align="">' . $sts_po . '</td>
                                                           
                                                            <td align="center" style="">
                                                               <button ' . $dis_po . ' type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verif' . md5($row['id_barang']) . '">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </td>
                                                            </tr>
                                                            <div class="modal fade" id="verif' . md5($row['id_barang']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">No Seri ' . $row['no_serial'] . '</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-verifikasi-barang-baru.php">
                                                                            <div class="modal-body">
                                                                                <!-- <p>One fine body…</p> -->

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <input type="text" id="no_request" name="no_request" value="' . $row['no_request'] . '" hidden>
                                                                                       
                                                                                        <label for="" class="col-form-label">Bukti Foto Barang</label>
                                                                                        <div class="">
                                                                                            <div class="col-sm-2">
                                                                                                <img src="'. $row['foto_barang'] .'" alt="" class="img img-fluid">
                                                                                            </div>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Jumlah Stok</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Harga (Rp)</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="harga_barang" value="' . $row['harga_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Keterangan</label>
                                                                                        <div class="">
                                                                                            <textarea type="text" class="form-control" id="" rows="4" cols="50" name="keterangan_barang" value="" required readonly>' . $row['keterangan_barang'] . '</textarea>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Catatan</label>
                                                                                        <div class="">
                                                                                            <textarea type="text" class="form-control" id="" rows="4" cols="50" name="catatan_barang" value="" required readonly>' . $row['catatan_barang'] . '</textarea>
                                                                                        </div>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_barang'] . '" name="acc_po">Ya</button>
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
            if (isset($_GET['acc']) or isset($_GET['edit']) or isset($_GET['tidakacc']) or isset($_GET['acc_po_ok'])) {
                if ($_GET['acc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Telah berhasil diApproved.");
                    </script>
                    ';
                } elseif ($_GET['acc_po_ok'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("PO Barang Sampai Sudah diApproved.");
                    </script>
                    ';
                } elseif ($_GET['edit'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil diubah.");
                    </script>
                    ';
                } elseif ($_GET['tidakacc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil Not Approved.");
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