<!DOCTYPE html>
<html>
<?php
session_start();
if ((!isset($_SESSION['appks'])) || ($_SESSION['appks'] != true)) {
    echo '<script>window.location="../";</script>';
} else {
    $index = 0;
    include 'template/head.php';
?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'template/navbar.php'; ?>
            <?php if (isset($_GET['ubah'])) {
                $sql = 'SELECT * FROM barang WHERE md5(id_barang)="' . $_GET['ubah'] . '"';
                $i = 1;
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id_barang              = $row['id_barang'];
                        $no_request             = $row['no_request'];
                        $no_serial              = $row['no_serial'];
                        $nama_barang            = $row['nama_barang'];
                        $jumlah_barang          = $row['jumlah_barang'];
                        $harga_barang           = $row['harga_barang'];
                        $keterangan_barang      = $row['keterangan_barang'];
                        $catatan_barang         = $row['catatan_barang'];
                        $id_jenis_barang        = $row['id_jenis_barang'];
                        $status_request         = $row['status_request'];
                    }
                } else {
                }
            } else {

                $id_barang              = 0;
                $no_request             = "";
                $no_serial              = "";
                $nama_barang            = "";
                $jumlah_barang          = "";
                $harga_barang           = "";
                $keterangan_barang      = "";
                $catatan_barang         = "";
                $id_jenis_barang        = "";
                $status_request         = "";
            }
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Ubah Data Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Ubah Data Barang</li>
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
                                    <form class="" action="config/edit-data-barang.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <input type="number" class="form-control" id="" placeholder="ID BARANG .." name="id_barang" value="<?php echo $id_barang; ?>" hidden required>
                                                <label for="" class="col-sm-2 col-form-label">Nomer Request</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="" name="no_request" value="<?php echo $no_request; ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Nomer Seri</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="" name="no_serial" value="<?php echo $no_serial; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Nama Barang</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="" name="nama_barang" value="<?php echo $nama_barang; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Jumlah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="" name="jumlah_barang" value="<?php echo $jumlah_barang; ?>" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Harga</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="" placeholder="" name="harga_barang" value="<?php echo $harga_barang; ?>" required>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Keterangan Barang </label>
                                                <div class="form-group col-sm-10">
                                                    <textarea type="text" class="form-control" id="keterangan_barang" placeholder="Masukkan Keterangan .." rows="4" cols="50" name="keterangan_barang" value="" required><?php echo $keterangan_barang; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Catatan Barang</label>
                                                <div class="form-group col-sm-10">
                                                    <textarea type="text" class="form-control" id="catatan_barang" placeholder="Masukkan Catatan .." rows="4" cols="50" name="catatan_barang" value="" required><?php echo $catatan_barang; ?></textarea>
                                                </div>
                                            </div> -->

                                            <button type="submit" class="btn btn-primary" name="ubahya">Simpan</button>
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
        <?php include 'template/script.php';

        ?>

    </body>
<?php } ?>

</html>