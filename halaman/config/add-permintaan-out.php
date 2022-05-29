<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_permintaan_brg_out'] == 0) {

        $id_user    = $_POST['id_user'];

        $kode_permintaan_brg_out        = $_POST['kode_permintaan_brg_out'];
        $id_barang                      = $_POST['id_barang'];
        $jumlah_permintaan_barang_out   = $_POST['jumlah_permintaan_barang_out'];

        date_default_timezone_set('Asia/Jakarta');
        $date_request = date('Y-m-d');

        $sql_master = "INSERT INTO permintaan_barang_out (kode_permintaan_brg_out, date_permintaan_brg_out, id_user, status_permintaan_brg_out) VALUES 
        ('$kode_permintaan_brg_out','$date_request','$id_user',0)";
        $set_master = $conn->query($sql_master);

        $count = count($id_barang);
        $sqlc = "INSERT INTO detail_permintaan_out (kode_permintaan_brg_out, id_barang, jumlah_permintaan_barang_out) VALUES ";
        for ($i = 0; $i < $count; $i++) {
            $sqlc .= "(
                    '{$kode_permintaan_brg_out}',
                    '{$id_barang[$i]}',
                    '{$jumlah_permintaan_barang_out[$i]}')";
            $sqlc .= ",";
        }

        $sqlc = rtrim($sqlc, ",");
        $insert = $conn->query($sqlc);

        if ($insert) {
            echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=../menu-permintaan-brg-keluar.php\">");
        }
    }
}
