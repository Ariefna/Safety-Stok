<!DOCTYPE html>

<html>
<?php
include '../template/koneksi.php';

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
    <title>PT. INDONESIA BERKAH MANDIRI | Laporan Print</title>
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
                        <i class=""></i> PT. INDONESIA BERKAH MANDIRI
                        <small class="float-right"> Tanggal : <?php echo tgl_indo($date_now); ?></small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                    <h4 class="page-header">
                        <strong>Laporan Barang Masuk</strong>
                    </h4>


                </div>
                <!-- /.col -->
                <!-- <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>John Doe</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                    </address>
                </div> -->
                <!-- /.col -->
                <!-- <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2014<br>
                    <b>Account:</b> 968-34567
                </div> -->
                <!-- /.col -->
            </div>
            <br>
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
                                    Stok
                                </th>
                                <th>
                                    Harga
                                </th>
                                <th>
                                    Keterangan
                                </th>
                                <th>
                                    Catatan
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_date = $_GET['cetak'];
                            $sql = "SELECT a.*, b.nama_jenis_barang 
                                    FROM barang a JOIN jenis_barang b ON a.id_jenis_barang = b.id_jenis_barang
                                    WHERE a.date_request = '$get_date' AND a.status_po = 2";
                            $i = 1;
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {

                                    if ($row['status_request'] == 0) {
                                        $verifikasi = '<span class="">Panding</span>';
                                    } elseif ($row['status_request'] == 1) {
                                        $verifikasi = '<span class="">Approved</span>';
                                    } else {
                                        $verifikasi = '<span class="">Not approved</span>';
                                    }

                                    echo '<tr>
                                            <td align="">' . $i++ . '</td>
                                            <td align="">' . $row['no_serial'] . '</td>
                                            <td align="">' . $row['nama_jenis_barang'] . '</td>
                                            <td align="">' . $row['nama_barang'] . '</td>
                                            <td align="">' . $row['jumlah_barang'] . '</td>
                                            <td align="">' . $row['harga_barang'] . '</td>
                                            <td align="">' . $row['keterangan_barang'] . '</td>
                                            <td align="">' . $row['catatan_barang'] . '</td>
                                            <td align="">' . $verifikasi . '</td>    
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


        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>