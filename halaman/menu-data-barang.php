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
                                <h1>Data Master Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item active">Data Master Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                              <a href="tambah-data-barang.php"><button type="button" class="btn btn-primary" name="button"><i class="fa fa-plus"></i> Barang Baru</button></a>
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
                                                        <center>Kode Barcode</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Stok</center>
                                                    </th>
                                                    <th>
                                                        <center>Satuan</center>
                                                    </th>
                                                    <th>
                                                        <center>Keterangan</center>
                                                    </th>
                                                    <th>
                                                        <center>Catatan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>STY PER</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Hapus</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = 'SELECT a.*, b.nama_jenis_barang
                                                    FROM barang a JOIN jenis_barang b ON a.id_jenis_barang = b.id_jenis_barang
                                                    WHERE a.status_request = 1 AND a.status_po = 2';
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            $id_br = $row['id_barang'];

                                                            $sql_sty = "SELECT i.id_barang, i.jumlah_barang AS jml_stok, avg(j.jumlah_barang) AS jml_pinjam_rata, max(j.jumlah_barang) AS jml_pinjam_max,
                                                            j.status_peminjaman_barang
                                                            FROM barang i JOIN detail_peminjaman j ON i.id_barang = j.id_barang
                                                            WHERE i.id_barang = '$id_br' AND j.status_pengembalian_barang = 0";
                                                            $query_sty = mysqli_query($conn, $sql_sty);
                                                            $row_sty = mysqli_fetch_array($query_sty);

                                                            $status_peminjaman_barang = $row_sty['status_peminjaman_barang'];
                                                            $rata_nilai = round($row_sty['jml_pinjam_rata'], 2);
                                                            $max_nilai = $row_sty['jml_pinjam_max'];

                                                            // ==========================================

                                                            $min1                     = mktime(0, 0, 0, date("n") - 1, date("j"), date("Y"));
                                                            $hasil_bulan_sebelum      = date("Y-m", $min1);


                                                            $sql_sty_permintaan = "SELECT x.id_barang, x.jumlah_barang AS jml_stok,
                                                                avg(p.jumlah_permintaan_barang_out) AS jml_permintaan_rata, max(p.jumlah_permintaan_barang_out) AS jml_permintaan_max,
                                                                p.status_detail_permintaan_out, DATE_FORMAT(lk.date_permintaan_brg_out, '%Y-%m') AS date_permintaan_brg_out,
                                                                count(p.id_detail_permintaan_out) AS totalTrans
                                                                FROM barang x JOIN detail_permintaan_out p ON x.id_barang = p.id_barang
                                                                JOIN permintaan_barang_out lk ON p.kode_permintaan_brg_out = lk.kode_permintaan_brg_out
                                                                WHERE x.id_barang = '$id_br' AND p.status_detail_permintaan_out = 1 AND DATE_FORMAT(lk.date_permintaan_brg_out, '%Y-%m') = '$hasil_bulan_sebelum'";
                                                                $query_sty_permintaan = mysqli_query($conn, $sql_sty_permintaan);
                                                                $row_sty_permintaan = mysqli_fetch_array($query_sty_permintaan);


                                                            // QUERY OLD
                                                            // $sql_sty_permintaan = "SELECT x.id_barang, x.jumlah_barang AS jml_stok, avg(p.jumlah_permintaan_barang_out) AS jml_permintaan_rata, max(p.jumlah_permintaan_barang_out) AS jml_permintaan_max,
                                                            //     p.status_detail_permintaan_out
                                                            //     FROM barang x JOIN detail_permintaan_out p ON x.id_barang = p.id_barang
                                                            //     JOIN permintaan_barang_out lk ON p.kode_permintaan_brg_out = lk.kode_permintaan_brg_out
                                                            //     WHERE x.id_barang = '$id_br' AND p.status_detail_permintaan_out = 1";
                                                            //     $query_sty_permintaan = mysqli_query($conn, $sql_sty_permintaan);
                                                            //     $row_sty_permintaan = mysqli_fetch_array($query_sty_permintaan);


                                                            $date_permintaan_brg_out = $row_sty_permintaan['date_permintaan_brg_out'];
                                                            $totalTrans = $row_sty_permintaan['totalTrans'];

                                                            $status_detail_permintaan_out = $row_sty_permintaan['status_detail_permintaan_out'];
                                                            $rata_nilai_permintaan = round($row_sty_permintaan['jml_permintaan_rata'], 2);
                                                            $max_nilai_permintaan = $row_sty_permintaan['jml_permintaan_max'];

                                                            if ($row['status_request'] == 0) {
                                                                $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                            } elseif ($row['status_request'] == 1) {
                                                                $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                            } else {
                                                                $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                            }

                                                            // if ($row['status_request'] == 0 || $status_peminjaman_barang == 0 || $status_peminjaman_barang == 2) {
                                                            //     $but = 'disabled';
                                                            // } else {
                                                            //     $but = '';
                                                            // }

                                                            if ($row['status_request'] == 0 || $status_detail_permintaan_out == 0) {
                                                                $but1 = 'disabled';
                                                            } elseif ($totalTrans >= 30) {
                                                                $but1 = '';
                                                            } else {
                                                                $but1 = 'disabled';
                                                            }

                                                            $leadTime = 4;


                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="">' . $row['harga_barang'] . '</td>
                                                            <td align="">' . $row['keterangan_barang'] . '</td>
                                                            <td align="">' . $row['catatan_barang'] . '</td>
                                                            <td align="">' . $verifikasi . '</td>

                                                            <td align="center" style="">
                                                               <button ' . $but1 . ' type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sty_permintaan' . md5($row['id_barang']) . '">
                                                                    <i class="fa fa-cog"></i>
                                                                </button>
                                                            </td>

                                                            <td align="center" style="">
                                                                <form class="" action="config/add-data-barang.php" method="GET">
                                                                <input type="text" name="delete" value="' . md5($row['id_barang']) . '" hidden>
                                                                <button class="btn btn-danger btn-sm" type="submit" name=""><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                            </tr>

                                                            <div class="modal fade" id="sty' . md5($row['id_barang']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Safety Stok Peminjaman</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-safety-stok.php">
                                                                            <div class="modal-body">
                                                                                <!-- <p>One fine body…</p> -->
                                                                                <h5>Nomer Seri : ' . $row['no_serial'] . '</h5>

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <label for="" class="col-form-label">Jumlah Stok</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Pemakaian Maksimum</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="max_stok" value="' . $max_nilai . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Pemakaian Rata - Rata</label>
                                                                                        <div class="">
                                                                                           <input type="number" class="form-control" id="" name="rata_rata_sty" value="' . $rata_nilai . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Lead Time (Hari)</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" placeholder="Masukkan Lead Time" id="" name="lead_time_sty" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_barang'] . '" name="simpan_sty">Simpan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>

                                                            <!-- Permintaan -->

                                                             <div class="modal fade" id="sty_permintaan' . md5($row['id_barang']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Safety Stok Permintaan</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-safety-stok-permintaan.php">
                                                                            <div class="modal-body">
                                                                                <!-- <p>One fine body…</p> -->
                                                                                <h5>Nomer Seri : ' . $row['no_serial'] . '</h5>

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <label for="" class="col-form-label">Jumlah Stok</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Pemakaian Maksimum</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="max_stok" value="' . $max_nilai_permintaan . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Pemakaian Rata - Rata</label>
                                                                                        <div class="">
                                                                                           <input type="number" class="form-control" id="" name="rata_rata_sty" value="' . $rata_nilai_permintaan . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Lead Time (Hari)</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" placeholder="Masukkan Lead Time" id="" name="lead_time_sty"  value="' . $leadTime . '" required readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_barang'] . '" name="simpan_sty_permintaan">Simpan</button>
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
                    toastr.success("Data Safety Stok berhasil disimpan.");
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
