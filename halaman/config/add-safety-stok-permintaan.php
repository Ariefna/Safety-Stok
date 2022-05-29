<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan_sty_permintaan'])) {

    $id_barang       = $_POST['id_barang'];
    $max_stok        = $_POST['max_stok'];
    $rata_rata_sty   = $_POST['rata_rata_sty'];
    $lead_time_sty   = $_POST['lead_time_sty'];

    // Pertitungan Safety Stok
    $kurang      = $max_stok - $rata_rata_sty;
    $hasil_sty   = $kurang * $lead_time_sty;

    date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Y-m-d');

    $sql = "INSERT INTO safety_stok (id_barang, max_stok, rata_rata_sty, lead_time_sty, hasil_sty, date_sty, sts_sty, sts_per_pin) VALUES 
    ('$id_barang', '$max_stok', '$rata_rata_sty', '$lead_time_sty', '$hasil_sty', '$date_now', 0, 2)";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-data-barang.php?simpan=sukses";
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
    $id_safety_stok       = $_POST['id_safety_stok'];
    $restok_barang        = $_POST['restok_barang'];
    $id_barang            = $_POST['id_barang'];

    date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Y-m-d');

    $cek_stok = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
    $query_cek = mysqli_query($conn, $cek_stok);
    $cek_data = mysqli_fetch_array($query_cek);
    $get_jumlah_stok = $cek_data['jumlah_barang'];

    $restok_ok = $get_jumlah_stok + $restok_barang;

    $sql_re = "UPDATE safety_stok SET sts_sty = 1, restok_sty = '$restok_barang', sts_sty_restok = 1, date_restok = '$date_now' WHERE id_safety_stok = '$id_safety_stok';";
    $sql_re .= "UPDATE barang SET jumlah_barang = '$restok_ok' WHERE id_barang = '$id_barang'";
    $query_re = mysqli_multi_query($conn, $sql_re);

    if ($query_re) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-data-safety-stok.php?restok=sukses";
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