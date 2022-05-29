<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 200;
    include 'template/head.php';

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

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
                                <h1>Data Safety Stok</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Data Safety Stok</li>
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
                                        <h4>Safety Stok Permintaan</h4><br>
                                        <table id="example2" class="table table-bordered table-striped">
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
                                                        <center>Pemakaian</center>
                                                    </th>
                                                    <th>
                                                        <center>Lead Time</center>
                                                    </th>
                                                    <th>
                                                        <center>STY</center>
                                                    </th>
                                                    <th>
                                                        <center>RPoint</center>
                                                    </th>
                                                    <th>
                                                        <center>Bulan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Restok</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Hapus</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = 'SELECT a.*, b.no_serial, b.nama_barang, b.jumlah_barang, c.nama_jenis_barang 
                                                    FROM safety_stok a JOIN barang b ON a.id_barang = b.id_barang
                                                    JOIN jenis_barang c ON b.id_jenis_barang = c.id_jenis_barang
                                                    WHERE a.sts_sty IN (0, 1) AND a.sts_per_pin = 2';
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            
                                                            if ($row['sts_sty_restok'] == 0) {
                                                                $v_restok = '<span class="right badge badge-info">Belum Restok</span>';

                                                            } elseif ($row['sts_sty_restok'] == 2 && $row['jumlah_barang'] <= $row['reorder_point']) {
                                                                $v_restok = '<span class="right badge badge-info">Belum Restok</span>';

                                                            } else {
                                                                $v_restok = '<span class="right badge badge-success">Sudah Restok</span>';
                                                            }

                                                            if ($row['jumlah_barang'] <= $row['reorder_point']) {
                                                                $v_dis = '';

                                                            } elseif ($row['reorder_point'] == 0) {
                                                                $v_dis = '';

                                                            } else {
                                                                $v_dis = 'disabled';

                                                            }

                                                            // Reorder Point = Safety Stok + (pemakaian rata" x Lead Time)
                                                            $atributReorder = $row['rata_rata_sty'] * $row['lead_time_sty'];
                                                            $reOrderPoint = $row['hasil_sty'] + $atributReorder;

                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $row['max_stok'] . '</td>
                                                            <td align="center">' . $row['lead_time_sty'] . ' Hari</td>
                                                            <td align="center">' . $row['hasil_sty'] . '</td>
                                                            <td align="center">' . $row['reorder_point'] . '</td>
                                                            <td align="center">' . tgl_indo($row['date_sty']) . '</td>
                                                            <td align="center">' . $v_restok . '</td>
                                                            
                                                            <td align="center" style="">
                                                               <button ' . $v_dis . ' type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#sty_restok' . md5($row['id_safety_stok']) . '">
                                                                    <i class="fa fa-arrow-up"></i>
                                                                </button>
                                                            </td>
                                                            <td align="center" style="">
                                                                <form class="" action="config/add-safety-stok.php" method="GET">
                                                                    <input type="text" name="delete_data" value="' . $row['id_safety_stok'] . '" hidden>
                                                                    <button class="btn btn-danger btn-sm" type="submit" name=""><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                            </tr>

                                                            <div class="modal fade" id="sty_restok' . md5($row['id_safety_stok']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Restok Barang Permintaan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-safety-stok.php">
                                                                            <div class="modal-body">
                                                                                <h5>Nomer Seri : ' . $row['no_serial'] . '</h5>

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_safety_stok" name="id_safety_stok" value="' . $row['id_safety_stok'] . '" hidden>
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Jumlah Stok</label>
                                                                                                <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Pemakaian Maksimum</label>
                                                                                                <input type="number" class="form-control" id="" name="max_stok" value="' . $row['max_stok'] . '" required readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Pemakaian Rata - Rata</label>
                                                                                                <input type="number" class="form-control" id="" name="rata_rata_sty" value="' . $row['rata_rata_sty'] . '" required readonly>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Lead Time (Hari)</label>
                                                                                                <input type="number" class="form-control" value="' . $row['lead_time_sty'] . '" id="" name="lead_time_sty" required readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Hasil Safety Stok</label>
                                                                                                <input type="number" class="form-control" value="' . $row['hasil_sty'] . '" id="" name="hasil_sty" required readonly>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <label for="" class="col-form-label">Reorder Point</label>
                                                                                                <input type="number" class="form-control" value="' . $reOrderPoint . '" id="" name="reoreder_point" required readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <label for="" class="col-form-label">Restok Barang</label>
                                                                                                <input type="number" class="form-control" placeholder="Masukkan jumalah restok" id="" name="restok_barang" required>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_safety_stok'] . '" name="simpan_sty_restok">Simpan Restok</button>
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
            if (isset($_GET['restok']) or isset($_GET['del'])) {
                if ($_GET['restok'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Pengajuan Restok Barang berhasil ditambahkan.");
                    </script>
                    ';
                } elseif ($_GET['del'] == "deleteberhasil") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Safety Stok berhasil dihapus.");
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