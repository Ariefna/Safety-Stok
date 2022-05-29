<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_satuan_barang'] == 0) {
        $nama_satuan_barang  = $_POST['nama_satuan_barang'];

        $sql = "INSERT INTO satuan_barang (id_satuan_barang, nama_satuan_barang) VALUES
            (NULL, '$nama_satuan_barang')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-data-satuan-barang.php?tambah=sukses";
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
        $id_satuan_barang    = $_POST['id_satuan_barang'];
        $nama_satuan_barang  = $_POST['nama_satuan_barang'];

        $sql = "UPDATE satuan_barang SET nama_satuan_barang = '$nama_satuan_barang' WHERE id_satuan_barang = '$id_satuan_barang'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-data-satuan-barang.php?edit=sukses";
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
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM satuan_barang WHERE md5(id_satuan_barang) = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
        document.location = "../menu-data-satuan-barang.php?delete=sukses";
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
