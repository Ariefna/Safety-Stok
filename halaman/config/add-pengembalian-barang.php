<?php
include '../../template/koneksi.php';

if (isset($_POST['kembali_detail'])) {

    $id_detail_peminjaman   = $_POST['kembali_detail'];
    $kode   = md5($_POST['no_peminjaman']);
    $id   = $_POST['id_peminjaman'];
    $id_barang   = $_POST['id_barang'];

    $jumlah_barang   = $_POST['jumlah_barang'];

    $cek_stok = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
    $query_cek = mysqli_query($conn, $cek_stok);
    $cek_data = mysqli_fetch_array($query_cek);
    $get_jumlah_stok = $cek_data['jumlah_barang'];

    $hitung = $get_jumlah_stok + $jumlah_barang;

    $sql = "UPDATE detail_peminjaman SET status_pengembalian_barang = 1 WHERE id_detail_peminjaman = '$id_detail_peminjaman';";
    $sql .= "UPDATE barang SET jumlah_barang = '$hitung' WHERE id_barang = '$id_barang'";
    $query = mysqli_multi_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../detail-pengembalian-barang.php?detail=' . $kode . '&id=' . $id . '&kembali=sukses";
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

    $id_peminjaman  = $_GET['id'];

    $sql = "UPDATE peminjaman_barang SET status_peminjaman = 2 WHERE id_peminjaman = '$id_peminjaman'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
            document.location = "../menu-pengembalian-barang.php?save=sukses";
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
