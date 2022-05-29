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
            <?php if (isset($_GET['detail'])) {
                    $sql = 'SELECT * FROM barang WHERE md5(no_request)="' . $_GET['detail'] . '"';
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
                                <h1>Detail Pengajuan Barang</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Detail Pengajuan Barang Keluar</li>
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
                                                        <center>Nama Barang</center>
                                                    </th>
                                                    <th>
                                                        <center>Stok</center>
                                                    </th>
                                                    <th>
                                                        <center>Harga</center>
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
                                                    <th>
                                                        <center>Opsi</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT a.*, b.id_pengajuan_barang, c.nama_jenis_barang
                                                    FROM barang a JOIN pengajuan_barang_baru b ON a.no_request = b.no_request
                                                    JOIN jenis_barang c ON a.id_jenis_barang = c.id_jenis_barang
                                                    WHERE b.no_request = '$no_request' AND a.status_po = 0";
                                                    $i = 1;
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query)) {

                                                            if ($row['status_request'] == 0) {
                                                                $verifikasi = '<span class="right badge badge-warning">Panding</span>';
                                                                $but = '';
                                                            } elseif ($row['status_request'] == 1) {
                                                                $verifikasi = '<span class="right badge badge-success">Approved</span>';
                                                                $but = 'hidden';
                                                            } else {
                                                                $verifikasi = '<span class="right badge badge-danger">Not approved</span>';
                                                                $but = 'hidden';
                                                            }

                                                            if ($row['status_request'] == 0) {
                                                                $but1 = 'hidden';
                                                                $but2 = 'hidden';
                                                            } elseif ($row['status_request'] == 1) {
                                                                $but1 = '';
                                                                $but2 = '';
                                                            } else {
                                                                $but1 = 'hidden';
                                                                $but2 = '';
                                                            }


                                                            echo '<tr>
                                                            <td align="center">' . $i++ . '</td>
                                                            <td align="">' . $row['no_request'] . '</td>
                                                            <td align="">' . $row['no_serial'] . '</td>
                                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                                            <td align="">' . $row['nama_barang'] . '</td>
                                                            <td align="center">' . $row['jumlah_barang'] . '</td>
                                                            <td align="center">' . $row['harga_barang'] . '</td>
                                                            <td align="center">' . $row['keterangan_barang'] . '</td>
                                                            <td align="center">' . $row['catatan_barang'] . '</td>
                                                            <td align="center">' . $verifikasi . '</td>
                                                            <td align="center" style="">
                                                                <a href="edit-data-barang-baru.php?ubah=' . md5($row['id_barang']) . '">
                                                                    <button ' . $but . ' type="submit" class="btn btn-warning btn-sm" name="ubah" id="ubah">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <button ' . $but1 . ' type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#sty_up_verifikasi' . md5($row['id_barang']) . '">
                                                                    <i class="fa fa-cog"></i>
                                                                </button>
                                                              
                                                                <a href="config/add-data-barang.php?delete=' . md5($row['id_barang']) . '">
                                                                    <button ' . $but2 . ' type="submit" class="btn btn-danger btn-sm" name="delete" id="delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            </tr>


                                                            <div class="modal fade" id="sty_up_verifikasi' . md5($row['id_barang']) . '" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Update Pembelian</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="POST" action="config/add-data-barang.php" enctype="multipart/form-data">
                                                                            <div class="modal-body">
                                                                                <!-- <p>One fine body…</p> -->
                                                                                <h5>Nomer Seri : ' . $row['no_serial'] . '</h5>

                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text" id="id_barang" name="id_barang" value="' . $row['id_barang'] . '" hidden>
                                                                                        <input type="text" id="no_request" name="no_request" value="' . $row['no_request'] . '" hidden>
                                                                                        <label for="" class="col-form-label">Ststus Permintaan</label>
                                                                                        <div class="">
                                                                                            <span class="right badge badge-success">Approved</span>
                                                                                        </div>
                                                                                        <label for="" class="col-form-label">Bukti Foto Barang</label>
                                                                                        <div class="">
                                                                                            <input type="file" class="form-control" id="" placeholder="" name="foto_brg" required>
                                                                                            <p class="help-block">(*.jpeg .jpg .png)</p>
                                                                                        </div>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                <button type="submit" class="btn btn-primary" value="' . $row['id_barang'] . '" name="update_foto">Simpan</button>
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
            if (isset($_GET['edit']) or isset($_GET['update_foto_ya'])) {
                if ($_GET['edit'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil diubah.");
                    </script>
                    ';
                } elseif ($_GET['update_foto_ya'] == "sukses") {
                    echo '
                    <script type="text/javascript">
                    toastr.success("Data Barang berhasil diubah.");
                    </script>
                    ';
                } else {
                    echo '
                    <script type="text/javascript">
                    toastr.error("Permintaan Anda gagal diproses.");
                    </script>
                    ';
                }
            }
            ?>

    </body>
<?php } ?>

</html>