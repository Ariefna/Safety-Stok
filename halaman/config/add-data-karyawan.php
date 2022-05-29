<?php
include '../../template/koneksi.php';

if (isset($_POST['simpan'])) {
    if ($_POST['id_user'] == 0) {
        $nama_user      = $_POST['nama_user'];
        $alamat_user    = $_POST['alamat_user'];
        $telepon_user   = $_POST['telepon_user'];
        $email_user     = $_POST['email_user'];
        $username       = $_POST['username'];
        $password       = md5($_POST['password']);
        $type_user      = $_POST['type_user'];

        $sql = "INSERT INTO users (id_user, nama_user, alamat_user, telepon_user, email_user, username, password, type_user) VALUES 
            (NULL, '$nama_user', '$alamat_user', '$telepon_user', '$email_user', '$username', '$password', '$type_user')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-data-karyawan.php?tambah=sukses";
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
        $id_user        = $_POST['id_user'];
        $nama_user      = $_POST['nama_user'];
        $alamat_user    = $_POST['alamat_user'];
        $telepon_user   = $_POST['telepon_user'];
        $email_user     = $_POST['email_user'];
        $username       = $_POST['username'];
        $password_o     = $_POST['password'];
        $password_oo     = md5($_POST['password']);
        $type_user      = $_POST['type_user'];

        if ($password_o == '') {
            $sql = "UPDATE users SET nama_user = '$nama_user', alamat_user = '$alamat_user', telepon_user = '$telepon_user', email_user = '$email_user', 
        username = '$username', type_user = '$type_user'
        WHERE id_user = '$id_user'";

        } else {
            $sql = "UPDATE users SET nama_user = '$nama_user', alamat_user = '$alamat_user', telepon_user = '$telepon_user', email_user = '$email_user', 
        username = '$username', password = '$password_oo', type_user = '$type_user'
        WHERE id_user = '$id_user'";

        }
        
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '
            <script type="text/javascript">
                document.location = "../menu-data-karyawan.php?edit=sukses";
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

    $sql = "DELETE FROM users WHERE md5(id_user) = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '
        <script type="text/javascript">
        document.location = "../menu-data-karyawan.php?delete=sukses";
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
