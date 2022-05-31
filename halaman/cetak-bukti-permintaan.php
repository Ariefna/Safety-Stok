<!DOCTYPE html>

<html>
<?php
include '../template/koneksi.php';

$po_get_no_req = $_GET['po'];

$slc = "SELECT brg.no_request, SUM(brg.harga_barang) AS harga, count(*) AS jml, us.id_user, us.nama_user, us.type_user
FROM barang brg JOIN users us ON brg.id_user = us.id_user
WHERE brg.no_request = '$po_get_no_req'";
$que = mysqli_query($conn, $slc);
$data_slc = mysqli_fetch_array($que);

if ($data_slc['type_user'] == 0) {
    $jabatan = 'Superadmin';
} elseif ($data_slc['type_user'] == 1) {
    $jabatan = 'Admin Cabang';
} elseif ($data_slc['type_user'] == 2) {
    $jabatan = 'gudang';
} else {
    $jabatan = 'pimpinan';
}

date_default_timezone_set('Asia/Jakarta');
$date_now = date('Y-m-d');

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

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PT. SAMUDERA SARANA LOGISTIK SURABAYA | Order Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4 class="page-header">
                        <img src="../assets/logov3.png" style="width: 300px;"><br><br>
                        <i class=""></i>Pembelian Barang Baru
                        <small class="float-right"></small>
                    </h4>
                </div>
                <!-- /.col -->
            </div><br>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Nama Lengkap : <?php echo $data_slc['nama_user']; ?></strong><br>
                        Staff : <?php echo $jabatan; ?><br>
                    </address>
                </div>
                <!-- /.col -->

                <div class="col-sm-4 invoice-col">
                    <b class="float-right">Tanggal PO: <?php echo tgl_indo($date_now); ?></b><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">
                                    NO
                                </th>
                                <th>
                                    No Seri
                                </th>
                                <th>
                                    Jenis
                                </th>
                                <th>
                                    Nama Barang
                                </th>
                                <th>
                                    Jumlah
                                </th>
                                <th>
                                    Harga
                                </th>
                                <!-- <th>
                                    <center>Status</center>
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_no = $_GET['po'];
                            $sql = "SELECT a.*, c.nama_user, b.nama_jenis_barang
                            FROM barang a JOIN jenis_barang b ON a.id_jenis_barang = b.id_jenis_barang
                            JOIN users c ON a.id_user = c.id_user
                            WHERE a.no_request = '$get_no'";
                            $i = 1;
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {

                                    // if ($row['status_pengembalian_barang'] == 0) {
                                    //     $verifikasi = '<span class="">Belum Dikembalikan</span>';
                                    // } else {
                                    //     $verifikasi = '<span class="">Sudah Dikembalikan</span>';
                                    // }

                                    echo '<tr>
                                            <td align="">' . $i++ . '</td>
                                            <td align="">' . $row['no_serial'] . '</td>
                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                            <td align="">' . $row['nama_barang'] . '</td>
                                            <td align="">' . $row['jumlah_barang'] . '</td>
                                            <td align="">' . $row['harga_barang'] . '</td>
                                        </tr>
                                            ';
                                }
                            } else {
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Total Pembelian:</p>
                    <div class="table-responsive">
                        <table class="table">

                            <tr>
                                <th>Jumlah Barang:</th>
                                <td><?php echo $data_slc['jml']; ?> Unit</td>
                            </tr>
                            <tr>
                                <th style="width:50%">Total Harga:</th>
                                <td>Rp. <?php echo $data_slc['harga']; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>