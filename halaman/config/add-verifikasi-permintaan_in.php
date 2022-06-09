<?php
include '../../template/koneksi.php';

if (isset($_POST['verifikasi_detail'])) {

    $id_detail_permintaan_in   = $_POST['verifikasi_detail'];
    $kode   = md5($_POST['kode_permintaan_brg_in']);
    $id   = $_POST['id_permintaan_brg_in'];
    $id_barang   = $_POST['id_barang'];

    $jumlah_permintaan   = $_POST['jumlah_permintaan_barang_in'];
    $jml_disetujui       = $_POST['jml_disetujui'];
    $keterangan_in      = $_POST['keterangan_in'];

    $cek_stok = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
    $query_cek = mysqli_query($conn, $cek_stok);
    $cek_data = mysqli_fetch_array($query_cek);
    $get_jumlah_stok = $cek_data['jumlah_barang'];

    $hitung = $get_jumlah_stok - $jml_disetujui;

    $sql = "UPDATE detail_permintaan_in SET jumlah_disetujui_in = '$jml_disetujui', keterangan_in = '$keterangan_in', status_detail_permintaan_in = 1 
            WHERE id_detail_permintaan_in = '$id_detail_permintaan_in';";
    // $sql .= "UPDATE barang SET jumlah_barang = '$hitung' WHERE id_barang = '$id_barang'";
    $query = mysqli_multi_query($conn, $sql);



    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-permintaan-barang-masuk.php?detail=' . $kode . '&id=' . $id . '&acc=sukses";
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
            document.location = "../detail-verifikasi-permintaan-barang-masuk.php?detail=' . $kode . '&id=' . $id . '&tidakacc=sukses";
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

    $sql = "UPDATE permintaan_barang_in SET status_permintaan_brg_in = 1 WHERE id_permintaan_brg_in = '$id_permintaan_brg_in'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-verifikasi-permintaan_in.php?save=sukses";
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
