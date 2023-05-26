<?php include("../koneksi.php");
function kodeauto($table,$initial){
$struktur = mysql_query("SELECT 'id_user' FROM ".$table);
$field = mysql_field_name($struktur,0);
$panjang = mysql_field_len($struktur,0);
$qry=mysql_query("SELECT MAX(".$field.") FROM ".$table);
$row=mysql_fetch_array($qry);
if($row[0]==""){
	$angka=0;
}else{
	$angka=substr($row[0],strlen($initial));

	}
	$angka++;
	$angka=strval($angka);
	$tmp="";
	for($i=1; $i<=($panjang-strlen($initial)-strlen($angka));$i++){
		$tmp=$tmp."0";
	}
return $initial.$tmp.$angka;
}
$kode=kodeauto("user","USR");
$nama=$_POST['nama'];
$user=$_POST['user'];
$password=$_POST['password'];
$qry=mysql_query("INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `alamat`, `no_telp`, `tempat`, `tgl_lahir`, `no_rekening`, `level`, `status`) VALUES ('$kode', '$nama', '$user', MD5('$password'), '', '', '', '', '', 'user', '0')") or die(mysql_error());
if($qry){

  echo '<script>alert("Berhasil Daftar silahkan hubungi pihak basnas untuk konfirmasi pendaftaran.");window.location.assign("../index.php");</script>';

  }
?>
