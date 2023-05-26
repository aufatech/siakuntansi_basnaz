<?php include("koneksi.php");
$noakun=$_POST['t_noakun'];
$nama=$_POST['t_namaakun'];
$induk=$_POST['t_induk'];
$qry=mysql_query("INSERT INTO akun (`no_akun`, `induk`, `nama_akun`) VALUES ('$noakun', '$induk', '$nama')") or die(mysql_error());
if($qry){

  echo '<script>alert("Berhasil Disimpan.");window.location.assign("admin.php?admin=akun");</script>';

  }
?>
