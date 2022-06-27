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
                                                        <center>Status</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>STY PER</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Hapus</center>
                                                    </th>
                                                    <th width="5%">
                                                        <center>Ubah</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = 'SELECT a.*, b.nama_satuan_barang, (select sum(jumlah_permintaan_barang_out) from detail_permintaan_out where id_barang = a.id_barang) keluar, (select sum(jumlah_permintaan_barang_in) from detail_permintaan_in where status_in=1 AND id_barang = a.id_barang) masuk, (select round(avg(jumlah_permintaan_barang_out),0) from detail_permintaan_out where id_barang = a.id_barang) rata_keluar FROM barang a JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang';
                                                $i = 1;
                                                $query = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {

                                                        $id_br = $row['id_barang'];
                                                        $sumarynya = $row['jumlah_barang'] - $row['keluar'] + $row['masuk'];

                                                        if ($row['status_request'] == 0) {
                                                            $verifikasi = '<span class="right badge badge-warning">Pending</span>';
                                                        } elseif ($row['status_request'] == 1) {
                                                            $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                        } else {
                                                            $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                        }

                                                        // $start = strtotime($row['date_permintaan_brg_in']);
                                                        // $end   = strtotime($row['date_permintaan_brg_deliver_in']);
                                                        // $diff  = $end - $start;
                                                        //
                                                        // $hours = floor($diff / (60 * 60 * 24));
                                                        // $leadTime = $hours;


                                                        echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="">' . $sumarynya . '</td>
                                                            <td align="">' . $row['nama_satuan_barang'] . '</td>
                                                            <td align="">' . $verifikasi . '</td>

                                                            <td align="center" style="">
                                                               <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sty_permintaan' . md5($row['id_barang']) . '">
                                                                    <i class="fa fa-cog"></i>
                                                                </button>
                                                            </td>

                                                            <td align="center" style="">
                                                                <form class="" action="config/add-data-barang.php" method="GET">
                                                                <input type="text" name="delete" value="' . md5($row['id_barang']) . '" hidden>
                                                                <button class="btn btn-danger btn-sm" type="submit" name=""><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                            <a href="edit-data-barang-baru.php?ubah=' . md5($row['id_barang']) . '">
                                                                    <button type="submit" class="btn btn-warning btn-sm" name="ubah" id="ubah">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            </tr>

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
                                                                                        <label for="" class="col-form-label">Jumlah Persediaan Awal</label>
                                                                                        <div class="">
                                                                                            <input type="number" class="form-control" id="" name="jumlah_barang" value="' . $row['jumlah_barang'] . '" required readonly>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Pemakaian Rata - Rata</label>
                                                                                        <div class="">
                                                                                           <input type="number" class="form-control" id="" name="rata_rata_sty" value="' . $row['rata_keluar'] . '" required readonly>
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
