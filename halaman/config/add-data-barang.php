<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_pengajuan_barang'] == 0) {
        $no_request         = $_POST['no_request'];
        $no_serial          = $_POST['no_serial'];

        date_default_timezone_set('Asia/Jakarta');
        $date_request = date('Y-m-d');


        $sql_pengajuan = "INSERT INTO pengajuan_barang_baru (no_request, tanggal_pengajuan, status_pengajuan) VALUES 
            ('$no_request', '$date_request', 0)";
        $query_pengajuan = mysqli_query($conn, $sql_pengajuan);


        $id_jenis_barang    = $_POST['id_jenis_barang'];
        $nama_barang        = $_POST['nama_barang'];
        $jumlah_barang      = $_POST['jumlah_barang'];
        $harga_barang       = $_POST['harga_barang'];
        $keterangan_barang  = $_POST['keterangan_barang'];
        $catatan_barang     = $_POST['catatan_barang'];
        $id_user            = $_POST['id_user'];


        $count = count($nama_barang);
        $sqlc = "INSERT INTO barang (no_request, no_serial, nama_barang, jumlah_barang, harga_barang, keterangan_barang, catatan_barang, date_request, id_user, id_jenis_barang) VALUES ";
        for ($i = 0; $i < $count; $i++) {
            $sqlc .= "(
                    '{$no_request}',
                    '{$no_serial[$i]}',
                    '{$nama_barang[$i]}',
                    '{$jumlah_barang[$i]}',
                    '{$harga_barang[$i]}',
                    '{$keterangan_barang[$i]}',
                    '{$catatan_barang[$i]}',
                    '{$date_request}',
                    '{$id_user}',
                    '{$id_jenis_barang[$i]}')";
            $sqlc .= ",";
        }

        $sqlc = rtrim($sqlc, ",");
        $insert = $conn->query($sqlc);
        

        if ($insert) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-pengajuan-barang-baru.php?tambah=sukses";
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
        // $id_barang          = $_POST['id_barang'];
        // $no_request         = $_POST['no_request'];
        // $no_serial          = $_POST['no_serial'];
        // $id_jenis_barang    = $_POST['id_jenis_barang'];
        // $nama_barang        = $_POST['nama_barang'];
        // $jumlah_barang      = $_POST['jumlah_barang'];
        // $harga_barang       = $_POST['harga_barang'];
        // $keterangan_barang  = $_POST['keterangan_barang'];
        // $catatan_barang     = $_POST['catatan_barang'];
        // $id_user            = $_POST['id_user'];

        // $sql = "UPDATE barang SET no_serial = '$no_serial', id_jenis_barang = '$id_jenis_barang', nama_barang = '$nama_barang', 
        // jumlah_barang = '$jumlah_barang', harga_barang = '$harga_barang', keterangan_barang = '$keterangan_barang', catatan_barang = '$catatan_barang', id_user = '$id_user' 
        // WHERE id_barang = '$id_barang'";
        // $query = mysqli_query($conn, $sql);

        // if ($query) {
        //     echo '
        //     <script type="text/javascript">
        //         document.location = "../menu-permintaan-barang-baru.php?edit=sukses";
        //     </script>
        //     ';
        // } else {
        //     echo '
        //     <script type="text/javascript">
        //         toastr.error("Permintaan Anda gagal diproses.");
        //     </script>
        //     ';
        // }
    }

} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM barang WHERE md5(id_barang) = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
        document.location = "../menu-pengajuan-barang-baru.php?delete=sukses";
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
    $id_barang           = $_POST['update_foto'];
    $no_request          = md5($_POST['no_request']);

    // Upload Gambar
    $target_dir = "../images/barang/";

    $foto_brg   = $target_dir . basename($_FILES["foto_brg"]["name"]);
    $name = $_FILES['foto_brg']['name'];
    $file = $_FILES['foto_brg']['tmp_name'];
    $tmp = $_FILES['foto_brg']['tmp_name'];
    $extension = explode("/", $_FILES["foto_brg"]["type"]);
    $namefile = $id_barang . "_FT_BRG" . "." . $extension[1];

    $fordb_fotobrg       = "http://localhost/safety-stock/halaman/images/barang/" . $namefile;

    if (move_uploaded_file($file, $target_dir . $namefile)) {
        $sql = "UPDATE barang SET status_po = 1, foto_barang = '$fordb_fotobrg' WHERE id_barang = '$id_barang'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
                <script type="text/javascript">
                    document.location = "../detail-pengajuan-barang.php?detail='. $no_request .'&update_foto_ya=sukses";
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
