<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
    $your_id = $_SESSION['id_user'];
    $id_prt_brd = $_GET['id'];
    ?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['detail'])) {
                    $sql = 'SELECT * FROM detail_peminjaman WHERE md5(no_peminjaman)="' . $_GET['detail'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_detail_peminjaman           = $row['id_detail_peminjaman'];
                            $no_peminjaman                  = $row['no_peminjaman'];
                            $id_barang                      = $row['id_barang'];
                            $jumlah_barang                  = $row['jumlah_barang'];
                            $status_peminjaman_barang       = $row['status_peminjaman_barang'];
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
                                <h1>Detail Verifikasi Barang Keluar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Verifikasi Barang Keluar</li>
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
                                    $cek_status_ya = "SELECT * FROM detail_peminjaman WHERE no_peminjaman = '$no_peminjaman'";
                                    $query_cek_status_ya = mysqli_query($conn, $cek_status_ya);
                                    while ($get_aja = mysqli_fetch_array($query_cek_status_ya)) {

                                        $a = $get_aja['status_peminjaman_barang'];

                                        if ($a == 0) {
                                            $cek_but_sts = 'disabled';
                                        } else {
                                            $cek_but_sts = '';
                                        }
                                    }
                                    ?>
                                <a href="config/add-verifikasi-peminjaman.php?id=<?php echo $id_prt_brd; ?>">
                                    <button <?php echo $cek_but_sts; ?> type="submit" class="btn btn-success" name="save_verifikasi" value="<?php echo $id_prt_brd; ?>">
                                        <i class="fa fa-save"></i> Konfirmasi Hasil Verfikasi
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
                                                        <center>No Serial</center>
                                                    </th>
                                                    <th>
                                                        <center>Jenis Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Jumlah</center>
                                                    </th>
                                                    <th>
                                                        <center>Stok</center>
                                                    </th>
                                                    <th>
                                                        <center>Karyawan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="10%">
                                                        <center>Opsi</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT a.*, us.nama_user, b.nama_barang, b.no_serial, c.nama_jenis_barang, ot.id_peminjaman, b.jumlah_barang AS jml_brg_stok
                                                    FROM peminjaman_barang ot JOIN users us ON ot.id_user = us.id_user
                                                    JOIN detail_peminjaman a ON ot.no_peminjaman = a.no_peminjaman
                                                    JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN jenis_barang c ON b.id_jenis_barang = c.id_jenis_barang
                                                    WHERE a.no_peminjaman = '$no_peminjaman'";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_peminjaman_barang'] == 0) {
                                                                $verifikasi_pinjam = '<span class="right badge badge-warning">Panding</span>';
                                                            } elseif ($row['status_peminjaman_barang'] == 1) {
                                                                $verifikasi_pinjam = '<span class="right badge badge-success">Approved</span>';
                                                            } else {
                                                                $verifikasi_pinjam = '<span class="right badge badge-danger">Not approved</span>';
                                                            }

                                                            if ($row['status_peminjaman_barang'] == 1 || $row['status_peminjaman_barang'] == 2) {
                                                                $but = 'disabled';
                                                            } else {
                                                                $but = '';
                                                            } 

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $row['jml_brg_stok'] . '</td>
                                                            <td align="center">' . $row['nama_user'] . '</td>
                                                            <td align="center">' . $verifikasi_pinjam . '</td>
                                                            <td align="center" style="">
                                                                <center>
                                                                    <button '. $but.' type="bitton" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#id_detail' . md5($row['id_detail_peminjaman']) . '">
                                                                        <i class="fa fa-cog"></i>
                                                                    </button>
                                                                </center>
                                                            </td>


                                                            <div class="modal fade" id="id_detail' . md5($row['id_detail_peminjaman']) . '" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title">Verifikasi peminjaman barang</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    </div>
                                                                    <form method="POST" action="config/add-verifikasi-peminjaman.php">
                                                                        <div class="modal-body">
                                                                            <p>Apakah Anda yakin ingin memverifikasi peminjaman barang ' . $row['nama_barang'] . ' ?</p>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="no_peminjaman" value="' . $row['no_peminjaman'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="id_peminjaman" value="' . $row['id_peminjaman'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="id_barang" value="' . $row['id_barang'] . '" hidden required>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                          
                                                                            <button type="submit" class="btn btn-danger" value="' . $row['id_detail_peminjaman'] . '" name="notverifikasi_detail">Tidak</button>
                                                                            <button type="submit" class="btn btn-success" value="' . $row['id_detail_peminjaman'] . '" name="verifikasi_detail">Ya</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                           
                                                            </tr>
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
            if (isset($_GET['acc']) or isset($_GET['tidakacc']) or isset($_GET['save'])) {
                if ($_GET['acc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Peminjaman berhasil diverifikasi.");
                    </script>
                    ';
                } elseif ($_GET['tidakacc'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Peminjaman berhasil <b>TIDAK</b> diverifikasi.");
                    </script>
                    ';
                } elseif ($_GET['save'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Verifikasi berhasil disimpan.");
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