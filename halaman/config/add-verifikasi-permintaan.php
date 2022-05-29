<?php
include '../../template/koneksi.php';

if (isset($_POST['verifikasi_detail'])) {

    $id_detail_permintaan_out   = $_POST['verifikasi_detail'];
    $kode   = md5($_POST['kode_permintaan_brg_out']);
    $id   = $_POST['id_permintaan_brg_out'];
    $id_barang   = $_POST['id_barang'];

    $jumlah_permintaan   = $_POST['jumlah_permintaan_barang_out'];
    $jml_disetujui       = $_POST['jml_disetujui'];
    $keterangan_out      = $_POST['keterangan_out'];

    $cek_stok = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
    $query_cek = mysqli_query($conn, $cek_stok);
    $cek_data = mysqli_fetch_array($query_cek);
    $get_jumlah_stok = $cek_data['jumlah_barang'];

    $hitung = $get_jumlah_stok - $jml_disetujui;

    $sql = "UPDATE detail_permintaan_out SET jumlah_disetujui_out = '$jml_disetujui', keterangan_out = '$keterangan_out', status_detail_permintaan_out = 1 
            WHERE id_detail_permintaan_out = '$id_detail_permintaan_out';";
    $sql .= "UPDATE barang SET jumlah_barang = '$hitung' WHERE id_barang = '$id_barang'";
    $query = mysqli_multi_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-permintaan-barang-keluar.php?detail=' . $kode. '&id=' . $id . '&acc=sukses";
        </script>
        ';
    } else {
        echo '
        <script type="text/javascript">
            toastr.error("Permintaan Anda gagal diproses.");
        </script>
        ';
    }

} elseif(isset($_POST['notverifikasi_detail'])) {
    $id_detail_permintaan_out   = $_POST['notverifikasi_detail'];
    $kode   = md5($_POST['kode_permintaan_brg_out']);
    $id   = $_POST['id_permintaan_brg_out'];

    $jml_disetujui       = $_POST['jml_disetujui'];
    $keterangan_out      = $_POST['keterangan_out'];

    $sql = "UPDATE detail_permintaan_out SET jumlah_disetujui_out = '$jml_disetujui', keterangan_out = '$keterangan_out', status_detail_permintaan_out = 2 
            WHERE id_detail_permintaan_out = '$id_detail_permintaan_out'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-permintaan-barang-keluar.php?detail=' . $kode . '&id=' . $id . '&tidakacc=sukses";
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

    $id_permintaan_brg_out  = $_GET['id'];

    $sql = "UPDATE permintaan_barang_out SET status_permintaan_brg_out = 1 WHERE id_permintaan_brg_out = '$id_permintaan_brg_out'";
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
