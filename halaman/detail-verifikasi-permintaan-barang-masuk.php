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
                $sql = 'SELECT * FROM detail_permintaan_in WHERE md5(kode_permintaan_brg_in)="' . $_GET['detail'] . '"';
                $i = 1;
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id_detail_permintaan_in           = $row['id_detail_permintaan_in'];
                        $kode_permintaan_brg_in            = $row['kode_permintaan_brg_in'];
                        $id_barang                          = $row['id_barang'];
                        $jumlah_permintaan_barang_in       = $row['jumlah_permintaan_barang_in'];
                        $status_detail_permintaan_in       = $row['status_detail_permintaan_in'];
                    }
                } else {
                }
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
                                $cek_status_ya = "SELECT * FROM detail_permintaan_in WHERE kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
                                // echo $cek_status_ya;
                                $query_cek_status_ya = mysqli_query($conn, $cek_status_ya);
                                while ($get_aja = mysqli_fetch_array($query_cek_status_ya)) {

                                    $a = $get_aja['status_detail_permintaan_in'];

                                    if ($a != 0) {
                                        $cek_but_sts = 'disabled';
                                    } else {
                                        $cek_but_sts = '';
                                    }
                                }
                                ?>

                                <a href="config/add-verifikasi-permintaan_in.php?id=<?php echo $id_prt_brd; ?>">
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
                                                $sql = "SELECT a.*, us.nama_user, b.nama_barang, b.no_serial, b.jumlah_barang, c.nama_satuan_barang, ot.id_permintaan_brg_in
                                                    FROM permintaan_barang_in ot JOIN users us ON ot.id_user = us.id_user
                                                    JOIN detail_permintaan_in a ON ot.kode_permintaan_brg_in = a.kode_permintaan_brg_in
                                                    JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN satuan_barang c ON b.id_satuan_barang = c.id_satuan_barang
                                                    WHERE a.kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        $cek_sty_empety = "SELECT id_barang AS cek_id, hasil_sty FROM safety_stok WHERE id_barang = $row[id_barang]";
                                                        $query_cek_sty_empety = mysqli_query($conn, $cek_sty_empety);
                                                        $row_empety = mysqli_fetch_array($query_cek_sty_empety);

                                                        $hasil_cek_sty = $row_empety['hasil_sty'];
                                                        $hasil_cek_id = $row_empety['cek_id'];

                                                        if ($hasil_cek_id == null) {
                                                            $safetyStok = 'Belum Ada Safety Stok';
                                                        } else {
                                                            $safetyStok = $hasil_cek_sty;
                                                        }

                                                        if ($row['status_detail_permintaan_in'] == 0) {
                                                            $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                        } elseif ($row['status_detail_permintaan_in'] == 1) {
                                                            $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                        } else {
                                                            $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                        }

                                                        if ($row['status_detail_permintaan_in'] == 1 || $row['status_detail_permintaan_in'] == 2) {
                                                            $but = 'disabled';
                                                        } else {
                                                            $but = '';
                                                        }

                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_permintaan_barang_in'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $row['nama_user'] . '</td>
                                                            <td align="center">' . $verifikasi . '</td>
                                                            <td align="center" style="">
                                                                <center>
                                                                    <button ' . $but . ' type="bitton" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#id_detail' . md5($row['id_detail_permintaan_in']) . '">
                                                                        <i class="fa fa-cog"></i>
                                                                    </button>
                                                                </center>
                                                            </td>

                                                            <div class="modal fade" id="id_detail' . md5($row['id_detail_permintaan_in']) . '" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title">Verifikasi permintaan barang keluar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    </div>
                                                                    <form method="POST" action="config/add-verifikasi-permintaan_in.php">
                                                                        <div class="modal-body">
                                                                            <input type="text" class="form-control" id="" placeholder="" name="kode_permintaan_brg_in" value="' . $row['kode_permintaan_brg_in'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="id_permintaan_brg_in" value="' . $row['id_permintaan_brg_in'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="jumlah_permintaan_barang_in" value="' . $row['jumlah_permintaan_barang_in'] . '" hidden required>
                                                                            <input type="text" class="form-control" id="" placeholder="" name="id_barang" value="' . $row['id_barang'] . '" hidden required>

                                                                            <p>Apakah yakin ingin memverifikasi permintaan barang <b>' . $row['nama_barang'] . '</b> ?</p>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <label for="" class="col-form-label">Stok Tersedia</label>
                                                                                    <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <label for="" class="col-form-label">Safety Stok</label>
                                                                                    <input type="text" class="form-control" id="" name="hasil_sty" value="' . $safetyStok . '" required readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <label for="" class="col-form-label">Jumlah Permintaan</label>
                                                                                    <input type="number" class="form-control" id="" name="jumlah_permintaan_barang_in" value="' . $row['jumlah_permintaan_barang_in'] . '" required readonly>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <label for="" class="col-form-label">Jumlah Yang Di Setujui</label>
                                                                                    <input type="number" class="form-control" placeholder="0" id="" name="jml_disetujui" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <label for="" class="col-form-label">Keterangan</label>
                                                                                    <textarea type="text" rows="4" class="form-control" placeholder="Masukkan Keterangan" id="keterangan_in" name="keterangan_in" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                          
                                                                            <button type="submit" class="btn btn-danger" value="' . $row['id_detail_permintaan_in'] . '" name="notverifikasi_detail">Tidak</button>
                                                                            <button type="submit" class="btn btn-success" value="' . $row['id_detail_permintaan_in'] . '" name="verifikasi_detail">Ya</button>
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
        if (isset($_GET['acc']) or isset($_GET['tidakacc']) or isset($_GET['save'])) {
            if ($_GET['acc'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Permintaan berhasil diverifikasi.");
                    </script>
                    ';
            } elseif ($_GET['tidakacc'] == "sukses") {
                echo '
                    <script type="text/javascript">
                    toastr.success("Data Permintaan berhasil <b>TIDAK</b> diverifikasi.");
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