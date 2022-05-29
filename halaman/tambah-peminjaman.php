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
                    $sql = 'SELECT * FROM peminjaman_barang WHERE md5(id_peminjaman)="' . $_GET['ubah'] . '"';
                    $i = 1;
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $id_peminjaman            = $row['id_peminjaman'];
                            $no_peminjaman            = $row['no_peminjaman'];
                            $date_peminjaman_start    = $row['date_peminjaman_start'];
                            $date_peminjaman_end      = $row['date_peminjaman_end'];
                            $id_user                  = $row['id_user'];
                            $status_peminjaman        = $row['status_peminjaman'];
                        }
                    } else { }
                } else {

                    $id_peminjaman              = 0;
                    $date_peminjaman_start      = "";
                    $date_peminjaman_end        = "";
                    $status_peminjaman          = "";
                    $sql_id = "SELECT max(no_peminjaman) AS no_peminjaman 
                    FROM peminjaman_barang WHERE no_peminjaman like '%PIN-%'";
                    $hasil_id = mysqli_query($conn, $sql_id);
                    if (mysqli_num_rows($hasil_id) > 0) {
                        $row = mysqli_fetch_array($hasil_id);
                        $idmax = $row['no_peminjaman'];
                        $id_urut = (int) substr($idmax, 4, 5);
                        $id_urut++;
                        // sprintf = menambahkan (+)
                        $no_peminjaman = "PIN-" . sprintf("%05s", $id_urut);
                    } else {
                        $no_peminjaman = "PIN-00001";
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
                                <h1>Tambah Peminjaman Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Tambah Permintaan Barang</li>
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
                                    <form class="" action="config/add-peminjaman.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">No Peminjaman</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="" placeholder="ID USER .." name="id_user" value="<?php echo $your_id; ?>" hidden required>
                                                    <input type="number" class="form-control" id="" placeholder="ID PEMINJAMAN .." name="id_peminjaman" value="<?php echo $id_peminjaman; ?>" hidden required>
                                                    <input type="text" class="form-control" id="" name="no_peminjaman" value="<?php echo $no_peminjaman; ?>" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control" id="" name="date_peminjaman_start" value="<?php echo $date_peminjaman_start; ?>" required>
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control" id="" name="date_peminjaman_end" value="<?php echo $date_peminjaman_end; ?>" required>
                                                </div>
                                            </div>
                                            <div id="example-3" class="content">
                                                <button type="button" id="btnAdd-3" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Barang</button>
                                                <div class="form-group row group">
                                                    <label for="" class="col-sm-2 col-form-label">Nama Barang</label>
                                                    <div class="col-sm-4">

                                                        <select name="id_barang[]" id="id_barang" class="form-control" onchange="" required>
                                                            <option value="0" <?php if (!isset($_GET['id_barang'])) {
                                                                                        echo "selected";
                                                                                        // code...
                                                                                    } ?>>- Pilih Barang -</option>
                                                            <?php $str = mysqli_query($conn, 
                                                            "SELECT a.*, b.nama_jenis_barang 
                                                            FROM barang a JOIN jenis_barang b ON a.id_jenis_barang = b.id_jenis_barang 
                                                            WHERE a.status_request = 1
                                                            ORDER BY b.nama_jenis_barang ASC");
                                                                while ($data = mysqli_fetch_array($str)) { ?>
                                                                <option value="<?php echo @$data[0]; ?>" <?php if (@$row[0] == @$data[0]) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>> <?php echo @$data[2]; ?> - <?php echo @$data[3]; ?> (<?php echo @$data[14]; ?>)</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <label for="" class="col-sm-1 col-form-label">Jumlah</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" id="jumlah_barang" placeholder="Masukkan Jumlah Barang .." name="jumlah_barang[]" value="<?php echo $jumlah_barang; ?>" required>
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