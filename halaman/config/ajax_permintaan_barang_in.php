
<?php
include '../../template/koneksi.php';

// Array with names
// $a[] = "Anna";
// $a[] = "Brittany";
// $a[] = "Cinderella";
// $a[] = "Diana";
// $a[] = "Eva";
// $a[] = "Fiona";
// $a[] = "Gunda";
// $a[] = "Hege";
// $a[] = "Inga";
// $a[] = "Johanna";
// $a[] = "Kitty";
// $a[] = "Linda";
// $a[] = "Nina";
// $a[] = "Ophelia";
// $a[] = "Petunia";
// $a[] = "Amanda";
// $a[] = "Raquel";
// $a[] = "Cindy";
// $a[] = "Doris";
// $a[] = "Eve";
// $a[] = "Evita";
// $a[] = "Sunniva";
// $a[] = "Tove";
// $a[] = "Unni";
// $a[] = "Violet";
// $a[] = "Liza";
// $a[] = "Elizabeth";
// $a[] = "Ellen";
// $a[] = "Wenche";
// $a[] = "Vicky";

// // get the q parameter from URL
$q = $_GET["q"];


// $hint = "";

// // lookup all hints from array if $q is different from ""
// if ($q !== "") {
//     $q = strtolower($q);
//     $len = strlen($q);
//     foreach ($a as $name) {
//         if (stristr($q, substr($name, 0, $len))) {
//             if ($hint === "") {
//                 $hint = $name;
//             } else {
//                 $hint .= ", $name";
//             }
//         }
//     }
// }
$hint = "";
if ($q != "") {

    // $sql = 'SELECT COALESCE((select avg(DATEDIFF(a.date_permintaan_brg_deliver_in, a.date_permintaan_brg_in)) from permintaan_barang_in a join detail_permintaan_in b on a.kode_permintaan_brg_in = b.kode_permintaan_brg_in where b.id_barang =  ' . $q . ' and a.status_permintaan_brg_in = 2 ),0) "littime",COALESCE((COALESCE((select avg(jumlah_disetujui_out) "keluar" from detail_permintaan_out where id_barang = a.id_barang group by id_barang),0)*2) ,0) "safetystok", DATEDIFF("2010-03-31", "2010-01-01"),COALESCE((select sum(jumlah_disetujui_out) "keluar" from detail_permintaan_out where id_barang = a.id_barang group by id_barang),0) keluar, COALESCE((select sum(jumlah_disetujui_in) "masuk" from detail_permintaan_in where id_barang = a.id_barang group by id_barang),0) masuk FROM barang a 
    // JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang 
    // JOIN detail_permintaan_out j ON a.id_barang = j.id_barang 
    // JOIN detail_permintaan_in k ON a.id_barang = k.id_barang 
    // where j.status_detail_permintaan_out = 2 and a.id_barang = ' . $q . '  group by a.id_barang';

    $sql = 'SELECT a.*, b.nama_satuan_barang, COALESCE((COALESCE((select avg(jumlah_disetujui_out) "keluar" from detail_permintaan_out where id_barang = a.id_barang group by id_barang),0)*2) ,0) "safetystok", (select DATEDIFF(a.date_permintaan_brg_deliver_in, a.date_permintaan_brg_in)  from permintaan_barang_in a join detail_permintaan_in b on a.kode_permintaan_brg_in = b.kode_permintaan_brg_in where b.id_barang =  12 and a.status_permintaan_brg_in = 2) "littime" FROM barang a 
    JOIN satuan_barang b ON a.id_satuan_barang = b.id_satuan_barang
    where a.id_barang = ' . $q . '
    group by a.id_barang';
    // $sql;
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $safetystok = $row['safetystok'];
    $littime = $row['littime'];
    $hint = $safetystok + ($safetystok * $littime);
}

$myObj->stock = $hint == '' ? '0' : $hint;
$myJSON = json_encode($myObj);
echo $myJSON;


// Output "no suggestion" if no hint was found or output correct values
// echo $hint == '' ? '0' : $hint;
?> 