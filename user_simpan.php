<?php include("koneksi.php");
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
$username=$_POST['t_username'];
$name=$_POST['t_nama'];
$password=$_POST['t_password'];
$tempat=$_POST['t_tmpt'];
$tgllhr=$_POST['t_tgllhr'];
$nohp=$_POST['t_nohp'];
$alamat=$_POST['t_almat'];
$norek=$_POST['t_nore'];
$level=$_POST['t_level'];
$status=$_POST['t_status'];
$qry=mysql_query("INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `alamat`, `no_telp`, `tempat`, `tgl_lahir`, `no_rekening`, `level`, `status`) VALUES ('$kode', '$name', '$username', MD5('$password'), '$alamat', '$nohp', '$tempat', '$tgllhr', '$norek', '$level', '$status')") or die(mysql_error());
if($qry){

  echo '<script>alert("Berhasil Disimpan.");window.location.assign("admin.php?admin=pengguna");</script>';

  }
?>
