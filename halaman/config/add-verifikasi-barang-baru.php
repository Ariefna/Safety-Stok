<?php
include '../../template/koneksi.php';

if (isset($_POST['acc'])) {

    $id_barang   = $_POST['id_barang'];
    $no_request   = $_POST['no_request'];

    $sql = "UPDATE barang SET status_request = 1 WHERE id_barang = '$id_barang'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-barang-baru.php?detail='.$no_request.'&acc=sukses";
        </script>
        ';
    } else {
        echo '
        <script type="text/javascript">
            toastr.error("Permintaan Anda gagal diproses.");
        </script>
        ';
    }

} elseif (isset($_POST['tidakacc'])) {

    $id_barang   = $_POST['id_barang'];
    $no_request   = $_POST['no_request'];

    $sql = "UPDATE barang SET status_request = 2 WHERE id_barang = '$id_barang'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-verifikasi-barang-baru.php?detail=' . $no_request . '&tidakacc=sukses";
        </script>
        ';
    } else {
        echo '
        <script type="text/javascript">
            toastr.error("Permintaan Anda gagal diproses.");
        </script>
        ';
    }

} elseif (isset($_POST['acc_po'])) {

    $id_barang   = $_POST['id_barang'];
    $no_request   = $_POST['no_request'];

    $sql = "UPDATE barang SET status_po = 2 WHERE id_barang = '$id_barang'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-barang-po.php?detail=' . $no_request . '&acc_po_ok=sukses";
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
   $get_no_request = $_GET['id'];

    $sql = "UPDATE pengajuan_barang_baru SET status_pengajuan = 1 WHERE no_request = '$get_no_request'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-verifikasi-barang.php?eval=sukses";
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
