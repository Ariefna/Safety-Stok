<?php
include '../../template/koneksi.php';

if (isset($_POST['ubahya'])) {
        $id_barang          = $_POST['id_barang'];
        $no_request         = $_POST['no_request'];
        $no_serial          = $_POST['no_serial'];
        $id_jenis_barang    = $_POST['id_jenis_barang'];
        $nama_barang        = $_POST['nama_barang'];
        $jumlah_barang      = $_POST['jumlah_barang'];
        $harga_barang       = $_POST['harga_barang'];
        $keterangan_barang  = $_POST['keterangan_barang'];
        $catatan_barang     = $_POST['catatan_barang'];
      

        $sql = "UPDATE barang SET no_serial = '$no_serial', id_jenis_barang = '$id_jenis_barang', nama_barang = '$nama_barang', 
        jumlah_barang = '$jumlah_barang', harga_barang = '$harga_barang', keterangan_barang = '$keterangan_barang', catatan_barang = '$catatan_barang'
        WHERE id_barang = '$id_barang'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
            <script type="text/javascript">
                document.location = "../detail-pengajuan-barang.php?detail='.md5($no_request).'&edit=sukses";
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