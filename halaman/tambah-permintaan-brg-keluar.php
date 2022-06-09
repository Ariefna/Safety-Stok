<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
    $your_id = $_SESSION['id_user']
?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <script>
            function getval(sel) {
                var valuenya = $(sel).find(':selected').attr('data-id');
                $(sel).closest('.group').find('.satuannya').text(valuenya);
            }
        </script>
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['ubah'])) {
                $sql = 'SELECT * FROM permintaan_barang_out WHERE md5(id_permintaan_brg_out)="' . $_GET['ubah'] . '"';
                $i = 1;
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id_permintaan_brg_out              = $row['id_permintaan_brg_out'];
                        $kode_permintaan_brg_out            = $row['kode_permintaan_brg_out'];
                        $date_permintaan_brg_out            = $row['date_permintaan_brg_out'];
                        $id_user                            = $row['id_user'];
                        $status_permintaan_brg_out          = $row['status_permintaan_brg_out'];
                    }
                } else {
                }
            } else {

                $id_permintaan_brg_out              = 0;
                $date_permintaan_brg_out            = "";
                $status_permintaan_brg_out          = "";
                $sql_id = "SELECT max(kode_permintaan_brg_out) AS kode_permintaan_brg_out
                    FROM permintaan_barang_out WHERE kode_permintaan_brg_out like '%OUT-%'";
                $hasil_id = mysqli_query($conn, $sql_id);
                if (mysqli_num_rows($hasil_id) > 0) {
                    $row = mysqli_fetch_array($hasil_id);
                    $idmax = $row['kode_permintaan_brg_out'];
                    $id_urut = (int) substr($idmax, 4, 5);
                    $id_urut++;
                    // sprintf = menambahkan (+)
                    $kode_permintaan_brg_out = "OUT-" . sprintf("%05s", $id_urut);
                } else {
                    $kode_permintaan_brg_out = "OUT-00001";
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
                                <h1>Tambah Permintaan Barang Keluar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Tambah Permintaan Barang Keluar</li>
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
                                    <form class="" action="config/add-permintaan-out.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">No Permintaan</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="ID USER .." name="id_user" value="<?php echo $your_id; ?>" hidden required>
                                                    <input type="number" class="form-control" id="" placeholder="ID PERMINTAAN .." name="id_permintaan_brg_out" value="<?php echo $id_permintaan_brg_out; ?>" hidden required>
                                                    <input type="text" class="form-control" id="" name="kode_permintaan_brg_out" value="<?php echo $kode_permintaan_brg_out; ?>" required readonly>
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label">Tanggal Permintaan</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="" name="tanggal_permintaan_barang_out" value="<?php echo date("Y-m-d"); ?>" required>
                                                </div>
                                            </div>
                                            <div id="example-3" class="content">
                                                <button type="button" id="btnAdd-3" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Barang</button>
                                                <div class="form-group row group">
                                                    <label for="" class="col-sm-2 col-form-label">Nama Barang</label>
                                                    <div class="col-sm-4">

                                                        <select name="id_barang[]" class="form-control" required onchange="getval(this);">
                                                            <option value="0" <?php if (!isset($_GET['id_barang'])) {
                                                                                    echo "selected";
                                                                                    // code...
                                                                                } ?>>- Pilih Barang -</option>
                                                            <?php $str = mysqli_query($conn, "SELECT a.*, b.nama_satuan_barang
                                                            FROM barang a JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang
                                                            WHERE a.status_po = 2 AND b.id_satuan_barang IN (2,3)
                                                            ORDER BY b.nama_satuan_barang ASC");
                                                            while ($data = mysqli_fetch_array($str)) { ?>
                                                                <option data-id="<?php echo @$data[14]; ?>" value="<?php echo @$data[0]; ?>" <?php if (@$row[0] == @$data[0]) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>> <?php echo @$data[2]; ?> - <?php echo @$data[3]; ?> (<?php echo @$data[14]; ?>)</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label for="" class="col-sm-1 col-form-label">Jumlah</label>
                                                    <div class="col-sm-3">
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control" id="jumlah_permintaan_barang_out" name="jumlah_permintaan_barang_out[]" placeholder="Masukkan Jumlah Barang" value="<?php echo $jumlah_barang; ?>" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                                            <span class="input-group-text satuannya" id="basic-addon2">Satuan</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-danger btnRemove">X</button>
                                                    </div>
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