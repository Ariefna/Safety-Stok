<?php
include '../../template/koneksi.php';

if (isset($_GET['id'])) {

    $no_request   = $_GET['id'];

    $sql = "UPDATE pengajuan_barang_baru SET status_pengajuan = 3 WHERE no_request = '$no_request'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-verifikasi-po.php?po_ok=sukses";
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
