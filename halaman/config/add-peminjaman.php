<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_peminjaman'] == 0) {

        $id_user                    = $_POST['id_user'];
        $date_peminjaman_start      = $_POST['date_peminjaman_start'];
        $date_peminjaman_end        = $_POST['date_peminjaman_end'];

        $awal  = new DateTime($date_peminjaman_start);
        $akhir = new DateTime($date_peminjaman_end);
        $diff  = $awal->diff($akhir);
        $set_duration = $diff->d + 1;

        date_default_timezone_set('Asia/Jakarta');
        $request_input_date = date('Y-m-d');

        $no_peminjaman      = $_POST['no_peminjaman'];
        $id_barang          = $_POST['id_barang'];
        $jumlah_barang      = $_POST['jumlah_barang'];

        $sql_master = "INSERT INTO peminjaman_barang (no_peminjaman, date_input_pinjam, date_peminjaman_start, date_peminjaman_end, durasi_peminjaman, id_user, status_peminjaman) VALUES 
        ('$no_peminjaman','$request_input_date','$date_peminjaman_start','$date_peminjaman_end','$set_duration','$id_user',0)";
        $set_master = $conn->query($sql_master);

        $count = count($id_barang);
        $sqlc = "INSERT INTO detail_peminjaman (no_peminjaman, id_barang, jumlah_barang) VALUES ";
        for ($i = 0; $i < $count; $i++) {
            $sqlc .= "(
                    '{$no_peminjaman}',
                    '{$id_barang[$i]}',
                    '{$jumlah_barang[$i]}')";
            $sqlc .= ",";

        }

        $sqlc = rtrim($sqlc, ",");
        $insert = $conn->query($sqlc);

        if ($insert) {
            echo ("<META HTTP-EQUIV=\"Refresh\"CONTENT=\"0;URL=../menu-peminjaman.php\">");
        }

    }
}