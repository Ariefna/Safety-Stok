
<?php
include '../../template/koneksi.php';

$q = $_GET["q"];
$hint = "";
if ($q != "") {

    $sql = 'SELECT a.*, b.nama_satuan_barang, (select round(avg(jumlah_permintaan_barang_out),0) keluar from detail_permintaan_out where id_barang = a.id_barang group by id_barang) safetystok FROM barang a JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang where a.id_barang = ' . $q . ' group by a.id_barang';
    // echo $sql;
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if (isset($row['safetystok'])) {
        $safetystok = $row['safetystok'] * 2;
        $littime = 1;
        // rumus reorder point
        $hint = $safetystok + ($safetystok * $littime);
    }
}
$myObj = (object) array('stock' => '0');
if ($hint != "") {
    $myObj->stock = $hint;
}

$myJSON = json_encode($myObj);
echo $myJSON;
?>
