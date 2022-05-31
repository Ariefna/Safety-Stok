<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_permintaan_brg_in'] == 0) {

        $id_user    = $_POST['id_user'];

        $kode_permintaan_brg_in        = $_POST['kode_permintaan_brg_in'];
        $id_barang                      = $_POST['id_barang'];
        $jumlah_permintaan_barang_in   = $_POST['jumlah_permintaan_barang_in'];

        date_default_timezone_set('Asia/Jakarta');
        $date_request = date('Y-m-d');

        $sql_master = "INSERT INTO permintaan_barang_in (kode_permintaan_brg_in, date_permintaan_brg_in, id_user, status_permintaan_brg_in) VALUES 
        ('$kode_permintaan_brg_in','$date_request','$id_user',0)";
        echo $sql_master;
        $set_master = $conn->query($sql_master);

        $count = count($id_barang);
        $sqlc = "INSERT INTO detail_permintaan_in (kode_permintaan_brg_in, id_barang, jumlah_disetujui_in, keterangan_in, status_detail_permintaan_in, jumlah_permintaan_barang_in) VALUES ";
        for ($i = 0; $i < $count; $i++) {
            $sqlc .= "(
                    '{$kode_permintaan_brg_in}',
                    '{$id_barang[$i]}',
                    '0',
                    '',
                    '0',
                    '{$jumlah_permintaan_barang_in[$i]}')";
            $sqlc .= ",";
        }

        $sqlc = rtrim($sqlc, ",");
        $insert = $conn->query($sqlc);

        // if ($insert) {
        //     echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=../menu-permintaan-brg-Masuk.php\">");
        // }

        if ($insert) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-permintaan-brg-masuk.php?tambah=sukses";
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
}
