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
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['ubah'])) {
                    $sql = 'SELECT * FROM pengajuan_barang_baru WHERE md5(id_pengajuan_barang)="' . $_GET['ubah'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_pengajuan_barang              = $row['id_pengajuan_barang'];
                            $no_request             = $row['no_request'];
                            // $no_serial              = $row['no_serial'];
                            // $id_jenis_barang        = $row['id_jenis_barang'];
                            // $nama_barang            = $row['nama_barang'];
                            // $jumlah_barang          = $row['jumlah_barang'];
                            // $harga_barang           = $row['harga_barang'];
                            // $keterangan_barang      = $row['keterangan_barang'];
                            // $catatan_barang         = $row['catatan_barang'];
                            // $date_request           = $row['date_request'];
                        }
                    } else { }
                } else {

                    $id_pengajuan_barang              = 0;

                    // $no_request    = "";
                    // $no_serial              = "";
                    // $id_jenis_barang        = "";
                    // $nama_barang            = "";
                    // $jumlah_barang          = "";
                    // $harga_barang           = "";
                    // $keterangan_barang      = "";
                    // $catatan_barang         = "";
                    $sql_id = "SELECT max(no_request) AS no_request FROM pengajuan_barang_baru WHERE no_request like '%REQ-%'";
                    $hasil_id = mysqli_query($conn, $sql_id);
                    if (mysqli_num_rows($hasil_id) > 0) {
                        $row = mysqli_fetch_array($hasil_id);
                        $idmax = $row['no_request'];
                        $id_urut = (int) substr($idmax, 4, 5);
                        $id_urut++;
                        // sprintf = menambahkan (+)
                        $no_request = "REQ-" . sprintf("%05s", $id_urut);
                    } else {
                        $no_request = "REQ-00001";
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
                                <h1>Tambah Data Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                    <li class="breadcrumb-item"><a href="menu-data-barang.php">Data Barang</a></li>
                                    <li class="breadcrumb-item active">Tambah Data Barang</li>
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
                                    <form class="" action="config/add-data-barang.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Barcode</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="ID USER .." name="id_user" value="<?php echo $your_id; ?>" hidden required>
                                                    <input type="number" class="form-control" id="" placeholder="ID PENGAJUAN .." name="id_pengajuan_barang" value="<?php echo $id_pengajuan_barang; ?>" hidden required>
                                                    <input type="text" class="form-control" id="" name="no_request" value="<?php echo $no_request; ?>" required readonly>
                                                </div>
                                            </div>
                                            <div id="example-3" class="content">
                                                <!-- <button type="button" id="btnAdd-3" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Barang</button><br><br> -->
                                                <div class="form-group row group">
                                                    <label for="" class="col-sm-2 col-form-label">No Seri</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="text" class="form-control" id="no_serial" placeholder="Masukkan Nomer Seri .." name="no_serial[]">
                                                    </div>
                                                    <label for="" class="col-sm-2 col-form-label">Satuan Barang</label>
                                                    <div class="form-group col-sm-10">
                                                        <select name="id_satuan_barang[]" id="id_satuan_barang" class="form-control" required>
                                                            <option value="0" <?php if (!isset($_GET['id_satuan_barang'])) {
                                                                                        echo "selected";
                                                                                        // code...
                                                                                    } ?>>- Pilih Satuan Barang -</option>
                                                            <?php $str = mysqli_query($conn, "SELECT * FROM satuan_barang");
                                                                while ($data = mysqli_fetch_array($str)) { ?>
                                                                <option value="<?php echo @$data[0]; ?>" <?php if (@$data[0] == @$data[0]) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>> <?php echo @$data[1]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <label for="" class="col-sm-2 col-form-label">Nama Barang</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan Nama Barang .." name="nama_barang[]" required>
                                                    </div>

                                                    <label for="" class="col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="form-group col-sm-10">
                                                        <input type="number" class="form-control" id="jumlah_barang" placeholder="Masukkan Jumlah Barang .." name="jumlah_barang[]" required>
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
