<?php 
require 'koneksi.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$pesan = [];
$nis = trim($data['nis']);
$nama = trim($data['nama']);
$alamat_siswa = trim($data['alamat_siswa']);
$pendidikan_terakhir = trim($data['pendidikan_terakhir']);
$no_telp = trim($data['no_telp']);

$query = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', alamat_siswa='$alamat_siswa', pendidikan_terakhir='$pendidikan_terakhir', no_telp='$no_telp' WHERE nis='$nis'");
// if($query){
//   http_response_code(201);
//   $pesan['status'] = 'success';
// }else{
//     http_response_code(422);
//     $pesan['status'] = 'error';
//     }
echo json_encode($pesan);
echo mysqli_error($koneksi);
?>