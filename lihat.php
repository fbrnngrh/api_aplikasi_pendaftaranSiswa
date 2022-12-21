<?php 
require 'koneksi.php';
$data = [];
$nis = $_GET['nis'];
$query = mysqli_query($koneksi, "SELECT * From siswa where nis='$nis'");
$jumlah = mysqli_num_rows($query);
if ($jumlah == 1){
    $row = mysqli_fetch_object($query);
    $data = $row;
}

echo json_encode($data);
echo mysqli_error($koneksi);
?>