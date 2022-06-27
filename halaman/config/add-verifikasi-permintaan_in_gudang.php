<?php
include '../../template/koneksi.php';

if (isset($_POST['verifikasi_detail'])) {

    $id_detail_permintaan_in   = $_POST['verifikasi_detail'];
    $kode   = md5($_POST['kode_permintaan_brg_in']);
    $id   = $_POST['id_permintaan_brg_in'];
    date_default_timezone_set('Asia/Jakarta');

    $deliver = date("Y/m/d");

    $hitung = $get_jumlah_stok - $jml_disetujui;

    $sql = "UPDATE permintaan_barang_in SET date_permintaan_brg_deliver_in = '" . $deliver . "' WHERE id_permintaan_brg_in = '$id_permintaan_brg_in'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-permintaan-barang.php?detail=' . $kode . '&id=' . $id . '&acc=sukses";
        </script>
        ';
    } else {
        echo '
        <script type="text/javascript">
            toastr.error("Permintaan Anda gagal diproses.");
        </script>
        ';
    }
} elseif (isset($_POST['notverifikasi_detail'])) {
    $id_detail_permintaan_in   = $_POST['notverifikasi_detail'];
    $kode   = md5($_POST['kode_permintaan_brg_in']);
    $id   = $_POST['id_permintaan_brg_in'];

    $jml_disetujui       = $_POST['jml_disetujui'];
    $keterangan_in      = $_POST['keterangan_in'];

    $sql = "UPDATE detail_permintaan_in SET jumlah_disetujui_in = '$jml_disetujui', keterangan_in = '$keterangan_in', status_detail_permintaan_in = 2
            WHERE id_detail_permintaan_in = '$id_detail_permintaan_in'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-permintaan-barang-masuk-gudang.php?detail=' . $kode . '&id=' . $id . '&tidakacc=sukses";
        </script>
        ';
    } else {
        echo '
        <script type="text/javascript">
            toastr.error("Permintaan Anda gagal diproses.");
        </script>
        ';
    }
} else {

    $id_permintaan_brg_in  = $_GET['id'];
    $kode_permintaan_brg_in  = $_GET['kode'];
    date_default_timezone_set('Asia/Jakarta');
    $deliver = date("Y/m/d");
    $sql = "UPDATE detail_permintaan_in SET status_in = 1 WHERE kode_permintaan_brg_in = '$kode_permintaan_brg_in'";
    $query = mysqli_query($conn, $sql);
    $sql = "UPDATE permintaan_barang_in SET status_permintaan_brg_in = 2, date_permintaan_brg_deliver_in='" . $deliver . "' WHERE id_permintaan_brg_in = '$id_permintaan_brg_in'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-verifikasi-permintaan.php?save=sukses";
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
